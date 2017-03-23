<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;
use Event;
use App\Empresa;
use App\PlanCuota;
use App\InteresCuota;
use Carbon\Carbon;
use App\Events\AddInterestQuoteEvent;
use App\Events\AddAuditoryEvent as Evt;

class Cuota extends Model
{
    protected $table = 'cuotas';
    protected $fillable = ['nro_cuota', 'valor_cuota', 'activa', 'status_cuota', 'fecha_vencimiento', 'fecha_pago_efectivo', 'id_plan_cuota', 'en_proceso', 'bill_number'];
    protected $primaryKey = 'id_cuota';
    public $timestamps = false;
    public function PlanCuota()
    {
    	return $this->hasMany('Cuota');
    }
    public function InteresCuota()
    {
    	return $this->hasOne('InteresCuota', 'id_cuota', 'id_cuota');
    }

    public static function addQuotes($id_carga)
    {
        $result = NULL;

        $new_quotes = \DB::table('lotes_creditos as t1')
                        ->select(\DB::raw("distinct t1.nro_cuota, t1.valor_cuota, 'F' as activa,'SIN PAGAR' as status_cuota, t1.fecha_vencimiento, NULL as fecha_pago_efectivo, t2.id_plan_cuota, NULL as en_proceso, NULL as bill_number"))
                        ->join('plan_cuotas as t2', 't1.nro_credito','=','t2.nro_credito')
                        ->join('clientes_empresas as t3', 't2.id_cliente_cuota', '=', 't3.id_cliente_cuota')
                        ->leftJoin('cuotas as t4', 't2.id_plan_cuota', '=', 't4.id_plan_cuota')
                        ->whereNull('t4.nro_cuota')
                        ->orderBy('t2.id_plan_cuota', 'asc')
                        ->orderBy('t1.nro_cuota', 'asc')
                        ->get()->toArray();
        if(count($new_quotes) > 0)
        {
            $f = function($value)
            {
                return (array)$value;
            };
            $array_new_quotes = array_map($f, $new_quotes);
            $qty_new_quotes = count($array_new_quotes);        
            session(['total_new_quotes' => count($array_new_quotes)]);
            $result = self::insert($array_new_quotes);
        }
        else
        {
            session(['total_new_quotes' => 0]);
        }
        return $result;
    }

