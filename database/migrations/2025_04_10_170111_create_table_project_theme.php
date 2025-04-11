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
        Schema::create('project_theme', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->string('background_menu');
            $table->string('background_btn_menu');
            $table->string('background_btn_menu_hover');
            $table->string('text_btn_menu');
            $table->string('background_top');
            $table->string('background_footer');
            $table->string('logo');
            $table->string('background_box');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_project_theme');
    }
};
