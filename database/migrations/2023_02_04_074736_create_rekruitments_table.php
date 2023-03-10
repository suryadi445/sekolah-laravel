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
        Schema::create('rekruitments', function (Blueprint $table) {
            $table->id();
            $table->string('jabatan', 20);
            $table->string('nama', 50);
            $table->string('no_hp', 20);
            $table->string('email', 50);
            $table->date('tgl_lahir');
            $table->string('cv');
            $table->enum('proses', ['0', '1']);
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
        Schema::dropIfExists('rekruitments');
    }
};