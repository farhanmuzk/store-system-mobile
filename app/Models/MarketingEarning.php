<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketingEarning extends Model
{
    use HasFactory;

    protected $table = 'marketing_earning';

    protected $fillable = [
        'nama',
        'gambar',
        'nomor_telp',
        'nama_produk',
        'earning',
        'hari_tanggal',
        'code_earning',
    ];
}
