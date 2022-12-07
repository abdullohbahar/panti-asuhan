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
            $table->foreignUuid('donatur_id')->onUpdate('cascade')->onDelete('set null');;
            $table->foreignUuid('donation_type_id')->onUpdate('cascade')->onDelete('set null');;
            $table->foreignUuid('bukti_sumbangan_id')->onUpdate('cascade')->onDelete('set null');;
            $table->integer('nominal');
            $table->text('keterangan');
            $table->date('tanggal_sumbangan');
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
