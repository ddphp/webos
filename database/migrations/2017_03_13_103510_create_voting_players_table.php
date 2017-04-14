<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVotingPlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voting_players', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('activity_id');
            $table->string('number');
            $table->string('name');
            $table->string('thumb')->default('');
            $table->unsignedInteger('vote')->default(0);
            $table->string('openid')->default('');
            $table->timestamps();

            $table->unique(['activity_id', 'number']);
            $table->index('activity_id');
            $table->index('name');
            $table->index('vote');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('voting_players');
    }
}
