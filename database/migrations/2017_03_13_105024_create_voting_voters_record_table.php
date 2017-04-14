<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVotingVotersRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voting_voters_record', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('voters_id');
            $table->unsignedInteger('players_id');
            $table->date('date');
            $table->unsignedInteger('vote')->default(0);
            $table->timestamps();

            $table->unique(['voters_id', 'players_id', 'date']);
            $table->index('voters_id');
            $table->index('players_id');
            $table->index('date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('voting_voters_record');
    }
}
