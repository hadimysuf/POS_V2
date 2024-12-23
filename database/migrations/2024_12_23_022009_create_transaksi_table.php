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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->integer('id_transaksi', true);
            $table->dateTime('tanggal_waktu');
            $table->string('nomor_transaksi', 10);
            $table->bigInteger('total');
            $table->string('nama_user', 100);
            $table->bigInteger('bayar');
            $table->bigInteger('kembali');
            $table->integer('no_customer');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi');
    }
};
