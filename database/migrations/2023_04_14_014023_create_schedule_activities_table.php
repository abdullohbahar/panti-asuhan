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
        Schema::create('schedule_activities', function (Blueprint $table) {
            $table->uuid('id');
            $table->integer('nomor_urut')->nullable();
            $table->date('tanggal')->nullable();
            $table->text('acara')->nullable();
            $table->string('pengundang')->nullable();
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
        Schema::dropIfExists('schedule_activities');
    }
};
