<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_products', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->double('price', 8,2)->nullable();
            $table->integer('quantity');
            $table->integer('menu_item_id');
            $table->foreign('menu_item_id')->references('id')->on('menu_itens')->onDelete('cascade');
            $table->integer('orders_delivery_id');
            $table->foreign('orders_delivery_id')->references('id')->on('orders_delivery');
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
        Schema::dropIfExists('orders_products');
    }
}
