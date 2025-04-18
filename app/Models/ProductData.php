<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductData extends Model
{
    protected $fillable = [
        'gambar',
        'keterangan',
        'harga_jual',
        'stok',
        'earning_negosiator',
        'earning_marketing'
    ];
}
