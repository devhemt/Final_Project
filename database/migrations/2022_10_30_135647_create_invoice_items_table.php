<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('property_id')->unsigned();
            $table->integer('invoice_id')->unsigned();
            $table->string('size',20);
            $table->string('color',20);
            $table->smallInteger('amount');
            $table->timestamps();
            $table->foreign('property_id')
                  ->references('id')->on('properties')
                  ->onDelete('cascade');
            $table->foreign('invoice_id')
                  ->references('id')->on('invoice')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_items');
    }
};
