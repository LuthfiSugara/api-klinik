<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('password');
            $table->date('tanggal_lahir');
            $table->integer('id_gender');
            $table->integer('id_level');
            $table->string('no_hp');
            $table->string('berat_badan')->nullable();
            $table->string('tinggi_badan')->nullable();
            $table->string('foto')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            // $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
