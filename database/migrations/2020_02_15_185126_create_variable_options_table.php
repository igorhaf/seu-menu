<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVariableOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('variable_options', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('option');
            $table->double('increase_value', 8,2)->nullable();
            $table->double('decrease_value', 8,2)->nullable();
            $table->integer('position')->unsigned();
            $table->boolean('visible')->default(true);
            $table->integer('item_variable_id');
            $table->foreign('item_variable_id')->references('id')->on('item_variables')->onDelete('cascade');
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
        Schema::dropIfExists('variable_options');
    }
}
