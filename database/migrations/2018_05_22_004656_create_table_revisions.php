<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRevisions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revisions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lession_id')->unsigned();
            $table->string('title');
            $table->text('notes');
            $table->boolean('status')->unsigned();
            $table->string('admin');
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
        Schema::dropIfExists('revisions');
    }
}
