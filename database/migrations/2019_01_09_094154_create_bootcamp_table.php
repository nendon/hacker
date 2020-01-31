<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBootcampTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bootcamp', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bootcamp_category_id')->nullable();
            $table->integer('bootcamp_sub_category_id')->nullable();
            $table->integer('contributor_id')->nullable();
            $table->integer('status')->nullable();
            $table->string('title', 50)->nullable();
            $table->string('slug')->nullable();
            $table->string('sub_title', 50)->nullable();
            $table->string('cover')->nullable();
            $table->decimal('price', 10, 0)->nullable();
            $table->string('promote_video')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('audience')->nullable();
            $table->text('pre_and_req')->nullable();
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
        Schema::dropIfExists('bootcamp');
    }
}
