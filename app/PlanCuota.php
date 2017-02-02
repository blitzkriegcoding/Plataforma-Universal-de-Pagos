<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanCuota extends Model
{
    //
    protected $table = 'plan_cuotas';
    protected $fillable = ['id_cliente_cuota', 'paquete', 'cantidad_cuotas','fecha_termino','nro_credito', 'total_credito'];

    public function ClienteEmpresa()
    {
    	return $this->belongsTo('App\ClienteEmpresa');
    }
    public function Cuota()
    {
    	return $this->hasMany('App\Cuota');
    }
}
