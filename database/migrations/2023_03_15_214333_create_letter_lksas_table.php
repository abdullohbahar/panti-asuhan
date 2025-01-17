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
        Schema::create('letter_lksas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pengirim');
            $table->text('perihal_surat');
            $table->text('nomor_surat');
            $table->text('isi_surat');
            $table->date('tanggal');
            $table->text('file');
            $table->string('tipe');
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
        Schema::dropIfExists('letter_lksas');
    }
};
