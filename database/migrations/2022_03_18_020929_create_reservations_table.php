<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->string('reserveId')->primary();
            $table->string('reserveDate');
            $table->string('reserveSlot');
            $table->string('reserveStatus')->default("Pending");
            $table->integer('noTableReserve');
            $table->integer('noOfCust');
            $table->string('custName');
            $table->string('custMobile');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
