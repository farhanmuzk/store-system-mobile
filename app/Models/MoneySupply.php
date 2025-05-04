<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class MoneySupply extends Model
{
    use HasFactory;
    protected $table = 'money_supplies';


    protected $fillable = [
        'user_id',
        'nama_id',
        'no_telp',
        'tanggal',
        'payment_method',
        'nomor_tf',
        'note',
        'message_admin',
        'image_payment',
        'image_feedback',
        'type_payment',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
