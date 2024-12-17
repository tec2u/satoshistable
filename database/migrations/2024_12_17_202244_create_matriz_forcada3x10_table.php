<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matriz_forcada3x10', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_dados')->nullable(true);
            $table->unsignedBigInteger('upline')->nullable(true);
            $table->integer('ciclo')->nullable(true);
            $table->integer('qty')->nullable(true);
            $table->timestamps();
            $table->foreign('id_dados')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matriz_forcada3x10');
    }
};
