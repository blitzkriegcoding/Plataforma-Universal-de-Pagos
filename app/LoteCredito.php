<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use LogCargaCrediticia;
use App\Cliente;
class LoteCredito extends Model
{
    //
    protected $table = 'lotes_creditos';
    protected $fillable = ['nro_cuota', 'fecha_vencimiento', 'interes', 'amortizacion', 'valor_cuota', 
    'saldo_insoluto', 'estado_cuota', 'tipo_cuota', 'fecha_pago', 'rut_cliente', 'nro_credito', 
    'nombres_cliente', 'apellidos_cliente', 'id_carga', 'fecha_hora_carga'];
    protected $primaryKey = 'id_carga';
    public $timestamps = false;

    public function LogCargaCrediticia()
    {
    	return $this->belongsTo('LogCargaCrediticia','id_carga', 'id_carga');
    }


    public static function createNewLote($data_lote, $id_carga)
    {

    	$count_data_lote = count($data_lote);
    	if($count_data_lote > 0)
    	{
            $datetime = date('Y-m-d H:i:s');
    		for($x = 0; $x < $count_data_lote; $x++)
    		{
                $data_lote[$x]['id_carga'] = $id_carga;
    			$data_lote[$x]['fecha_hora_carga'] = $datetime;                
    		}
    	}    	
        self::insert($data_lote);
        self::addNewClients($id_carga);
        return TRUE;
    }

    public static function addNewClients($id_carga)
    {
        /*
            Para determinar los clientes nuevos 
            con el siguiente query
            select t2.rut_cliente, t2.nombre_cliente, t2.apellido_cliente, 'mail@email.cl' as email_cliente, 
            '+56(2)23456789' as telefono_cliente
            from lotes_creditos t1
            left join clientes t2 on(t1.rut_cliente = t2.rut_cliente COLLATE utf8_unicode_ci)
            where t2.rut_cliente is null;            
        */

        $new_clients =  \DB::table('lotes_creditos as t1')
                                ->select(\DB::raw("distinct trim(t1.rut_cliente) as rut_cliente, t1.nombres_cliente as nombre_cliente, t1.apellidos_cliente as apellido_cliente, 'mail@email.cl' as email_cliente, '+56(2)23456789' as telefono_cliente"))
                                ->leftJoin('clientes as t2', 't1.rut_cliente', '=', 't2.rut_cliente')
                                ->whereNull('t2.rut_cliente')
                                ->where('id_carga', '=', $id_carga)                                
                                ->get()->toArray();
        $f = function($value)
        {
            return (array)$value;
        };
        $array_new_clientes = array_map($f, $new_clients);
        session(['clientes_nuevos' => count($array_new_clientes)]);
        Cliente::insert($array_new_clientes);        
    }

    public static function addNewClientQuotePlan($id_carga)
    {
        /*
        select t1.id_cliente_cuota, 'GENERICO', count(t2.cuota) as cantidad_cuotas, max(t2.fecha_vencimiento), t2.nro_credito
        from clientes_empresas t1
        inner join lote_nominas_afa t2 on(t1.rut_cliente = t2.rut_cliente)
        group by t1.rut_cliente, t1.id_cliente_cuota,t2.nro_credito order by t1.id_cliente_cuota asc;
        */
    }


}
