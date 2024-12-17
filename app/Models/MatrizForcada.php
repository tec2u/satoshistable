<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatrizForcada extends Model
{
    use HasFactory;

    protected $table = 'matriz_forcada3x10';

    protected $fillable = [
        'id',
        'id_dados',
        'upline',
        'ciclo',
        'qty',
        'created_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_dados', 'id');
    }

    public function historicScores()
    {
        return $this->hasMany(HistoricScore::class, 'user_id_from', 'id_dados');
    }
}
