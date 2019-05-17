<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCicilanDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cicilan_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cicilan_id');
            $table->date('tgl_tempo');
            $table->date('tgl_bayar');
            $table->string('total_cicilan');
            $table->integer('status');
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
        Schema::dropIfExists('cicilan_detail');
    }
}
