<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Cliente extends Model
{
    //
    protected $table = 'clientes';
    protected $fillable = ['rut_cliente', 'nombre_cliente', 'apellido_cliente', 'telefono_cliente', 'email_cliente', 'direccion_cliente'];
    protected $primaryKey = 'rut_cliente';
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
    
    public static function addNewClients($id_carga)
    {
        
        $new_clients =  \DB::table('lotes_creditos as t1')
                                ->select(\DB::raw("distinct trim(t1.rut_cliente) as rut_cliente, t1.nombres_cliente as nombre_cliente, t1.apellidos_cliente as apellido_cliente, 'mail@email.cl' as email_cliente, 
                                    '+56(2)23456789' as telefono_cliente"))
                                ->leftJoin('clientes as t2', 't1.rut_cliente', '=', 't2.rut_cliente')
                                ->whereNull('t2.rut_cliente')
                                ->where('id_carga', '=', $id_carga)                                
                                ->get()->toArray();
        
        $qty_new_clients = count($new_clients);
        $f = function($value)
        {
            return (array)$value;
        };
        $array_new_clientes = array_map($f, $new_clients);
        $result = self::insert($array_new_clientes);
        session(['qty_new_clients' => $qty_new_clients]);        
        return $result;
    }    
}
