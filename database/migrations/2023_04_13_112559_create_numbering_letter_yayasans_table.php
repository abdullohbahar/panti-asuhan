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
        Schema::create('numbering_letter_yayasans', function (Blueprint $table) {
            $table->id();
            $table->integer('nomor');
            $table->date('tgl_keluar');
            $table->string('perihal');
            $table->string('tujuan');
            $table->string('kode')->default('Yys');
            $table->text('file');
            $table->text('filename');
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
        Schema::dropIfExists('numbering_letter_yayasans');
    }
};
