<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BancoCredit extends Model
{
    use HasFactory;

    protected $table = 'banco_credito';

    protected $fillable = [
        'user_id',
        'order_id',
        'description',
        'price',
        'status',
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }
}
