<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurvey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('survey', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('id_kecamatan');
            $table->unsignedBigInteger('id_pecahan');
            $table->integer('qlt');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('id_pecahan')->references('id')->on('pecahan');
            $table->foreign('id_kecamatan')->references('id')->on('kecamatan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('survey');
    }
}
