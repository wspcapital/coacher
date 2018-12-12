<?php

use Illuminate\Support\Facades\Schema,
    Illuminate\Database\Schema\Blueprint,
    Illuminate\Database\Migrations\Migration;

/**
 * Class CreateCategoriesTable
 */
class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('parent_id')->nullable()->unsigned();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->enum('type', ['Booking', 'Library', 'User', 'Order', 'CMS']);
            $table->enum('blocked', ['0', '1']);

            $table->foreign('parent_id')
                ->references('id')->on('categories')
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
        Schema::dropIfExists('categories');
    }
}
