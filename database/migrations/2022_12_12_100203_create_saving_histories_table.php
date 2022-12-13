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
            $table->id();
            $table->foreignUuid('anak_asuh_id')->onUpdate('cascade')->onDelete('set null');
            $table->foreignUuid('saving_id')->onUpdate('cascade')->onDelete('set null');
            $table->integer('nominal');
            $table->string('status');
            $table->date('tanggal');
            $table->text('keterangan');
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
