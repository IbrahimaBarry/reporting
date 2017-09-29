<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lots', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('num')->unsigned();
            $table->integer('nbrDoc')->unsigned()->nullable();
            $table->integer('nbrPage')->unsigned()->nullable();
            $table->integer('time')->unsigned()->default(0);
            $table->string('observation')->nullable();
            $table->boolean('completed')->default(false);
            $table->integer('projet_id')->unsigned();
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('projet_id')->references('id')->on('projets')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('lots');
    }
}
