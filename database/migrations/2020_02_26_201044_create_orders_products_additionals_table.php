<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersProductsAdditionalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_products_additionals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('increase_value', 8,2)->nullable();
            $table->double('decrease_value', 8,2)->nullable();
            $table->integer('quantity');
            $table->integer('item_additional_id');
            $table->foreign('item_additional_id')->references('id')->on('item_additionals')->onDelete('cascade');
            $table->integer('orders_products_id');
            $table->foreign('orders_products_id')->references('id')->on('orders_products');
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
        Schema::dropIfExists('orders_products_additionals');
    }
}
