<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EmpresaUsuario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresa_usuario', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
                        
            $table->increments('id');
            $table->bigInteger('id_empresa');
            $table->integer('user_id')->unsigned();

            $table->foreign('id_empresa')->references('id_empresa')
            ->on('empresas')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('user_id')->references('id')
            ->on('users')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresa_usuario');
    }
}
