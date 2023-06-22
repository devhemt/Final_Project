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
        Schema::create('cart_memory', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('prd_id')->unsigned();
            $table->integer('customer_id')->unsigned();
            $table->string('size',20);
            $table->string('color',20);
            $table->smallInteger('amount');
            $table->timestamps();
            $table->foreign('prd_id')
                ->references('id')->on('product')
                ->onDelete('cascade');
            $table->foreign('customer_id')
                ->references('id')->on('customer')
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
        Schema::dropIfExists('cart_memory');
    }
};
