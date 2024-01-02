<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdProvinceIdCitiesIdCitiesIdDistrictIdSubdistrictToToko extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('toko', function (Blueprint $table) {
            $table->integer('id_province')->after('no_telp_toko');
            $table->integer('id_cities')->after('id_province');
            $table->integer('id_district')->after('id_cities');
            $table->integer('id_subdistrict')->after('id_district');
            $table->integer('jam_buka')->after('kodepos');
            $table->integer('jam_tutup')->after('jam_buka');
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
