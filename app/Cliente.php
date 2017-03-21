<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;
class Cliente extends Model
{
    //
    protected $table = 'clientes';
    protected $fillable = ['rut_cliente', 'nombre_cliente', 'apellido_cliente', 'telefono_cliente', 'email_cliente', 'direccion_cliente'];
    protected $primaryKey = 'rut_cliente';
    public $timestamps = false;

    private static function getIdEmpresa()
    {
        $empresa = Auth::user()->EmpresaUsuario == null? '%%' : Auth::user()->EmpresaUsuario->id_empresa;
        return $empresa;
    }

    public static function getClientByRut($rut_cliente = NULL)
    {   	
    	$clientes = DB::table('clientes as t1')
    	->select(DB::raw("concat(t2.rut_cliente,' - ',upper(nombre_cliente), ' ',upper(apellido_cliente)) as datos_cliente, t2.id_cliente_cuota"))
    	->join('clientes_empresas as t2', 't1.rut_cliente', '=', 't2.rut_cliente')
        ->where('t2.id_empresa', '=', self::getIdEmpresa())
    	->where('t2.rut_cliente', 'like', trim($rut_cliente).'%')
    	->where('nombre_cliente', 'like', '%'.strtoupper(trim($rut_cliente)).'%')
    	->where('apellido_cliente', 'like', '%'.strtoupper(trim($rut_cliente)).'%')
        ->get()
        ->toJson();
    	return $clientes;
    }

    public static function getQuotePlanClientByRut($rut_cliente = NULL)
    {
        $clientes = DB::table('clientes as t1')
        ->select(DB::raw("concat(t2.rut_cliente,' - ',upper(nombre_cliente), ' ', upper(apellido_cliente), ' - CREDITO N°: ', t3.nro_credito) as datos_cliente, t3.id_plan_cuota"))
        ->join('clientes_empresas as t2', 't1.rut_cliente', '=', 't2.rut_cliente')
        ->join('plan_cuotas as t3', 't2.id_cliente_cuota', '=', 't3.id_cliente_cuota')
        ->where('t2.rut_cliente', 'like', trim($rut_cliente).'%')
        ->where('t2.id_empresa', '=', self::getIdEmpresa())
        ->where('nombre_cliente', 'like', '%'.trim($rut_cliente%).'%')
        ->where('apellido_cliente', 'like', '%'.trim($rut_cliente%).'%')
        ->where('nro_credito', 'like', '%'.trim($rut_cliente%).'%')
        ->get()
        ->toJson();        
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

    public static function getAllClients()
    {
        $all_clients = \DB::table('clientes as t1')
                    ->select(\DB::raw("t1.nombre_cliente, t1.apellido_cliente, t1.rut_cliente, t1.email_cliente, t1.telefono_cliente, t1.direccion_cliente"))
                    ->join('clientes_empresas as t2', 't1.rut_cliente', '=', 't2.rut_cliente')
                    ->where('t2.id_empresa','like', self::getIdEmpresa())
                    ->orderBy('t1.nombre_cliente', 'asc')
                    ->orderBy('t1.apellido_cliente', 'asc')
                    ->get()->toArray();
        return $all_clients;
    }
    public static function getFilteredClients($data)
    {

        $filtered_clients = \DB::table('clientes as t1')
                    ->select(\DB::raw("t1.rut_cliente as old_rut, t1.nombre_cliente, t1.apellido_cliente, t1.rut_cliente, t1.email_cliente, t1.telefono_cliente, t1.direccion_cliente"))
                    ->join('clientes_empresas as t2', 't1.rut_cliente', '=', 't2.rut_cliente')
                    ->where('t2.id_empresa','like', self::getIdEmpresa())
                    ->where('t1.nombre_cliente', 'like', strtoupper($data->nombre_cliente == ''? '%%':$data->nombre_cliente.'%'))
                    ->where('t1.apellido_cliente', 'like', strtoupper($data->apellido_cliente == ''? '%%':$data->apellido_cliente.'%'))
                    ->where('t1.rut_cliente', 'like', strtoupper($data->rut_cliente == ""? '%%':$data->rut_cliente.'%'))
                    ->where('t1.telefono_cliente', 'like', strtoupper($data->telefono_cliente == ""? '%%':$data->telefono_cliente.'%'))
                    ->where('t1.direccion_cliente', 'like', strtoupper($data->direccion_cliente == ""? '%%':$data->direccion_cliente.'%'))
                    ->where('t1.email_cliente', 'like', strtoupper($data->email_cliente == ""? '%%':$data->email_cliente.'%'))                                        
                    ->orderBy('t1.nombre_cliente', 'asc')
                    ->orderBy('t1.apellido_cliente', 'asc')
                    ->get()->toArray();
        return $filtered_clients;       
    }

    public static function updateClient($new_data)
    {
        #dd($new_data->direccion_cliente);
        \DB::table('clientes')
            ->where('rut_cliente', $new_data->old_rut)
            ->update([
                'rut_cliente' => $new_data->rut_cliente,
                'nombre_cliente' => $new_data->nombre_cliente, 
                'apellido_cliente' => $new_data->apellido_cliente,
                'email_cliente' => $new_data->email_cliente,
                'telefono_cliente' => $new_data->telefono_cliente,
                'direccion_cliente' => $new_data->direccion_cliente]);
    }
}
