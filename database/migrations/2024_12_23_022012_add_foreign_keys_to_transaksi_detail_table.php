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
        Schema::table('transaksi_detail', function (Blueprint $table) {
            $table->foreign(['id_transaksi'], 'transaksi_detail_ibfk_1')->references(['id_transaksi'])->on('transaksi');
            $table->foreign(['id_transaksi'], 'fk_transaksi')->references(['id_transaksi'])->on('transaksi');
            $table->foreign(['id_produk'], 'transaksi_detail_ibfk_2')->references(['id_produk'])->on('produk');
            $table->foreign(['id_produk'], 'fk_produk')->references(['id_produk'])->on('produk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaksi_detail', function (Blueprint $table) {
            $table->dropForeign('transaksi_detail_ibfk_1');
            $table->dropForeign('fk_transaksi');
            $table->dropForeign('transaksi_detail_ibfk_2');
            $table->dropForeign('fk_produk');
        });
    }
};
