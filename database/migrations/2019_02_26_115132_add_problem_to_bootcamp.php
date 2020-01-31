<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProblemToBootcamp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bootcamp', function($table) {
            $table->text('problem')->after('deskripsi')->nullabel();
            $table->text('alasan')->nullabel();
            $table->string('silabus')->nullabel();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bootcamp', function($table) {
            $table->dropColumn('problem');
            $table->dropColumn('alasan');
            $table->dropColumn('silabus');

        });
    }
}
