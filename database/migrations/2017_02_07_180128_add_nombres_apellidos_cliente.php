<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNombresApellidosCliente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lotes_creditos', function (Blueprint $table) {
            //
            // $table->string('tipo_cuota', 255)->after('estado_cuota');
            // $table->date('fecha_pago')->nullable()->after('tipo_cuota');
            // $table->string('nombres_cliente',100)->after('nro_credito');
            // $table->string('apellidos_cliente',100)->after('nombres_cliente');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lotes_creditos', function (Blueprint $table) {
            //
        });
    }
}
