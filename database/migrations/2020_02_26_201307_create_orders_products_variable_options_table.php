<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersProductsVariableOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_products_variable_options', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('increase_value', 8,2)->nullable();
            $table->double('decrease_value', 8,2)->nullable();
            $table->integer('variable_option_id');
            $table->foreign('variable_option_id')->references('id')->on('variable_options')->onDelete('cascade');
            $table->integer('orders_products_variable_id');
            $table->foreign('orders_products_variable_id')->references('id')->on('orders_products_variable');
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
        Schema::dropIfExists('orders_products_variable_options');
    }
}
