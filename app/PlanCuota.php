<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\InteresCuota;
use App\InteresDiario;
use App\InteresMensual;
use App\Cuota;
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
        $new_quote_plans = \DB::table('clientes_empresas as t1')
                            ->select(\DB::raw("distinct t1.id_cliente_cuota as id_cliente_cuota, 'GENERICO' as paquete, 
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

    
}
