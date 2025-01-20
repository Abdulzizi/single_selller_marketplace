<?php

namespace App\Models;

use App\Http\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderModel extends Model
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
}
