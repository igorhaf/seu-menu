<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersDeliveryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_delivery', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('reference')->nullable();
            $table->string('name');
            $table->string('cellphone');
            $table->string('payment_type');
            $table->string('payment_method')->nullable();
            $table->double('money_change', 8,2)->nullable();
            $table->string('credit_card_flag')->nullable();
            $table->boolean('pickup');
            $table->string('postal_code')->nullable();
            $table->string('address')->nullable();
            $table->string('number')->nullable();
            $table->string('complement')->nullable();
            $table->string('district')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->integer('status_id')->nullable();
            $table->string('reference_point')->nullable();
            $table->string('delivery_tax')->nullable();
            $table->text('observations')->nullable();
            $table->integer('customer_id');
            $table->foreign('customer_id')->references('id')->on('customers');
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
        Schema::dropIfExists('orders_delivery');
    }
}
