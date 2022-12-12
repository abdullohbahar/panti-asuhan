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
        Schema::create('history_of_taking_savings', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('anak_asuh_id')->onUpdate('cascade')->onDelete('set null');
            $table->integer('nominal');
            $table->date('tanggal_mengambil');
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
        Schema::dropIfExists('history_of_taking_savings');
    }
};
