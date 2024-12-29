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
        Schema::create('transaksi_details', function (Blueprint $table) {
            $table->id('id_transaksi_detail'); // Primary Key
            $table->unsignedBigInteger('id_transaksi'); // Foreign Key ke transaksi
            $table->unsignedBigInteger('id_produk'); // Foreign Key ke produk
            $table->integer('harga'); // Harga satuan
            $table->integer('jumlah'); // Jumlah produk
            $table->integer('total'); // Total harga
            $table->timestamps();

            // Definisikan foreign key
            $table->foreign('id_transaksi')->references('id_transaksi')->on('transaksi')->onDelete('cascade');
            $table->foreign('id_produk')->references('id_produk')->on('produk')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi_details');
    }
};
