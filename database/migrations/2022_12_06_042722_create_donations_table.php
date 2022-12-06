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
            $table->foreignIdFor(Donatur::class)->onUpdate('cascade')->onDelete('set null');;
            $table->foreignIdFor(DonationType::class)->onUpdate('cascade')->onDelete('set null');;
            $table->foreignIdFor(BuktiSumbangan::class)->onUpdate('cascade')->onDelete('set null');;
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
