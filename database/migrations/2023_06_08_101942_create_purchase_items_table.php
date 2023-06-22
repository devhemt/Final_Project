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
        Schema::create('purchase_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('purchase_id')->unsigned();
            $table->integer('prd_id')->unsigned();
            $table->smallInteger('quantity');
            $table->float('unit_price');
            $table->tinyInteger('batch');
            $table->timestamps();
            $table->foreign('purchase_id')
                ->references('id')->on('purchase')
                ->onDelete('cascade');
            $table->foreign('prd_id')
                ->references('id')->on('product')
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
        Schema::dropIfExists('purchase_items');
    }
};
