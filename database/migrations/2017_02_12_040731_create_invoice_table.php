<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('invoice', function (Blueprint $table) {
          $table->increments('id');
          $table->boolean('status')->unsigned()->default(0);
          $table->string('code');
          $table->integer('member_id')->unsigned();
        //   $table->integer('lesson_id')->unsigned();
          $table->decimal('price', 10, 2);
          $table->string('type')->nullable();
          $table->string('notes')->nullable();
          $table->boolean('promo')->unsigned()->nullable();
        //   $table->string('description')->nullable();
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
        Schema::dropIfExists('invoice');
    }
}
