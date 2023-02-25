<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePanggilAntrianPolikliniksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('panggil_antrian_polikliniks', function (Blueprint $table) {
            $table->id();
            $table->string('namadokter');
            $table->string('pembayaran');
            $table->string('namapasien');
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
        Schema::dropIfExists('panggil_antrian_polikliniks');
    }
}
