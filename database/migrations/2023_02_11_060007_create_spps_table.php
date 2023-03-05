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
        Schema::create('spps', function (Blueprint $table) {
            $table->id();
            $table->string('id_siswa');
            $table->string('id_kelas');
            $table->string('bulan');
            $table->string('nama_bulan');
            $table->string('tahun');
            $table->string('tipe_pembayaran');
            $table->string('jenis_pembayaran')->nullable();
            $table->string('merchant')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('nominal');
            $table->string('user');
            $table->softDeletes('deleted_at', 0);
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
        Schema::dropIfExists('spps');
    }
};