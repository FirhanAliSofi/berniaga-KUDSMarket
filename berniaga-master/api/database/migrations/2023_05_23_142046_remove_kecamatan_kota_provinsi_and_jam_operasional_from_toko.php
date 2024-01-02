<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveKecamatanKotaProvinsiAndJamOperasionalFromToko extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('toko', function (Blueprint $table) {
            $table->dropColumn('kecamatan','kota','provinsi','jam_operasional');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('toko', function (Blueprint $table) {
            //
        });
    }
}
