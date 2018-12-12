<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->enum('type', ['discount', 'free']);
            $table->tinyInteger('discount')->nullable();
            $table->string('code', 255);
            $table->tinyInteger('is_active')->default('1');
            $table->smallInteger('vcoaches')->nullable();
            $table->smallInteger('sessions')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupons');
    }
}
