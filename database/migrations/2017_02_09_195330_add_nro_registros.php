<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNroRegistros extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('logs_cargas_crediticias', function (Blueprint $table) {
            //
            $table->integer('nro_registros')->unsigned()->nullable()->after('hash_validacion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('logs_cargas_crediticias', function (Blueprint $table) {
            //
        });
    }
}
