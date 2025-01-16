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
        Schema::create('pergudangan', function (Blueprint $table) {
            $table->integer('id_transaksi', true);
            $table->integer('id_produk')->index('id_produk');
            $table->integer('jumlah');
            $table->enum('jenis_transaksi', ['masuk', 'keluar']);
            $table->dateTime('tanggal_transaksi')->nullable()->useCurrent();
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
        Schema::dropIfExists('pergudangan');
    }
};
