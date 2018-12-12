<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingCreditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_credits', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('credited_user_id')
                ->references('id')->on('users');
            $table->enum('type', ['Vcoach','Session']);
            /*$table->integer('booking_participant_id')
                ->references('id')->on('booking_participants')
                ->onDelete('cascade');*/
            $table->integer('booking_id')->nullable();
            $table->integer('user_id');
            $table->integer('amount')->unsignet();
            $table->string('comment', 512)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('booking_credits');
    }
}
