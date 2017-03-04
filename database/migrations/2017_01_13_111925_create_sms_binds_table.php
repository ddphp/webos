<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmsBindsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_binds', function (Blueprint $table) {
            $table->increments('id');
            $table->string('openid');
            $table->string('phone');
            $table->string('code');
            $table->tinyInteger('sent_times');
            $table->tinyInteger('verify_times');
            $table->date('created_time');
            $table->timestamp('updated_time');

            $table->unique('openid');
            $table->index('created_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sms_binds');
    }
}
