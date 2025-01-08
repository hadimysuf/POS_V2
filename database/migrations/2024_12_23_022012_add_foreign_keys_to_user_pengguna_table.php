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
        Schema::table('user_pengguna', function (Blueprint $table) {
            $table->foreign(['role_id'], 'user_pengguna_ibfk_1')->references(['id_role'])->on('role');
            $table->foreign(['role_id'], 'fk_role')->references(['id_role'])->on('role');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_pengguna', function (Blueprint $table) {
            $table->dropForeign('user_pengguna_ibfk_1');
            $table->dropForeign('fk_role');
        });
    }
};
