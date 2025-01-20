<?php

namespace App\Models;

use App\Http\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductDetailModel extends Model
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
}
