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
    protected $primaryKey = 'id_lote';
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
        return $result;
    }

    public static function deleteLote($id_carga)
    {
        self::where('id_carga', $id_carga)->delete();
    }


}
