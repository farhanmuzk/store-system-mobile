<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Daftar kolom yang bisa diisi (mass-assignable)
    protected $fillable = [
        'gambar',
        'spesifikasi',
        'harga',
        'keuntungan',
    ];
}
