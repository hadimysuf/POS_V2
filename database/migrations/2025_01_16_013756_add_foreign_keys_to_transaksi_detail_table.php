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
            $table->foreign(['id_transaksi'], 'transaksi_detail_ibfk_1')->references(['id_transaksi'])->on('transaksi')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['id_produk'], 'transaksi_detail_ibfk_2')->references(['id_produk'])->on('produk')->onUpdate('CASCADE')->onDelete('CASCADE');
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
            $table->dropForeign('transaksi_detail_ibfk_2');
        });
    }
};
