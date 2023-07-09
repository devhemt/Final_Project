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
        Schema::create('invoice', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->unsigned()->nullable(true);
            $table->integer('guest_id')->unsigned()->nullable(true);
            $table->integer('address_id')->unsigned();
            $table->string('invoice_code')->unique(true);
            $table->float('pay')->comment("tiền khách phải trả");
            $table->float('true_pay')->comment("giá trị thực của đơn hàng");
            $table->string('see',50)->nullable()->comment("cột này chắc là đang xem");
            $table->string('payment',50);
            $table->string('delivery',50);
            $table->timestamps();
            $table->foreign('customer_id')
                  ->references('id')->on('customer')
                  ->onDelete('cascade');
            $table->foreign('guest_id')
                ->references('id')->on('guest')
                ->onDelete('cascade');
            $table->foreign('address_id')
                ->references('id')->on('address')
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
        Schema::dropIfExists('invoice');
    }
};
