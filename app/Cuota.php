<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PlanCuota;
use App\InteresCuota;
class Cuota extends Model
{
    protected $table = 'cuotas';
    protected $fillable = ['nro_cuota', 'valor_cuota', 'activa', 'status_cuota', 'fecha_nacimiento', 'fecha_pago_efectivo', 'id_plan_cuota', 'en_proceso', 'bill_number'];
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
    // public function InteresDiario()
    // {
    // 	return $this->hasOne('InteresDiario','','');
    // }
    // public function InteresMensual()
    // {
    // 	return $this->hasOne('InteresMensual');
    // }

    public static function addQuotes($id_carga)
    {
        $result = NULL;
        // $new_quotes = \DB::table('lotes_creditos as t1')
        //                 ->select(\DB::raw("t1.nro_cuota, t1.valor_cuota, 'F' as activa,'SIN PAGAR' as status_cuota, 
        //                     t1.fecha_vencimiento, NULL as fecha_pago_efectivo, t2.id_plan_cuota, NULL as en_proceso, 
        //                     NULL as bill_number"))
        //                 ->join('plan_cuotas as t2','t1.nro_credito', '=', 't2.nro_credito')
        //                 ->join('clientes_empresas as t3', 't2.id_cliente_cuota', '=', 't3.id_cliente_cuota')
        //                 ->where('id_carga', '=', $id_carga)
        //                 ->orderBy('t2.nro_credito','asc')
        //                 ->orderBy('t1.nro_cuota', 'asc')
        //                 ->get()->toArray();
        /*
        select distinct t1.nro_cuota, t1.valor_cuota, 'F' as activa,'SIN PAGAR' as status_cuota, t1.fecha_vencimiento, 
        NULL as fecha_pago_efectivo, t2.id_plan_cuota, NULL as en_proceso, NULL as bill_number
        from lotes_creditos t1 
        inner join plan_cuotas t2 on (t1.nro_credito = t2.nro_credito)
        inner join clientes_empresas t3 on (t2.id_cliente_cuota = t3.id_cliente_cuota)
        left join cuotas t4 on (t2.id_plan_cuota = t4.id_plan_cuota)
        where t4.nro_cuota is null
        order by  t2.id_plan_cuota, t1.nro_cuota asc;
        */

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

    public static function getClientQuotes($rut_cliente)
    {
        $quotes = \DB::table('cuotas as t1')
                ->select(\DB::raw('t1.id_cuota, t1.nro_cuota, t1.valor_cuota, t1.activa, 
                    t1.status_cuota, t1.fecha_vencimiento, t1.fecha_pago_efectivo'))
                ->join('plan_cuotas as t2', 't1.id_plan_cuota', '=', 't2.id_plan_cuota')
                ->join('clientes_empresas as t3', 't2.id_cliente_cuota', '=', 't3.id_cliente_cuota')
                ->join('clientes as t4', 't3.rut_cliente', '=', 't4.rut_cliente')
                ->where('rut_cliente', 'like',$rut_cliente.'%')
                ->orderBy('t1.nro_cuota')
                ->get()->toArray();

        return $quotes;
    }

    public static function getClientQuotes($rut_cliente)
    {
        $quotes = \DB::table('cuotas as t1')
                ->select(\DB::raw('t1.id_cuota, t1.nro_cuota, t1.valor_cuota, t1.activa, 
                    t1.status_cuota, t1.fecha_vencimiento, t1.fecha_pago_efectivo'))
                ->join('plan_cuotas as t2', 't1.id_plan_cuota', '=', 't2.id_plan_cuota')
                ->join('clientes_empresas as t3', 't2.id_cliente_cuota', '=', 't3.id_cliente_cuota')
                ->join('clientes as t4', 't3.rut_cliente', '=', 't4.rut_cliente')
                ->where('rut_cliente', 'like',$rut_cliente.'%')
                ->orderBy('t1.nro_cuota')
                ->get()->toArray();

        return $quotes;
    }    
}
