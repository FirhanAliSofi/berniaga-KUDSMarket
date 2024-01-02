<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditTabelSeller2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('seller', function (Blueprint $table) {
            $table->string('nik')->unique()->change();
            $table->string('profesi')->after('nama');
            $table->string('created_at')->after('kodepos')->change();
            $table->string('updated_at')->after('created_at')->change();
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
