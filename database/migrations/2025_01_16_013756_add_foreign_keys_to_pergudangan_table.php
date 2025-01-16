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
        Schema::table('pergudangan', function (Blueprint $table) {
            $table->foreign(['id_produk'], 'pergudangan_ibfk_1')->references(['id_produk'])->on('produk')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['created_by'], 'pergudangan_ibfk_2')->references(['id_user'])->on('users')->onUpdate('CASCADE')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pergudangan', function (Blueprint $table) {
            $table->dropForeign('pergudangan_ibfk_1');
            $table->dropForeign('pergudangan_ibfk_2');
        });
    }
};
