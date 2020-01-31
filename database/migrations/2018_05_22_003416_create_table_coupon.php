<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCoupon extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupon', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('enable')->unsigned();
            $table->string('code');
            $table->tinyInteger('limit_coupon')->unsigned();
            $table->integer('minimum_checkout')->unsigned();
            $table->string('type');
            $table->decimal('value', 10, 2);
            $table->tinyInteger('percent_off')->unsigned();
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
        Schema::dropIfExists('coupon');
    }
}
