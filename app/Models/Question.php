<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    /**
     * Campos que podem ser preenchidos em massa.
     */
    protected $fillable = ['text', 'type', 'options'];

    /**
     * Define que o campo `options` é um array JSON.
     */
    protected $casts = [
        'options' => 'array',
    ];

    /**
     * Relacionamento: Uma pergunta tem muitas respostas.
     */
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
