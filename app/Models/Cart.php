<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts';

    protected $fillable = [
        'id',
        'package_id',
        'user_id',
        'price',
        'created_at',
        'updated_at'
    ];

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id', 'id');
    }
}
