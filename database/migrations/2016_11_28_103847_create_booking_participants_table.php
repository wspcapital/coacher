<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_participants', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('booking_id')
                ->references('id')->on('bookings')
                ->onDelete('cascade');
            $table->integer('booking_trainers_id')->nullable()
                ->references('id')->on('booking_trainers');
            $table->integer('user_id')
                ->references('id')->on('users');
            $table->enum('type', ['Bulk','BookingSheet']);
            $table->string('share_hash', 256)->nullable();;
            $table->longText('data')->nullable();
            $table->tinyInteger('vcoaches')->default(0);
            $table->tinyInteger('sessions')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('booking_participants');
    }
}
