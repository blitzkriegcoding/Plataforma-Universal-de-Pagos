<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\LoteCredito;
class LogCargaCrediticia extends Model
{
    //
    protected $table = 'logs_cargas_crediticias';
    protected $fillable = ['fecha_hora_carga', 'hash_validacion', 'id_empresa', 'user_id'];
    protected $timestamps = false;
    protected $primaryKey = 'id_carga';

    private $credit_bulk = [];

    public function LoteCredito()
    {
    	return $this->hasMany('LoteCredito','id_carga', 'id_carga');
    }



}
