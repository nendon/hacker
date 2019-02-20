<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableContributorNotif extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contributor_notif', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contributor_id')->unsigned();
            $table->string('category');
            $table->string('title');
            $table->string('notif');
            $table->boolean('status')->unsigned();
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
        Schema::dropIfExists('contributor_notif');
    }
}
