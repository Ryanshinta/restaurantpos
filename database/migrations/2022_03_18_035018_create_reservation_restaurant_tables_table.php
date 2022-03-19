<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationRestaurantTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation_restaurant_tables', function (Blueprint $table) {
            $table->id();
            $table->string('reserveId');
            $table->string('tableNo');
            
            $table->foreign('reserveId')->references('reserveId')->on('reservations')->onDelete('cascade');
            $table->foreign('tableNo')->references('tableNo')->on('restauranttables')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservation_restaurant_tables');
    }
}
