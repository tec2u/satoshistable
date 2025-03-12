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
        Schema::table('projects', function (Blueprint $table) {
            $table->string('registration_bg')->nullable();
            $table->string('regiatration_fontcolor')->nullable();
            $table->string('registration_boxbgcolor')->nullable();
            $table->string('registration_video')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('registration_bg');
            $table->dropColumn('regiatration_fontcolor');
            $table->dropColumn('registration_boxbgcolor');
            $table->dropColumn('registration_video');
        });
    }
};
