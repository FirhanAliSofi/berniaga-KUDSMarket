<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStok extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stok', function (Blueprint $table) {
            $table->id();
            $table->integer('id_produk');
            $table->integer('id_varian1')->nullable();
            $table->integer('id_varian2')->nullable();
            $table->integer('stok');
            $table->integer('harga');
            $table->integer('berat');
            $table->enum('status', ['1', '0']);
            $table->integer('panjang');
            $table->integer('lebar');
            $table->integer('tinggi');
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
        Schema::dropIfExists('stok');
    }
}
