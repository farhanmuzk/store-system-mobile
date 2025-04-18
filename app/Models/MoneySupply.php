<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoneySupply extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_id',
        'no_telp',
        'tanggal',
        'payment_method',
        'nomor_tf',
        'note',
        'image_bukti',
        'image_bukti_balik',
        'type_payment',
    ];

}
