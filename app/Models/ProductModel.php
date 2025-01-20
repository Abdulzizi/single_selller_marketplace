<?php

namespace App\Models;

use App\Http\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductModel extends Model
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
}
