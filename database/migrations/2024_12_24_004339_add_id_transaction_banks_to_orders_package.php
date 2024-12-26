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
        Schema::table('orders_package', function (Blueprint $table) {
            $table->unsignedBigInteger('id_transaction_banks')->nullable(); // Campo relacionado, padrão NULL
            $table->foreign('id_transaction_banks') // Configura o relacionamento
                ->references('id')->on('transaction_banks') // Relaciona com 'transaction_banks'
                ->onDelete('set null'); // Define como NULL ao deletar na tabela pai
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders_package', function (Blueprint $table) {
            $table->dropForeign(['id_transaction_banks']); // Remove a chave estrangeira
            $table->dropColumn('id_transaction_banks'); // Remove o campo
        });
    }
};
