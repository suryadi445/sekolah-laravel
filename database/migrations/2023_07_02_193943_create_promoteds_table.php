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
        Schema::create('promoteds', function (Blueprint $table) {
            $table->id();
            $table->integer('id_siswa')->nullable();
            $table->string('thn_ajaran_awal', 10)->nullable();
            $table->string('thn_ajaran_akhir', 10)->nullable();
            $table->string('kelas_awal', 30)->nullable();
            $table->string('sub_kelas_awal', 10)->nullable();
            $table->string('naik_kelas', 30)->nullable();
            $table->string('status', 30)->nullable();
            $table->string('user', 100)->nullable();
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
        Schema::dropIfExists('promoteds');
    }
};
