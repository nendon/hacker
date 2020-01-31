<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNormalPriceToBootcampTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bootcamp', function (Blueprint $table) {
          $table->string('normal_price')->before('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bootcamp', function (Blueprint $table) {
            $table->dropColumn('normal_price')->before('created_at');
        });
    }
}
