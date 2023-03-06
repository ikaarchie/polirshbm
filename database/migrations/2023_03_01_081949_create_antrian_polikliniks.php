<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAntrianPolikliniks extends Migration
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
            $table->string('namadokter');
            $table->string('pembayaran');
            $table->string('namapasien');
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
