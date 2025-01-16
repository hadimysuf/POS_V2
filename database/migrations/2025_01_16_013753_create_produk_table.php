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
        Schema::create('produk', function (Blueprint $table) {
            $table->integer('id_produk', true);
            $table->string('nama_produk', 100);
            $table->integer('harga');
            $table->integer('stok');
            $table->string('satuan', 50)->nullable();
            $table->integer('stok_minimum')->default(10);
            $table->integer('id_kategori')->nullable()->index('id_kategori');
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
        Schema::dropIfExists('produk');
    }
};
