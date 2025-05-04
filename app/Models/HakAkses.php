<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HakAkses extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'email',
        'link',
        'no_wa',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'id_hak_akses');
    }

}
