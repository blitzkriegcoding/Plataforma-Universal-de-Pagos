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

    public static function getCurrentLoadedLote()
    {
        $current_lote = \DB::table('lotes_creditos as t1')
                            ->select(\DB::raw('t1.id_lote, t1.nro_cuota, t1.fecha_vencimiento, t1.interes, 
                                t1.amortizacion, t1.valor_cuota, t1.saldo_insoluto, t1.estado_cuota, 
                                t1.tipo_cuota, t1.fecha_pago, t1.rut_cliente, t1.nro_credito, 
                                t1.nombres_cliente, t1.apellidos_cliente'))
                                ->where('id_carga', '=', session('id_carga'))
                                ->orderBy('id_lote', 'asc')->get()->toArray();
        return $current_lote;    
    }

    public static function getFilteredLoadedLote($req)
    {

        $operator = $req->fecha_pago!=''? 'like':'is';

        $current_filtered_lote = \DB::table('lotes_creditos as t1')
                                ->select(\DB::raw('t1.id_lote, t1.nro_cuota, t1.fecha_vencimiento, t1.interes, 
                                    t1.amortizacion, t1.valor_cuota, t1.saldo_insoluto, t1.estado_cuota, 
                                    t1.tipo_cuota, t1.fecha_pago, t1.rut_cliente, t1.nro_credito, 
                                    t1.nombres_cliente, t1.apellidos_cliente'))
                                    ->where('id_carga', '=', session('id_carga'))
                                    ->where('nro_cuota', 'like', strtoupper($req->nro_cuota == ''? '%%':$req->nro_cuota))
                                    ->where('fecha_vencimiento', 'like', strtoupper($req->fecha_vencimiento == ''? '%%':$req->fecha_vencimiento.'%'))
                                    ->where('interes', 'like', strtoupper($req->interes == ''? '%%':$req->interes.'%'))
                                    ->where('amortizacion', 'like', strtoupper($req->amortizacion == ''? '%%':$req->amortizacion.'%'))
                                    ->where('valor_cuota', 'like', strtoupper($req->valor_cuota == ''? '%%':$req->valor_cuota.'%'))
                                    ->where('saldo_insoluto', 'like', strtoupper($req->saldo_insoluto == ''? '%%':$req->saldo_insoluto.'%'))
                                    ->where('estado_cuota', 'like', strtoupper($req->estado_cuota == ''? '%%':$req->estado_cuota.'%'))
                                    ->where('tipo_cuota', 'like', strtoupper($req->tipo_cuota == ''? '%%':$req->tipo_cuota.'%'))
                                    
                                    ->where('rut_cliente', 'like', strtoupper($req->rut_cliente == ''? '%%':$req->rut_cliente.'%'))
                                    ->where('nro_credito', 'like', strtoupper($req->nro_credito == ''? '%%':$req->nro_credito.'%'))
                                    ->where('nombres_cliente', 'like', strtoupper($req->nombres_cliente == ''? '%%':$req->nombres_cliente.'%'))
                                    ->where('apellidos_cliente', 'like', strtoupper($req->apellidos_cliente == ''? '%%':$req->apellidos_cliente.'%'))
                                    ->orderBy('id_lote', 'asc')->get()->toArray();
        return $current_filtered_lote;   
    }

    public static function deleteItemFromLoadedLote($item)
    {
        try
        {
            self::where('id_lote', $item->id_lote)->delete();
            return ['success' => TRUE, 'mensaje' => 'Registro borrado con éxito'];
        }
        catch(Exception $e)
        {
            throw $e;
        }
        

    }


}
