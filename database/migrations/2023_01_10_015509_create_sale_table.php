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
        Schema::create('sale', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('prd_id')->unsigned();
            $table->integer('customer_id')->unsigned()->nullable(true);
            $table->tinyInteger('discount');
            $table->timestamp('begin')->nullable();
            $table->timestamp('end')->nullable();
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
        Schema::dropIfExists('sale');
    }
};
