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
        Schema::create('gurus', function (Blueprint $table) {
            $table->id();
            $table->string('nama_guru', 100)->nullable();
            $table->string('nik', 16)->nullable();
            $table->string('jenis_kelamin', 16)->nullable();
            $table->string('agama', 20)->nullable();
            $table->string('gelar', 10)->nullable();
            $table->string('pendidikan_terakhir', 10)->nullable();
            $table->string('program_studi', 50)->nullable();
            $table->string('nuptk', 10)->nullable();
            $table->string('nip', 20)->nullable();
            $table->string('tempat_lahir', 100)->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->date('mulai_tugas')->nullable();
            $table->string('jabatan', 50)->nullable();
            $table->string('alumni_dari', 50)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('no_hp', 20)->nullable();
            $table->string('no_rekening')->nullable();
            $table->string('nama_bank')->nullable();
            $table->string('image')->nullable();
            $table->string('alamat')->nullable();
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
        Schema::dropIfExists('gurus');
    }
};