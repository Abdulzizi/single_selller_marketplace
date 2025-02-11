<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;
    protected $connection = 'mongodb'; // Menggunakan koneksi MongoDB
    protected $collection = 'activity_logs'; // Nama koleksi di MongoDB

    protected $fillable = [
        'user_id',
        'method',
        'url',
        'ip_address',
        'user_agent',
        'request_headers',
        'request_body',
        'response_body',
        'status_code'
    ];

    public function user()
    {
        return $this->belongsTo(UserModel::class, 'user_id', 'id');
    }
}
