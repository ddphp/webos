<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVotingActivityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voting_activity', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('banner');
            $table->date('sdate');
            $table->date('edate');
            $table->unsignedTinyInteger('type');
            $table->unsignedSmallInteger('tot');
            $table->unsignedSmallInteger('num');
            $table->unsignedSmallInteger('vote');
            $table->string('skin')->default('');
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
        Schema::dropIfExists('voting_activity');
    }
}
