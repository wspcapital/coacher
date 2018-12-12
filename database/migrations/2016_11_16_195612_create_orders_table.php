<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->dateTime('due_at')->nullable();
            $table->integer('booking_participants_id')
                ->references('id')->on('booking_participants');
            $table->integer('order_trainer_id')->nullable()
                ->references('id')->on('users');
            $table->tinyInteger('status')->default(0);
            $table->enum('type', ['Video','Session','Package']);
            $table->enum('source', ['Bulk','Contract','Portal','Store']);
            $table->longText('data')->nullable();
            $table->string('timezone', 64)->nullable();
            $table->text('admin_notes')->nullable();
            $table->text('coach_notes')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
