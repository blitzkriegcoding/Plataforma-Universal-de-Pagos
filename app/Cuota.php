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
}
