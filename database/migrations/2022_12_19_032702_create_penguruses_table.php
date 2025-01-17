<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penguruses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nik')->nullable();
            $table->string('nama')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->string('tanggal_lahir')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('foto')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('alamat')->nullable();
            $table->string('pendidikan')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('from')->nullable();
            $table->string('to')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('penguruses');
    }
};
