<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\InteresCuota;
use App\InteresDiario;
use App\InteresMensual;
use App\Cuota;
use App\Empresa;
use Auth;
use Carbon\Carbon;
use DB;
use App\Events\AddAuditoryEvent as Evt;
use Event;
class PlanCuota extends Model
{
    //
    protected $table = 'plan_cuotas';
    protected $fillable = ['id_cliente_cuota', 'paquete', 'cantidad_cuotas','fecha_termino','nro_credito', 'total_credito'];
    protected $primaryKey = 'id_plan_cuota';
    public $timestamps = false;
    public function ClienteEmpresa()
    {
    	return $this->belongsTo('App\ClienteEmpresa');
    }
    public function Cuota()
    {
    	return $this->hasMany('App\Cuota');
    }

    public static function addNewCredit($data_credit)
    {
        // $new_plan = PlanCuota::create(['id_client_cuota' => $data_credit->rut_cliente, 'paquete' => $data_credit->paquete, 
        //     'cantidad_cuotas' => $data_credit->cantidad_cuotas, 'fecha_termino_contrato' => $data_credit->fecha_vencimiento, 
        //     'nro_credito' => $data_credit->nro_credito, 'total_credito' => $data_credit->total_credito]);
    }

    public static function addNewClientQuotePlan($id_carga)
    {
        $new_quote_plans = DB::table('clientes_empresas as t1')
                            ->select(DB::raw("distinct t1.id_cliente_cuota as id_cliente_cuota, 'GENERICO' as paquete, 
                                count(t2.nro_cuota) as cantidad_cuotas, max(t2.fecha_vencimiento) as fecha_termino_contrato, 
                                t2.nro_credito as nro_credito, (max(t2.interes) + max(t2.saldo_insoluto)) as total_credito"))
                            ->join('lotes_creditos as t2', 't1.rut_cliente', '=', 't2.rut_cliente')
                            ->leftJoin('plan_cuotas as t3', function($join)
                            {
                                $join->on('t1.id_cliente_cuota', '=', 't3.id_cliente_cuota');
                                $join->on('t2.nro_credito', '=', 't3.nro_credito');
                            })
                            ->whereNull('t3.id_cliente_cuota')
                            ->whereNull('t3.nro_credito')
                            ->where('t2.id_carga' ,'=', $id_carga)
                            ->groupBy(['id_cliente_cuota','paquete', 'nro_credito'])
                            ->get()->toArray();


        $f = function($value)
        {
            return (array)$value;
        };
        $array_new_quote_plans = array_map($f, $new_quote_plans);        
        $result = self::insert($array_new_quote_plans);
        session(['total_credit_plans' => count($array_new_quote_plans)]);
        return $result;     
    }

    public static function getPlan($data)
    {
        $quote_plan = DB::table('plan_cuotas as t1')
                        ->select(DB::raw('t1.cantidad_cuotas as cuotas, t1.paquete, t1.fecha_termino_contrato as vencimiento, t1.nro_credito as credito, t1.id_plan_cuota'))
                        ->join('clientes_empresas as t2', 't1.id_cliente_cuota', '=', 't2.id_cliente_cuota')
                        ->where('t2.id_empresa', '=', Empresa::getIdEmpresa())                        
                        ->where('t1.id_plan_cuota', 'like', $data->id_plan_cuota)                        
                        ->get()
                        ->toArray();
        $data_event = ['usuario' => Auth::user()->rut_usuario, 'evento' => 'Consulta del plan id# '.$data->id_plan_cuota ];
        Event::fire(new Evt($data_event));
        return $quote_plan;
    }

    public static function getFilteredPlan($data)
    {
        $quote_plan = DB::table('plan_cuotas as t1')
                        ->select(DB::raw('t1.cantidad_cuotas as cuotas, t1.paquete, t1.fecha_termino_contrato as vencimiento, t1.nro_credito as credito, t1.id_plan_cuota'))
                        ->join('clientes_empresas as t2', 't1.id_cliente_cuota', '=', 't2.id_cliente_cuota')
                        ->where('t2.id_empresa', '=', Empresa::getIdEmpresa())
                        ->where('t1.id_plan_cuota', 'like', $data->id_plan_cuota)
                        ->where('t1.cantidad_cuotas', 'like', '%'.strtoupper($data->cantidad_cuotas).'%')
                        ->where('t1.paquete', 'like', '%'.strtoupper($data->paquete).'%')
                        ->where('t1.fecha_termino_contrato', 'like', '%'.strtoupper($data->vencimiento).'%')
                        ->where('t1.nro_credito', 'like', '%'.strtoupper($data->credito).'%')
                        ->get()
                        ->toArray();
        return $quote_plan;
    }    

    public static function deletePlan($data)
    {
        $quote_plan = DB::table('plan_cuotas as t1')
                        ->select(DB::raw('t1.cantidad_cuotas as cuotas, t1.paquete, t1.fecha_termino_contrato as vencimiento, t1.nro_credito as credito, t1.id_plan_cuota'))
                        ->join('clientes_empresas as t2', 't1.id_cliente_cuota', '=', 't2.id_cliente_cuota')
                        ->where('t2.id_empresa', '=', Empresa::getIdEmpresa())
                        ->where('t1.id_plan_cuota', '=', $data->id_plan_cuota)
                        ->get();

        if($quote_plan[0]->id_plan_cuota != null)
        {
            $data_event = ['usuario' => Auth::user()->rut_usuario, 'evento' => 'Eliminación satisfactoria del plan id# '.$data->id_plan_cuota ];
            
            self::find($quote_plan[0]->id_plan_cuota)->delete();
            return true;
        }
        $data_event = ['usuario' => Auth::user()->rut_usuario, 'evento' => 'Eliminación insatisfactoria del plan id# '.$data->id_plan_cuota ];
        Event::fire(new Evt($data_event));            
        return false;
    }

    
}
