<?php

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
            $table->bigInteger('rating');
            $table->string('title', 30);
            $table->string('author');
            $table->string('privacy')->default('public');
            $table->string('title-slag')->unique();
            $table->text('content');
            $table->text('tag');
            $table->text('coordinates');
            $table->text('shopLink');
            $table->boolean('sex')->default(0);
            $table->text('images');
            $table->boolean('published');
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
        Schema::drop('posts');
    }
}
