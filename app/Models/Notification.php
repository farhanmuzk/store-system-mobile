<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'token',
        'notification_time',
        'user_id',
        'type', //enum dengan pilihan notification atau notification order
        'image',
        'status',
        'noted',
        'noted_plus',
        'incoming_order_id',
    ];

    /**
     * Relasi ke user yang membuat notifikasi
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
