<?php

use Illuminate\Support\Facades\Schema,
    Illuminate\Database\Schema\Blueprint,
    Illuminate\Database\Migrations\Migration;

/**
 * Class UserAssetsTable
 */
class UserAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_assets', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('asset_id')->unsigned();
            $table->integer('user_id');
            $table->enum('type', ['Admin', 'User']);
            $table->string('title')->nullable();
            $table->integer('category_id')->nullable();
            $table->text('description')->nullable();
            $table->enum('blocked', ['0', '1']);
            $table->dateTime('expires');

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
        Schema::dropIfExists('user_assets');
    }
}
