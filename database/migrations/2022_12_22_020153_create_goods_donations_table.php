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
        Schema::create('goods_donations', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('no');
            $table->foreignUuid('donatur_id')->onUpdate('cascade')->onDelete('set null');
            $table->text('keterangan')->nullable();
            $table->date('tanggal_donasi')->nullable();
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
        Schema::dropIfExists('goods_donations');
    }
};
