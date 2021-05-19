<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableServices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('status')->unsigned();
            $table->integer('member_id')->unsigned();
            $table->integer('invoice_id')->unsigned();
            $table->string('title');
            $table->decimal('price', 10, 2);
            $table->date('start');
            $table->date('expired');
            $table->boolean('access')->unsigned();
            $table->boolean('update')->unsigned();
            $table->boolean('chat')->unsigned();
            $table->boolean('download')->unsigned();
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
        Schema::dropIfExists('services');
    }
}
