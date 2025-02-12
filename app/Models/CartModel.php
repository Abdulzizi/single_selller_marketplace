<?php

namespace App\Models;

use App\Http\Traits\Uuid;
use App\Repository\CrudInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartModel extends Model implements CrudInterface
{
    use HasFactory;
    use SoftDeletes;
    use Uuid;

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'product_id',
        'product_detail_id',
        'quantity',
    ];

    protected $table = 'carts';

    public function user()
    {
        return $this->belongsTo(UserModel::class, 'user_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(ProductModel::class, 'product_id', 'id');
    }

    public function productDetail()
    {
        return $this->belongsTo(ProductDetailModel::class, 'product_detail_id', 'id');
    }

    public function drop(string $id)
    {
        return $this->find($id)->delete();
    }

    public function edit(array $payload, string $id)
    {
        return $this->find($id)->update($payload);
    }

    public function getAll(array $filter, int $page = 1, int $itemPerPage = 0, string $sort = '')
    {
        $skip = ($page * $itemPerPage) - $itemPerPage;
        $carts = $this->query()->with(['product', 'productDetail']);

        if (!empty($filter['user_id'])) {
            $carts->where('user_id', 'LIKE', '%' . $filter['user_id'] . '%');
        }

        if (!empty($filter['product_id'])) {
            $carts->where('product_id', 'LIKE', '%' . $filter['product_id'] . '%');
        }

        if (!empty($filter['product_detail_id'])) {
            $carts->where('product_detail_id', 'LIKE', '%' . $filter['product_detail_id'] . '%');
        }

        $total = $carts->count();
        $sort = $sort ?: 'id DESC';
        $list = $carts->skip($skip)->take($itemPerPage)->orderByRaw($sort)->get();

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
