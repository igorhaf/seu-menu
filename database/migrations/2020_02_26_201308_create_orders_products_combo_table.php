<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersProductsComboTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_products_combo', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('orders_products_id');
            $table->foreign('orders_products_id')->references('id')->on('orders_products');
            $table->integer('combo_menu_item_id');
            $table->foreign('combo_menu_item_id')->references('id')->on('menu_itens');
            $table->integer('quantity')->unsigned();
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
        Schema::dropIfExists('orders_products_combo');
    }
}
