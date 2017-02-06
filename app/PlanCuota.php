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
    protected $timestamps = false;
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
        $new_plan = PlanCuota::create(['id_client_cuota' => $data_credit->rut_cliente, 'paquete' => $data_credit->paquete, 
            'cantidad_cuotas' => $data_credit->cantidad_cuotas, 'fecha_termino_contrato' => $data_credit->fecha_vencimiento, 
            'nro_credito' => $data_credit->nro_credito, 'total_credito' => $data_credit->total_credito]);



    }

    
}
