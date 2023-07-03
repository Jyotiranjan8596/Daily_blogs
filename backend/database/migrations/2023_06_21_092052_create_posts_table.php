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
            $table->id('post_id');

            $table->unsignedBigInteger('id')->foreign('id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('cat_id')->foreign('cat_id')->references('cat_id')->on('categories');

            $table->string('title');

            $table->string('full_img');
            $table->string('video');
            $table->text('detail');
            $table->string('tags');

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
