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
        Schema::create('transaction_banks', function (Blueprint $table) {
            $table->id();
            // Campo ID autoincrementado
            $table->text('name')->nullable(); // Nome ou descrição do banco
            $table->text('logo')->nullable(); // Nome ou descrição do banco
            $table->text('description')->nullable(); // Nome ou descrição do banco
            $table->boolean('activated')->default(1); // Nome ou descrição do banco
            $table->timestamps(); // Campos created_at e updated_at

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_banks');
    }
};
