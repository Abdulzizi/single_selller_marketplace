<?php

namespace App\Models;

use App\Helpers\SlugHelper;
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
        $payload['slug'] = SlugHelper::createUniqueSlug($payload['name'], self::class);

        return $this->find($id)->update($payload);
    }

    public function store(array $payload)
    {
        $payload['slug'] = SlugHelper::createUniqueSlug($payload['name'], self::class);

        return $this->create($payload);
    }

    // Get list product & Get spesifik product
    public function getAll(array $filter, int $page = 1, int $itemPerPage = 0, string $sort = '')
    {
        $skip = ($page * $itemPerPage) - $itemPerPage;
        $products = $this->query();

        if (!empty($filter['name'])) {
            $products->where('name', 'LIKE', '%' . $filter['name'] . '%');
        }

        if (!empty($filter['category_id'])) {
            $products->where('category_id', 'LIKE', '%' . $filter['category_id'] . '%');
        }

        if ($filter['is_available'] != '') {
            $products->where('is_available', '=', $filter['is_available']);
        }

        $total = $products->count();
        $sort = $sort ?: 'id DESC';
        $list = $products->skip($skip)->take($itemPerPage)->orderByRaw($sort)->get();

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
