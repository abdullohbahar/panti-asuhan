<?php

use App\Models\Akta;
use App\Models\KartuKeluarga;
use App\Models\Keluarga;
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
        Schema::create('anak_asuhs', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('nama_lengkap');
            $table->string('jenis_kelamin');
            $table->string('tempat_lahir')->nullable();
            $table->string('tanggal_lahir')->nullable();
            $table->text('alamat')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('status');
            $table->text('foto')->nullable();
            $table->string('nama_ayah_kandung')->nullable();
            $table->string('nama_ibu_kandung')->nullable();
            $table->string('nohp_ortu')->nullable();
            $table->string('pendidikan')->nullable();
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
        Schema::dropIfExists('anak_asuhs');
    }
};
