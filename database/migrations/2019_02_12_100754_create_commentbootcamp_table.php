<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentbootcampTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments_bootcamp', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bootcamp_id')->unsigned()->nullable();
            $table->integer('member_id')->unsigned()->nullable();
            $table->integer('contributor_id')->unsigned()->nullable();
            $table->text('body');
            $table->integer('parent_id')->unsigned();
            $table->boolean('status')->nullable();
            $table->integer('desc')->nullable();
            $table->string('images')->nullable();
            $table->string('file_name')->nullable();
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
        Schema::dropIfExists('comments_bootcamp');
    }
}
