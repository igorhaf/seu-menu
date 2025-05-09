<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('combos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('menu_item_id');
            $table->foreign('menu_item_id')->references('id')->on('menu_itens')->onDelete('cascade');
            $table->integer('combo_menu_item_id');
            $table->foreign('combo_menu_item_id')->references('id')->on('menu_itens')->onDelete('cascade');
            $table->integer('position')->unsigned();
            $table->integer('min')->nullable();
            $table->integer('max')->nullable();
            $table->boolean('visible')->default(true);
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
