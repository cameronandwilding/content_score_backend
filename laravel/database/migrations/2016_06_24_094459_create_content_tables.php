<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feeds', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url');
            $table->timestamps();
        });

        Schema::create('contents', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('feed_id')->unsigned();
            $table->foreign('feed_id')->references('id')->on('feeds');

            $table->string('url');

            $table->timestamps();
        });

        Schema::create('scores', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('content_id')->unsigned();
            $table->foreign('content_id')->references('id')->on('contents');

            $table->string('keyword');

            $table->integer('weight');

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
        Schema::drop('scores');
        Schema::drop('contents');
        Schema::drop('feeds');
    }
}
