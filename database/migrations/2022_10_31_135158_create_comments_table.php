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
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('prd_id')->unsigned();
            $table->integer('customer_id')->unsigned();
            $table->tinyInteger('status')->comment('0 = ko hiển thị, 1 = hiển thị');
            $table->text('comment');
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
        Schema::dropIfExists('commets');
    }
};
