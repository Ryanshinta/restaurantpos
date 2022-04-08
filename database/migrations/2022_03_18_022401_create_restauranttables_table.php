<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestauranttablesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('restauranttables', function (Blueprint $table) {
            $table->integer('tableNo')->primary();
            $table->string('tableStatus')->default('Available');
            $table->string('tableType');
            $table->integer('maxSeats');
            $table->bigInteger('orderID')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('restauranttables');
    }

}
