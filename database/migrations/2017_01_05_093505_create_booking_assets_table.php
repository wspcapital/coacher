<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_assets', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('booking_id');
            $table->integer('asset_id')->unsigned();
            $table->enum('blocked', [0, 1]);
            $table->integer('category_id')->nullable();
            $table->dateTime('expires')->nullable();

            $table->foreign('asset_id')
                ->references('id')->on('assets')
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
        Schema::dropIfExists('booking_assets');
    }
}
