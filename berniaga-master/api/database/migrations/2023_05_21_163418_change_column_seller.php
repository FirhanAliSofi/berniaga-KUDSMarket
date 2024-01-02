<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnSeller extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('seller', function (Blueprint $table) {
        $table->integer('id_province');
        $table->integer('id_cities');
        $table->integer('id_district');
        $table->integer('id_subdistrict');
    });
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
