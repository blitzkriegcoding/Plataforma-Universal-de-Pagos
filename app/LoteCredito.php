<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\LogCargaCrediticia;
use App\Cliente;
use App\ClienteEmpresa;
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

        $result = self::insert($data_lote); 
        session(['total_data_lote' => $count_data_lote]);   
        # dd($count_data_lote);
        return $result;
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
