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
        Schema::create('user_pengguna', function (Blueprint $table) {
            $table->integer('id_user', true);
            $table->string('nama_user', 100);
            $table->string('username', 100)->unique('username');
            $table->string('password', 100);
            $table->integer('role_id')->index('fk_role');
            $table->string('nomor_handphone', 13);
            $table->string('alamat', 100);
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
        Schema::dropIfExists('user_pengguna');
    }
};
