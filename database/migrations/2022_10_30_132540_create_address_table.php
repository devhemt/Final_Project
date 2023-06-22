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
        Schema::create('address', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->unsigned()->nullable(true);
            $table->integer('guest_id')->unsigned()->nullable(true);
            $table->String('province',200);
            $table->String('district',200);
            $table->String('wards',200);
            $table->String('detailed_address',200);
            $table->timestamps();
            $table->foreign('customer_id')
                ->references('id')->on('customer')
                ->onDelete('cascade');
            $table->foreign('guest_id')
                ->references('id')->on('guest')
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
        Schema::dropIfExists('address');
    }
};
