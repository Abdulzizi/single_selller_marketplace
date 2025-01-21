<?php

namespace App\Models;

use App\Http\Traits\Uuid;
use App\Repository\CrudInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductModel extends Model implements CrudInterface
{
    use HasFactory;
    use SoftDeletes;
    use Uuid;

    public $timestamps = true;

    protected $fillable = [
        'category_id',
        'name',
        'price',
        'description',
        'slug',
        'photo_desktop',
        'photo_mobile',
        'is_available'
    ];

    protected $table = 'products';

    // Relasi
    public function category()
    {
        return $this->belongsTo(CategoryModel::class, 'category_id', 'id');
    }

    public function carts()
    {
        return $this->hasMany(CartModel::class, 'product_id', 'id');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetailModel::class, 'product_id', 'id');
    }

    public function details()
    {
        return $this->hasMany(ProductDetailModel::class, 'product_id', 'id');
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
        return $this->create($payload);
    }

    // Get list product & Get spesifik product
    public function getAll(array $filter, int $page = 1, int $itemPerPage = 0, string $sort = '')
    {
        $skip = ($page * $itemPerPage) - $itemPerPage;
        $categoryDetail = $this->query();

        if (!empty($filter['name'])) {
            $categoryDetail->where('name', 'LIKE', '%' . $filter['name'] . '%');
        }

        if (!empty($filter['category_id'])) {
            $categoryDetail->where('product_id', 'LIKE', '%' . $filter['product_id'] . '%');
        }

        if ($filter['is_available'] != '') {
            $categoryDetail->where('is_available', '=', $filter['is_available']);
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
}
