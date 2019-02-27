<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPictureBootcamp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bootcamp', function($table) {
        $table->text('picture_problem')->after('deskripsi')->nullabel();
        $table->text('picture_alasan')->after('problem')->nullabel();
        $table->string('picture_desk')->after('alasan')->nullabel();
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
            $table->dropColumn('picture_problem');
            $table->dropColumn('picture_alasan');
            $table->dropColumn('picture_desk');

        });
    }
}
