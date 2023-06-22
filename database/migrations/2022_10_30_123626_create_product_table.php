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
        Schema::create('product', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned();
            $table->smallInteger('sell')->comment('0 = khong ban, 1 = ban');
            $table->string('demo_image',200);
            $table->string('name',150);
            $table->text('description');
            $table->float('price');
            $table->string('tag');
            $table->string('brand',100);
            $table->timestamps();
            $table->foreign('category_id')
                ->references('id')->on('category');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
};
