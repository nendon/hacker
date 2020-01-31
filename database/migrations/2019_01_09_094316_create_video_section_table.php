<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideoSectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_section', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('section_id');
            $table->string('title');
            $table->string('file_video');
            $table->string('image_video');
            $table->integer('durasi');
            $table->string('type_video');
            $table->string('type');
            $table->bigInteger('position');
            $table->text('deskripsi_video');
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
        Schema::dropIfExists('video_section');
    }
}
