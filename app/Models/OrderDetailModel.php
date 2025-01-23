<?php

namespace App\Models;

use App\Http\Traits\Uuid;
use App\Repository\CrudInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetailModel extends Model implements CrudInterface
{
    use HasFactory;
    use SoftDeletes;
    use Uuid;

    public $timestamps = true;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
        'total',
    ];

    protected $table = 'order_details';

    public function order()
    {
        return $this->belongsTo(OrderModel::class, 'order_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(ProductModel::class, 'product_id', 'id');
    }

    // Crud Interface
    public function drop(string $id)
    {
        return $this->find($id)->delete();
    }

    public function dropByOrderId(string $id)
    {
        return $this->where('order_id', $id)->delete();
    }

    public function edit(array $payload, string $id)
    {
        return $this->find($id)->update($payload);
    }

    public function getAll(array $filter, int $page = 1, int $itemPerPage = 0, string $sort = '')
    {
        $skip = ($page * $itemPerPage) - $itemPerPage;
        $orders = $this->query();

        if (!empty($filter['order_id'])) {
            $orders->where('order_id', 'LIKE', '%' . $filter['order_id'] . '%');
        }

        if (!empty($filter['product_id'])) {
            $orders->where('product_id', 'LIKE', '%' . $filter['product_id'] . '%');
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

    public function store(array $payload)
    {
        return $this->create($payload);
    }
}
