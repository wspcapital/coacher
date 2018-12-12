<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_days', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('booking_id')
                ->references('id')->on('bookings');
            $table->date('booking_date');
            $table->integer('lesson_id')
                ->references('id')->on('lessons');
            $table->time('time_start');
            $table->time('time_end');
            $table->string('color')->nullable();
            $table->string('title', 128)->nullable();
            $table->string('subtitle', 512)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('booking_days');
    }
}
