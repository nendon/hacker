<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMemberIdToQuizDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quiz_detail', function (Blueprint $table) {
            $table->integer('exercise_id')->before('created_at')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quiz_detail', function (Blueprint $table) {
            $table->dropColumn('exercise_id')->before('created_at');

        });
    }
}
