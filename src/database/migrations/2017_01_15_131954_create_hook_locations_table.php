<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHookLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hook_locations', function(Blueprint $blueprint)
        {
            $blueprint->increments('id');
            $blueprint->integer('hook_id')->unsigned();
            $blueprint->string('location');
            $blueprint->string('namespace');
            $blueprint->string('method');

            $blueprint->foreign('hook_id')
                ->references('id')
                ->on('hooks')
                ->onDelete('cascade');

            $blueprint->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hook_locations');
    }
}
