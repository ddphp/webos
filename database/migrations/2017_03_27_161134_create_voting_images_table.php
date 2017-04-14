<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVotingImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voting_images', function (Blueprint $table) {
            $table->increments('id');
            $table->char('md5', 32);
            $table->string('path');
            $table->string('name');
            $table->string('ext');
            $table->string('mime');
            $table->unsignedInteger('size');
            $table->timestamps();

            $table->unique('md5');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('voting_images');
    }
}
