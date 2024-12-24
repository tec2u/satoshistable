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
        Schema::create('questions', function (Blueprint $table) {
            $table->id(); // ID da pergunta
            $table->text('text'); // Texto da pergunta
            $table->enum('type', ['text', 'multiple_choice', 'number']); // Tipo de pergunta
            $table->json('options')->nullable(); // Opções de resposta (para perguntas de múltipla escolha)
            $table->timestamps();
        });

        // Inserção inicial das perguntas
        DB::table('questions')->insert([
            ['text' => 'StableDAO is a database where your upline will always be your upline, your downline will always be your downline, a forever tree for a forever family.', 'type' => 'multiple_choice', 'options' => json_encode(['I Agree', 'I Disagree'])],
            ['text' => '3rd party opportunities pay 2% management fee to StableDAO to access the database and build their community.', 'type' => 'multiple_choice', 'options' => json_encode(['I Agree', 'I Disagree'])],
            ['text' => 'In 2025, as downlines participate in new opportunities, you will be rewarded as their uplines according to the compensation plans.', 'type' => 'multiple_choice', 'options' => json_encode(['I Agree', 'I Disagree'])],
            ['text' => 'I wish to receive these rewards in the following USDT address:', 'type' => 'text', 'options' => null],
            ['text' => 'In 2025, I would like to make extra passive income of:', 'type' => 'text', 'options' => null],
            ['text' => 'Using this additional money, I wish to improve my life and purchase:', 'type' => 'text', 'options' => null],
            ['text' => 'If given the right opportunity, I’m willing to recruit X people:', 'type' => 'number', 'options' => null],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
};
