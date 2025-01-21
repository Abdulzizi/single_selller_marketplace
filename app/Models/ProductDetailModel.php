<?php

namespace App\Models;

use App\Http\Traits\Uuid;
use App\Repository\CrudInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductDetailModel extends Model implements CrudInterface
{
    use HasFactory;
    use SoftDeletes;
    use Uuid;

    public $timestamps = true;

    protected $fillable = [
        'product_id',
        'type',
        'description',
        'price',
    ];

    protected $table = 'product_details';
    public function product()
    {
        return $this->belongsTo(ProductModel::class, 'product_id', 'id');
    }

    public function carts()
    {
        return $this->hasMany(CartModel::class, 'product_detail_id', 'id');
    }

    public function orders()
    {
        return $this->hasMany(OrderModel::class, 'product_detail_id', 'id');
    }

    // Crud Interface
    public function drop(string $id)
    {
        return $this->find($id)->delete();
    }

    public function dropByProductId(string $id)
    {
        return $this->where('product_id', $id)->delete();
    }

    public function edit(array $payload, string $id)
    {
        return $this->find($id)->update($payload);
    }

    public function getAll(array $filter, int $page = 1, int $itemPerPage = 0, string $sort = '')
    {
        $skip = ($page * $itemPerPage) - $itemPerPage;
        $categoryDetail = $this->query();

        if (!empty($filter['type'])) {
            $categoryDetail->where('type', 'LIKE', '%' . $filter['type'] . '%');
        }

        if (!empty($filter['product_id'])) {
            $categoryDetail->where('product_id', 'LIKE', '%' . $filter['product_id'] . '%');
        }

        $total = $categoryDetail->count();
        $sort = $sort ?: 'id DESC';
        $list = $categoryDetail->skip($skip)->take($itemPerPage)->orderByRaw($sort)->get();

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
