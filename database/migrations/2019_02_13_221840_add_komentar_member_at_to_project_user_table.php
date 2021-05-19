<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddKomentarMemberAtToProjectUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_user', function (Blueprint $table) {
            $table->text('komentar_user');
            $table->integer('contributor_id');
            $table->text('komentar_contributor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_user', function (Blueprint $table) {
            //
        });
    }
}
