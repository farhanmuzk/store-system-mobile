<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SendingReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'file',
        'teks',
        'user_id',
        'type_report',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
