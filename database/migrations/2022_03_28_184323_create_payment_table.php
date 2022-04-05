<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment', function (Blueprint $table) {
            $table->increments('paymentID');
            $table->bigInteger('orderID')->unsigned();
            $table->foreign('orderID')->references('id')->on('orders')->onDelete('cascade');
            $table->String('applyVoucher')->nullable();
            $table->double("voucherDiscount", 8, 2);
            $table->double("serviceTax", 8, 2)->nullable();
            $table->double("PaymentTotal", 8, 2);
            $table->string('paymentStatus');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment');
    }
}
