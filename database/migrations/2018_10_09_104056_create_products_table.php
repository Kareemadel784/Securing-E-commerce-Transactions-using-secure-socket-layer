<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('count');
            $table->decimal('price');
            $table->decimal('pricebuy');
            $table->decimal('offer')->defult(0.0);
            $table->integer('pinding')->defult(0);
            $table->integer('statues')->defult(0);
            $table->integer('subcategory_id')->unsigned();
            $table->integer('categore_id')->unsigned();
            $table->timestamps();
            $table->foreign('categore_id')->references('id')->on('categories')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('subcategory_id')->references('id')->on('sub_categories')
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
        Schema::dropIfExists('products');
    }
}
