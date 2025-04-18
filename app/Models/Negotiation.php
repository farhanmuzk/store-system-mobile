<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Negotiation extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'contact'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
