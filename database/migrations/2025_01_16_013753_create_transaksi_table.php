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
            $table->dateTime('tanggal_waktu')->nullable()->useCurrent();
            $table->string('nomor_transaksi', 20)->nullable()->unique('nomor_transaksi');
            $table->bigInteger('total')->nullable();
            $table->string('nama_user', 100)->nullable();
            $table->string('nama_pembeli')->nullable();
            $table->bigInteger('bayar')->nullable();
            $table->bigInteger('kembali')->nullable();
            $table->integer('no_customer')->nullable();
            $table->enum('tipe', ['masuk', 'keluar']);
            $table->enum('status', ['pending', 'selesai'])->nullable()->default('pending');
            $table->integer('created_by')->nullable()->index('created_by');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->useCurrent();
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
