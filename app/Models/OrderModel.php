<?php

namespace App\Models;

use App\Http\Traits\Uuid;
use App\Repository\CrudInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderModel extends Model implements CrudInterface
{
    use HasFactory;
    use SoftDeletes;
    use Uuid;

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'product_detail_id',
        'total_price',
        'status',
        'street',
        'apartment',
        'city',
        'postcode',
        'country',
        'payment_method',
        'payment_details',
    ];

    protected $casts = [
        'payment_details' => 'array',
    ];

    protected $table = 'orders';

    public function user()
    {
        return $this->belongsTo(UserModel::class, 'user_id', 'id');
    }

    public function productDetail()
    {
        return $this->belongsTo(ProductDetailModel::class, 'product_detail_id', 'id');
    }

    public function details()
    {
        return $this->hasMany(OrderDetailModel::class, 'order_id', 'id');
    }

    // CRUD interface
    public function drop(string $id)
    {
        return $this->find($id)->delete();
    }

    public function edit(array $payload, string $id)
    {
        return $this->find($id)->update($payload);
    }

    public function store(array $payload)
    {
        // dd($payload);

        return $this->create($payload);
    }

    // Get list product & Get spesifik product
    public function getAll(array $filter, int $page = 1, int $itemPerPage = 0, string $sort = '')
    {
        $skip = ($page * $itemPerPage) - $itemPerPage;
        $orders = $this->query();

        if (!empty($filter['id'])) {
            $orders->where('id', 'LIKE', '%' . $filter['id'] . '%');
        }

        if (!empty($filter['user_id'])) {
            $orders->where('user_id', 'LIKE', '%' . $filter['user_id'] . '%');
        }

        if (!empty($filter['product_detail_id'])) {
            $orders->where('product_detail_id', 'LIKE', '%' . $filter['product_detail_id'] . '%');
        }

        if ($filter['status'] != '') {
            $orders->where('status', '=', $filter['status']);
        }

        $total = $orders->count();
        $sort = $sort ?: 'id DESC';
        $list = $orders->skip($skip)->take($itemPerPage)->orderByRaw($sort)->get();

        return [
            'total' => $total,
            'data' => $list,
        ];
    }
    public function getById(string $id)
    {
        return $this->find($id);
    }
}
