<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemAdditionalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_additionals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->double('increase_value', 8,2)->nullable();
            $table->double('decrease_value', 8,2)->nullable();
            $table->integer('position')->unsigned();
            $table->boolean('visible')->default(true);
            $table->integer('menu_item_id');
            $table->foreign('menu_item_id')->references('id')->on('menu_itens')->onDelete('cascade');
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
        Schema::dropIfExists('item_additionals');
    }
}
