<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVotingPlayersContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voting_players_content', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('players_id');
            $table->string('desc')->default('');
            $table->text('detail');
            $table->text('ext');
            $table->timestamps();

            $table->unique('layers_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('voting_players_content');
    }
}
