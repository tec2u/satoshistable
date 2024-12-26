<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    /**
     * Campos que podem ser preenchidos em massa.
     */
    protected $fillable = ['question_id', 'user_id', 'answer'];

    /**
     * Relacionamento: Uma resposta pertence a uma pergunta.
     */
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    /**
     * Relacionamento: Uma resposta pode ser associada a um usuário (opcional).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
