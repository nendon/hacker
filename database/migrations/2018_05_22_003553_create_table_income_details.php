<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableIncomeDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('income_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contributor_id')->unsigned();
            $table->tinyInteger('moth', 2);
            $table->year('year');
            $table->integer('total_view')->unsigned();
            $table->decimal('total_income', 10, 2)->unsigned();
            $table->boolean('status')->unsigned();
            $table->dateTime('transfer_date');
            $table->boolean('bank')->unsigned();
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
        Schema::table('income_details', function (Blueprint $table) {
            //
        });
    }
}
