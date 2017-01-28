<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharactersMetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characters_metas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cid')->unsigned();
            $table->string('key');
            $table->string('value');

            $table->foreign('cid')
                ->references('id')->on('characters');

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
        Schema::dropIfExists('characters_metas');
    }
}
