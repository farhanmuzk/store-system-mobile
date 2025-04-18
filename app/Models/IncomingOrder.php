<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomingOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product',
        'quantity',
        'customer_name',
        'address',
        'rt_rw',
        'district',
        'regency',
        'province',
        'phone_number',
        'payment_method',
        'nomor_tf',
        'total',
        'estimation',
        'note',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
