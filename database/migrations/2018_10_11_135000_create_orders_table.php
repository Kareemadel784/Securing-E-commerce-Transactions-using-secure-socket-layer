<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('stutas')->defult(0);
            $table->decimal('totalprice');
            $table->string('address');
            $table->integer('client_id')->unsigned();
            $table->integer('quentety');
            $table->integer('captin_id')->unsigned();
            $table->integer('village_id')->unsigned();
            $table->timestamps();
            $table->foreign('captin_id')->references('id')->on('captins')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('client_id')->references('id')->on('clients')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('village_id')->references('id')->on('villages')
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
        Schema::dropIfExists('orders');
    }
}
