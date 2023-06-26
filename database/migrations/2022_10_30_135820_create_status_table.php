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
        Schema::create('status', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('invoice_id')->unsigned();
            $table->tinyInteger('status');
            $table->timestamps();
            $table->foreign('invoice_id')
                  ->references('id')->on('invoice')
                  ->onDelete('cascade');
        });
    }
//        0=cancelled 1=pending 2=confirmed 3=packing 4=delivery 5=delivered 6=delivery failed 7=return
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('status');
    }
};
