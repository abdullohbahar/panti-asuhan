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
        Schema::create('saving_histories', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('anak_asuh_id')->onUpdate('cascade')->onDelete('set null');
            $table->foreignUuid('saving_id')->onUpdate('cascade')->onDelete('set null');
            $table->date('tanggal');
            $table->integer('mengambil')->nullable();
            $table->integer('menabung')->nullable();
            $table->integer('saldo')->nullable();
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
        Schema::dropIfExists('saving_histories');
    }
};
