<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->string('nama_produk');
            $table->string('merek');
            $table->enum('kondisi',['baru', 'bekas']);
            $table->text('deskripsi_produk');
            $table->string('link_produk')->unique();
            $table->string('foto_produk1');
            $table->string('foto_produk2');
            $table->string('foto_produk3');
            $table->enum('status_varian',['1', '0']);
            $table->integer('id_toko');
            $table->integer('id_etalase');
            $table->integer('id_kategori');
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
        Schema::dropIfExists('produk');
    }
}
