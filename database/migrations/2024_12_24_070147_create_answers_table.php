<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->id(); // ID da resposta
            $table->unsignedBigInteger('question_id'); // ID da pergunta relacionada
            $table->unsignedBigInteger('user_id')->nullable(); // ID do usuário (opcional, se for associado a um usuário)
            $table->text('answer'); // Resposta dada
            $table->timestamps();

            // Relacionamento com a tabela questions
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('answers');
    }
};
