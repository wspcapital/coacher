<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('user_id')->unsignet();
            $table->enum('status', ['unpaid', 'succeeded', 'failed'])->default('unpaid');
            $table->enum('system', ['stripe'])->default('stripe');
            $table->integer('amount')->unsignet();
            $table->enum('currency', ['usd', 'gbp', 'eur'])->default('usd');
            $table->integer('vcoaches_qty')->unsignet()->default(0);
            $table->integer('sessions_qty')->unsignet()->default(0);
            $table->text('description')->nullable();
            $table->integer('coupon_id')->nullable();
            $table->string('failure_code', 255)->nullable();
            $table->text('failure_message')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
