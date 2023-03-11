<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAntrianPolikliniksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('antrian_polikliniks', function (Blueprint $table) {
            $table->id();
            $table->string('nama_dokter');
            $table->string('waktu_praktek');
            $table->string('jenis_poli');
            $table->string('nama_pasien');
            $table->string('status_panggil')->nullable()->default('Menunggu');
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
        Schema::dropIfExists('antrian_polikliniks');
    }
}
