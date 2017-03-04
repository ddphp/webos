<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_images', function (Blueprint $table) {
            $table->increments('id');
            $table->char('sha1', 40);
            $table->string('file');
            $table->string('ext');
            $table->string('mime');
            $table->timestamps();

            $table->unique('sha1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_iamges');
    }
}
