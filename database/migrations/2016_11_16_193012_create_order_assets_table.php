<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_assets', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('orders_id');
            $table->string('title')->nullable();
            $table->integer('assets_id')->unsigned();
            $table->text('description')->nullable();
            $table->enum('blocked', ['0', '1']);
            $table->dateTime('expires')->nullable();
            $table->integer('category_id');

            $table->foreign('assets_id')
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
        Schema::dropIfExists('order_assets');
    }
}
