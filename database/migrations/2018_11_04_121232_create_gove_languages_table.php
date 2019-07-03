<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoveLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gove_languages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('gove');
            $table->integer('gove_id')->unsigned();
            $table->integer('language_id')->unsigned();
            $table->timestamps();
            $table->foreign('language_id')->references('id')->on('languages')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('gove_id')->references('id')->on('goves')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gove_languages');
    }
}
