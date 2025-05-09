<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemVariablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_variables', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('variable');
            $table->integer('menu_item_id');
            $table->integer('position')->unsigned();
            $table->boolean('visible')->default(true);
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
        Schema::dropIfExists('item_variables');
    }
}
