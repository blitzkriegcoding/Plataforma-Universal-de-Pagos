<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUploadFlag extends Migration
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
            $table->string('cargado', 2)->default('NO');
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
            $table->dropColumn('cargado');
        });
    }
}
