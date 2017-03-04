<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminListsChildTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_lists_child', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('list_id');
            $table->string('name');
            $table->string('icon')->default('');
            $table->string('act');
            $table->unsignedTinyInteger('sort')->default(0);
            $table->unsignedTinyInteger('gnum')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_lists_child');
    }
}
