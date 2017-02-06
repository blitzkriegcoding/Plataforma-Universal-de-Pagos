<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Cuota;
use App\InteresMensual;
use App\InteresDiario;
class InteresCuota extends Model
{
    //
    protected $table = 'interes_cuotas';
    protected $fillable = ['id_interes_mensual', 'id_interes_diario', 'id_cuota'];
    protected $primaryKey = 'id_interes_cuota';
    protected $timestamps = false;
    public function InteresMensual()
    {
    	return $this->hasOne('InteresMensual', 'id_interes_mensual', 'id_interes_mensual');
    }

    public function InteresDiario()
    {
    	return $this->hasOne('InteresDiario', 'id_interes_diario', 'id_interes_diario');
    }
    public function Cuota()
    {
    	return $this->belongsTo('Cuota', 'id_cuota', 'id_cuota');
    }

}
