<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWxBindsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wx_binds', function (Blueprint $table) {
            $table->increments('id');
            $table->string('openid');
            $table->string('cardid');
            $table->timestamps();

            $table->unique('openid');
            $table->unique('cardid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wx_binds');
    }
}
