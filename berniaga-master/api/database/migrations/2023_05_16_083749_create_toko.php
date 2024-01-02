<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToko extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('toko', function (Blueprint $table) {
            $table->id();
            $table->string('nama_toko')->unique();
            $table->string('alamat_toko');
            $table->string('link_toko')->unique();
            $table->string('no_telp_toko');
            $table->string('kecamatan');
            $table->string('kota');
            $table->string('provinsi');
            $table->string('kodepos');
            $table->text('alamat');
            $table->string('jam_operasional');
            $table->string('jenis_usaha');
            $table->string('logo_toko');
            $table->string('foto_toko1');
            $table->string('foto_toko2');
            $table->string('foto_toko3');
            $table->text('deskripsi');
            $table->enum('status', ['1','0', 'blokir']);
            $table->integer('saldo');
            $table->integer('id_seller');
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
        Schema::dropIfExists('toko');
    }
}