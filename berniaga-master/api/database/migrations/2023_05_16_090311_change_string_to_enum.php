<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeStringToEnum extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE seller MODIFY COLUMN status_verifikasi ENUM('1', '0')");

        Schema::table('seller', function (Blueprint $table) {
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE seller MODIFY COLUMN status_verifikasi VARCHAR");

        Schema::table('seller', function (Blueprint $table) {
            //
        });
    }
}
