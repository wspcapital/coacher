<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_items', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('payment_id')->unsignet();
            $table->enum('type', ['video', 'session', 'package_1']);
            $table->integer('price')->unsignet();
            $table->integer('qty')->unsignet();
            $table->smallInteger('vcoaches')->unsignet()->default(0);
            $table->smallInteger('sessions')->unsignet()->default(0);
            $table->enum('is_active', ['0','1']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_items');
    }
}
