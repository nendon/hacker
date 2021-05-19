<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableViewers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('viewers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('video_id')->unsigned();
            $table->integer('member_id')->unsigned();
            $table->ipAddress('ip_address');
            $table->integer('hits')->unsigned();
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
        Schema::dropIfExists('viewers');
    }
}
