<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersProductsVariableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_products_variable', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('item_variable_id');
            $table->foreign('item_variable_id')->references('id')->on('item_variables')->onDelete('cascade');
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
        Schema::dropIfExists('orders_products_variable');
    }
}
