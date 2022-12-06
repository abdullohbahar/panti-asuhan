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
            $table->string('tempat_lahir');
            $table->string('tanggal_lahir');
            $table->text('alamat');
            $table->text('keterangan');
            $table->string('status');
            $table->text('foto');
            $table->foreignIdFor(Akta::class)->onUpdate('cascade')->onDelete('set null');;
            $table->foreignIdFor(KartuKeluarga::class)->onUpdate('cascade')->onDelete('set null');;
            $table->foreignIdFor(Keluarga::class)->onUpdate('cascade')->onDelete('set null');;
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
