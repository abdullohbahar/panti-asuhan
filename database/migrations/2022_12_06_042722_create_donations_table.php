<?php

use App\Models\BuktiSumbangan;
use App\Models\DonationType;
use App\Models\Donatur;
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
        Schema::create('donations', function (Blueprint $table) {
            $table->uuid('id');
            $table->foreignUuid('donatur_id')->nullable()->onUpdate('cascade')->onDelete('set null');
            $table->string('no')->nullable();
            $table->string('jenis_donasi')->nullable();
            $table->text('terbilang')->nullable();
            $table->integer('pemasukan')->nullable();
            $table->integer('pengeluaran')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('tipe')->nullable();
            $table->date('tanggal_donasi');
            $table->integer('urutan')->autoIncrement();
            $table->string('transaksi');
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
        Schema::dropIfExists('donations');
    }
};
