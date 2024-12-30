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
        Schema::table('transaction_banks', function (Blueprint $table) {
            $table->string('moeda_local', 255);
            $table->decimal('multiplicador_local', 8,2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaction_banks', function (Blueprint $table) {
            $table->dropColumn('moeda_local');
            $table->dropColumn('multiplicador_local');
        });
    }
};
