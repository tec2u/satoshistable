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
        if (!Schema::hasColumn('orders_package', 'price_crypto')) {
            Schema::table('orders_package', function (Blueprint $table) {
                $table->text('price_crypto')->nullable();
            });
        }

        if (!Schema::hasColumn('orders_package', 'hash')) {
            Schema::table('orders_package', function (Blueprint $table) {
                $table->text('hash')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders_package', function (Blueprint $table) {
            $table->dropColumn('price_crypto');
            $table->dropColumn('hash');
        });
    }
};
