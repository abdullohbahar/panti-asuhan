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
        Schema::create('outgoing_letter_lksas', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat');
            $table->string('nomor_urutan')->nullable();
            $table->string('tanggal');
            $table->string('perihal');
            $table->string('tujuan');
            $table->string('file');
            $table->string('tanggal_diterima')->nullable();
            $table->string('disposisi_penugasan')->nullable();
            $table->string('file_dokumentasi')->nullable();
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
        Schema::dropIfExists('outgoing_letter_lksas');
    }
};
