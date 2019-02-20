<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContributorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contributors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('password');
            $table->string('pekerjaan');
            $table->string('domisili');
            $table->text('deskripsi');
            $table->string('tempat_lahir');
            $table->string('tanggal_lahir');
            $table->boolean('status')->unsigned();
            $table->string('avatar');
            $table->integer('points')->unsigned();
            $table->string('token');
            $table->string('activation_token');
            $table->boolean('active')->unsigned();
            $table->rememberToken();
            $table->timestamps();
            /* $table->boolean('status')->default(0);
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->boolean('packages_status')->default(0);
            $table->integer('packages_id')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->boolean('active')->default(false);
            $table->string('activation_token')->nullable(); */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contributors');
    }
}
