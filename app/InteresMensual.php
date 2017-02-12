<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\InteresCuota;

class InteresMensual extends Model
{
    protected $table = 'intereses_mensuales';
    protected $fillable = ['valor'];
    protected $primaryKey = 'id_interes_mensual';
    public $timestamps = false;

    public function InteresCuota()
    {
    	return $this->belongsTo('InteresCuota', 'id_interes_mensual', 'id_interes_mensual');
    }

}
