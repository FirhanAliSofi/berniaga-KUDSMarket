<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditTabelSeller extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('seller', function (Blueprint $table) {
            $table->renameColumn('name', 'nama');
            $table->renameColumn('gender', 'jenis_kelamin');
            $table->renameColumn('date_of_birth', 'tanggal_lahir');
            $table->string('nik');
            $table->string('foto_ktp');
            $table->string('foto_wajah');
            $table->string('provinsi');
            $table->string('kota');
            $table->string('kecamatan');
            $table->text('alamat_lengkap');
            $table->string('kodepos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('seller', function (Blueprint $table) {
            //
        });
    }
}
