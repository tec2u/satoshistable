<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Landing extends Model
{
    use HasFactory;

    protected $table = 'landing';

    protected $fillable = [
        'id',
        'description',
        'img_url',
        'created_at',
        'updated_at',
    ];
}
