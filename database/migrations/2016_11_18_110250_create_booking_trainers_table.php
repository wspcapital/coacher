<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingTrainersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_trainers', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('user_id')
                ->references('id')->on('users');
            $table->integer('booking_id')
                ->references('id')->on('bookings')
                ->onDelete('cascade');
            $table->enum('hotel_book', ['0','1'])->default('0');
            $table->string('hotel_name', 250)->nullable();
            $table->string('hotel_address', 512)->nullable();
            $table->enum('flight_book', ['0','1'])->default('0');
            $table->text('flight_info')->nullable();
            $table->enum('car_rental_book', ['0','1'])->default('0');
            $table->enum('car_rental', ['0','1'])->default('0');
            $table->string('note', 250)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('booking_trainers');
    }
}
