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
        Schema::create('properties', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('prd_id')->unsigned();
            $table->string('size',20);
            $table->string('color',20);
            $table->tinyInteger('batch');
            $table->smallInteger('amount');
            $table->timestamps();
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
        Schema::dropIfExists('properties');
    }
};
