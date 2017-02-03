<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Cliente extends Model
{
    //
    protected $table = 'clientes';
    protected $fillable = ['rut_cliente', 'nombre_cliente', 'apellido_cliente', 'telefono_cliente', 'email_cliente', 'direccion_cliente'];
    public $timestamps = false;

    public static function getClientByRut($rut_cliente = NULL)
    {   	
    	$clientes = DB::table('clientes')
    	->select(DB::raw("concat(clientes_empresas.rut_cliente,' - ',upper(nombre_cliente), ' ',upper(apellido_cliente)) as datos_cliente, clientes_empresas.id_cliente_cuota"))
    	->join('clientes_empresas', 'clientes.rut_cliente', '=', 'clientes_empresas.rut_cliente')
    	->where('clientes_empresas.rut_cliente', 'like', trim("$rut_cliente%"))
    	->orWhere('nombre_cliente', 'like', strtoupper(trim("%$rut_cliente%")))
    	->orWhere('apellido_cliente', 'like', strtoupper(trim("%$rut_cliente%")))->get();
    	return $clientes;
    }
    
}
