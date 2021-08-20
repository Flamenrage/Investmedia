<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->string('title'); //название
            $table->string('slug')->unique(); //food
            $table->text('description'); //большое текстовое поле
            $table->text('content'); //большое текстовое поле
            $table->integer('category_id')->unsigned(); //беззнаковое
            $table->integer('views')->unsigned()->default(0);
            $table->string('thumbnail')->nullable(); //необязательна
            $table->timestamps();

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
