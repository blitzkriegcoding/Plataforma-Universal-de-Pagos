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
        $new_quotes = \DB::table('lotes_creditos as t1')
                        ->select(\DB::raw("t1.nro_cuota, t1.valor_cuota, 'F' as activa,'SIN PAGAR' as status_cuota, 
                            t1.fecha_vencimiento, NULL as fecha_pago_efectivo, t2.id_plan_cuota, NULL as en_proceso, 
                            NULL as bill_number"))
                        ->join('plan_cuotas as t2','t1.nro_credito', '=', 't2.nro_credito')
                        ->join('clientes_empresas as t3', 't2.id_cliente_cuota', '=', 't3.id_cliente_cuota')
                        ->where('id_carga', '=', $id_carga)
                        ->orderBy('t2.nro_credito','asc')
                        ->orderBy('t1.nro_cuota', 'asc')
                        ->get()->toArray();
                        
        $f = function($value)
        {
            return (array)$value;
        };
        $array_new_quotes = array_map($f, $new_quotes);
        session(['total_new_quotes' => count($array_new_quotes)]);
        $result = self::insert($array_new_quotes);        
        return $result; 

    }
}
