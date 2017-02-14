<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UfValue extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('valores_uf_dolar', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';

            $table->increments('id_valor');
            $table->decimal('valor_uf', 11, 2);
            $table->decimal('valor_dolar', 11, 2);
            $table->datetime('fecha');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('valores_uf_dolar');
    }
}
