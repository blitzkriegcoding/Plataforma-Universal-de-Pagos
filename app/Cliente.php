<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    //
    protected $table = 'clientes';
    protected $fillable = ['rut_cliente', 'nombre_cliente', 'apellido_cliente', 'telefono_cliente', 'email_cliente', 'direccion_cliente'];
    public $timestamps = false;
    
}
