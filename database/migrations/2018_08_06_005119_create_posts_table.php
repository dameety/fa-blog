<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

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

            $table->longText('body');
            $table->string('title')->unique();
            $table->string('slug')->nullable();
            $table->text('excerpt')->nullable();
            $table->string('status')->nullable();
            $table->string('is_featured')->nullable();
            $table->string('is_slidable')->nullable();

            $table->string('reading_duration')->nullable();

            $table->timestamp('published_at')->nullable();

            $table->integer('author_id')->nullable()->unsigned();
            $table->foreign('author_id')->references('id')->on('users');

            $table->timestamps();
            $table->softDeletes();
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
