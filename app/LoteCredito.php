<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use LogCargaCrediticia;
class LoteCredito extends Model
{
    //
    protected $table = 'lotes_creditos';
    protected $fillable = ['fecha_hora_carga', 'hash_validacion', 'id_empresa', 'user_id'];
    protected $primaryKey = 'id_carga';
    protected $timestamps = false;

    public function LogCargaCrediticia()
    {
    	return $this->hasMany('LogCargaCrediticia','id_carga', 'id_carga');
    }
    public function createNewLog()
    {
    	$new_log = ['fecha_hora_carga' => 'now()', 'hash_validacion' => bcrypt(date('Y-m-d H:i:s')), 'id_empresa' => 1, 'user_id' => Auth::id()];

    }
}