    public static function getClientQuotes($data)
    {
        $quotes = \DB::table('cuotas as t1')
                ->select(\DB::raw('t1.id_cuota, t1.id_plan_cuota, t1.nro_cuota, t1.valor_cuota, t1.activa, 
                    t1.status_cuota, 
                    date_format(t1.fecha_vencimiento,"%d-%m-%Y") as fecha_vencimiento, 
                    date_format(t1.fecha_pago_efectivo,"%d-%m-%Y") as fecha_pago_efectivo, t1.bill_number'))
                ->join('plan_cuotas as t2', 't1.id_plan_cuota', '=', 't2.id_plan_cuota')
                ->join('clientes_empresas as t3', 't2.id_cliente_cuota', '=', 't3.id_cliente_cuota')
                ->join('clientes as t4', 't3.rut_cliente', '=', 't4.rut_cliente')
                ->leftJoin('transacciones_finales as t5', 't1.bill_number', '=', 't5.cod_transaccion_pup')
                ->where('t2.id_plan_cuota', '=',$data->id_plan_cuota)
                ->where('t3.id_empresa', '=', Empresa::getIdEmpresa())                
                ->orderBy('t1.nro_cuota')
                ->get()->toArray();

        return $quotes;
    }

    public static function getFilteredQuotes($data)
    {
        $quotes = DB::table('cuotas as t1')
                ->select(\DB::raw('t1.id_cuota, t1.id_plan_cuota, t1.nro_cuota, t1.valor_cuota, t1.activa, 
                    t1.status_cuota, 
                    date_format(t1.fecha_vencimiento,"%d-%m-%Y") as fecha_vencimiento, 
                    date_format(t1.fecha_pago_efectivo,"%d-%m-%Y") as fecha_pago_efectivo, t1.bill_number'))
                ->join('plan_cuotas as t2', 't1.id_plan_cuota', '=', 't2.id_plan_cuota')
                ->join('clientes_empresas as t3', 't2.id_cliente_cuota', '=', 't3.id_cliente_cuota')
                ->join('clientes as t4', 't3.rut_cliente', '=', 't4.rut_cliente')
                ->leftJoin('transacciones_finales as t5', 't1.bill_number', '=', 't5.cod_transaccion_pup')
                ->where('t3.id_empresa', '=', Empresa::getIdEmpresa())
                ->where('t2.id_plan_cuota', (int)$data->id_plan_cuota)
                ->where('t3.rut_cliente', 'like', '%'.strtoupper($data->rut_cliente).'%')
                ->where('t1.nro_cuota', 'like', '%'.strtoupper($data->nro_cuota).'%')
                ->where('t1.activa', 'like', '%'.strtoupper($data->activa).'%')
                ->where('t1.status_cuota', 'like', '%'.strtoupper($data->status_cuota).'%')
                ->where('t1.fecha_vencimiento', 'like', '%'.strtoupper($data->fecha_vencimiento).'%')                
                ->get()->toArray();
        return $quotes;
    }

    public static function getQuotePlanByRut($rut_cliente = NULL)
    {
        $clientes = DB::table('clientes as t1')
        ->select(DB::raw("concat(t2.rut_cliente,' - ',upper(nombre_cliente), ' ',upper(apellido_cliente), ' - CREDITO N°: ', t3.nro_credito) as datos_cliente, t3.id_plan_cuota"))
        ->join('clientes_empresas as t2', 't1.rut_cliente', '=', 't2.rut_cliente')
        ->join('plan_cuotas as t3', 't2.id_cliente_cuota', '=', 't3.id_cliente_cuota')
        ->where('t2.rut_cliente', 'like', strtoupper(trim("$rut_cliente%")))
        ->orWhere('nombre_cliente', 'like', strtoupper(trim("%$rut_cliente%")))
        ->orWhere('apellido_cliente', 'like', strtoupper(trim("%$rut_cliente%")))
        ->get();
        return $clientes;      
    }

    public static function updateQuote($data)
	{	
		$data_quote = DB::table('cuotas')
		    ->where('id_cuota', $data->id_cuota)
		    ->update(['nro_cuota' 		=> $data->nro_cuota, 
		    	'valor_cuota' 			=> $data->valor_cuota, 
		        'activa' 				=> strtoupper($data->activa), 'status_cuota' => strtoupper($data->status_cuota), 
		        'fecha_vencimiento' 	=> date('Y-m-d', strtotime($data->fecha_vencimiento)),
		        'fecha_pago_efectivo' 	=> $data->fecha_pago_efectivo != null? date('Y-m-d', strtotime($data->fecha_pago_efectivo)):null,
		        'bill_number' 			=> $data->bill_number != (null || '')? $data->bill_number:null,

		        ]);
		$data_event = ['usuario' => Auth::user()->rut_usuario, 'evento' => 'Actualización de la cuota id# '.$data->id_cuota ];
		Event::fire(new Evt($data_event));            
    }

    public static function deleteQuote($data)
    {
        $data_quote = DB::table('cuotas')->where('id_cuota', '=', $data->id_cuota)->delete();
        $data_event = ['usuario' => Auth::user()->rut_usuario, 'evento' => 'Borrado de la cuota id# '.$data->id_cuota ];
        Event::fire(new Evt($data_event));        
    }

    public static function createQuote($data)
    {
        $data_quote = self::create(['nro_cuota' => $data->nro_cuota, 
                'valor_cuota' => $data->valor_cuota, 'activa' => $data->activa, 'status_cuota' => $data->status_cuota, 
                'fecha_vencimiento' => (date('Y-m-d', strtotime($data->fecha_vencimiento))), 'id_plan_cuota' => $data->id_plan_cuota]);
        
        $data_event = ['usuario' => Auth::user()->rut_usuario, 'evento' => 'Creacion de la cuota id# '.$data_quote->id_cuota ];
        Event::fire(new AddInterestQuoteEvent($data_quote->id_cuota));
        Event::fire(new Evt($data_event));
    }

    public static function getClientsPaymentByDate($dt_start = NULL, $dt_end = NULL)
    {
        if((NULL == $dt_start) || (NULL == $dt_end))
        {            
            $date_start = $date_end = date('Y-m-d');
        }
        else
        {
            $date_start = $dt_start;
            $date_end = $dt_end;
        }

        $payment['data'] = \DB::table('cuotas as t1')
                    ->select(\DB::raw("t1.status_cuota, concat(t4.nombre_cliente, ' ', t4.apellido_cliente) as nombres, 
                                        t1.nro_cuota, cast(t1.valor_cuota as decimal(11,0)) as valor_cuota, 
                                        date_format(t1.fecha_pago_efectivo, '%d-%m-%Y') as fecha_pago, 
                                        date_format(t1.fecha_vencimiento, '%d-%m-%Y') as fecha_vencimiento_cuota,                                        
                                        cast(case 
                                            when datediff(t1.fecha_pago_efectivo, t1.fecha_vencimiento) <= 0 then 0.00
                                            when datediff(t1.fecha_pago_efectivo, t1.fecha_vencimiento) > 0 then datediff(t1.fecha_pago_efectivo, t1.fecha_vencimiento)
                                        end as decimal) as dias_mora,
                                        t2.nro_credito,
                                        t1.bill_number as boleta,
                                        case t5.cod_transaccion_servipag     
                                        	when t5.cod_transaccion_servipag <> NULL then t5.cod_transaccion_servipag
                                        	else
                                        		'PAGO DIRECTO EN OFICINA'
                                        end
                                        as codigo_servipag
                                        "))
                    ->join('plan_cuotas as t2', 't1.id_plan_cuota', '=', 't2.id_plan_cuota')
                    ->join('clientes_empresas as t3', 't2.id_cliente_cuota', '=', 't3.id_cliente_cuota')
                    ->join('clientes as t4', 't3.rut_cliente', '=', 't4.rut_cliente')
                    ->leftJoin('transacciones_finales as t5', 't1.bill_number', '=', 't5.cod_transaccion_pup')
                    ->whereBetween('t1.fecha_pago_efectivo', [$date_start, $date_end])
                    ->whereNotNull('t1.bill_number')                    
                    ->where('t3.id_empresa', '=', Empresa::getIdEmpresa())
                    ->orderBy('bill_number', 'asc')
                    ->get();
        $payment['data']->transform(function($item){
            return (array)$item;
        });
        return $payment['data']->toArray();
    } 


}
