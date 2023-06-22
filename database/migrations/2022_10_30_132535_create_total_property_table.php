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
        Schema::create('total_property', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('prd_id')->unsigned();
            $table->string('sizes');
            $table->string('colors');
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
        Schema::dropIfExists('total_property');
    }
};
