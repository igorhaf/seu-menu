<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_points', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('district');
            $table->text('observations')->nullable();
            $table->integer('position')->unsigned();
            $table->boolean('visible')->default(true);
            $table->double('tax', 8,2)->nullable();
            $table->integer('delivery_city_id');
            $table->foreign('delivery_city_id')->references('id')->on('delivery_cities')->onDelete('cascade');
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
        Schema::dropIfExists('delivery_points');
    }
}
