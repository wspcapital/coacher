<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('category_id')
                ->references('id')->on('categories');
            $table->string('alias', 255);
            $table->string('title', 255)->default('');
            $table->string('subtitle', 512)->default('');
            $table->text('content')->nullable();
            $table->enum('visible', ['0', '1'])->default('1');
            $table->char('lang', 8)->default('en');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
