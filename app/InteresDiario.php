<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\InteresCuota;

class InteresDiario extends Model
{
    //
    protected $table = 'intereses_diarios';
    protected $fillable = ['valor_interes'];
    public $primaryKey = 'id_interes_diario';

    public function InteresCuota()
    {
    	return $this->belongsTo('InteresCuota','id_interes_diario', 'id_interes_diario');
    }
}
