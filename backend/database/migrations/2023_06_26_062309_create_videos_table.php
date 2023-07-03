<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id('videos_id');

            $table->unsignedBigInteger('id')->foreign('id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('post_id')->foreign('post_id')->references('post_id')->on('posts');


            $table->string('videos');
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
        Schema::dropIfExists('videos');
    }
}
