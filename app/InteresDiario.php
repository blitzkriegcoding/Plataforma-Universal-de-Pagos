<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\InteresCuota;

class InteresDiario extends Model
{
    //
    protected $table = 'intereses_diarios';
    protected $fillable = ['valor_interes'];
    protected $primaryKey = 'id_interes_diario';
    protected $timestamps = false;

    public function InteresCuota()
    {
    	return $this->belongsTo('InteresCuota','id_interes_diario', 'id_interes_diario');
    }
}
