<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\LoteCredito;
class LogCargaCrediticia extends Model
{
    //
    protected $table = 'logs_cargas_crediticias';
    protected $fillable = ['fecha_hora_carga', 'hash_validacion','nro_registros' ,'id_empresa', 'user_id'];
    public $timestamps = false;
    protected $primaryKey = 'id_carga';

    private $credit_bulk = [];

    public function LoteCredito()
    {
    	return $this->hasMany('LoteCredito','id_carga', 'id_carga');
    }
    public static function createNewLog($data_lote)
    {
        $new_id_carga = NULL;
        $new_log = ['fecha_hora_carga' => date('Y-m-d H:i:s'), 'hash_validacion' => bcrypt(date('Y-m-d H:i:s')),'nro_registros' => count($data_lote),'id_empresa' => 1, 'user_id' => \Auth::id()];
        $log = self::create($new_log);
        if(NULL != $log->id_carga || !empty($log))
        {
            $new_id_carga = $log->id_carga;
        }
        session($new_log);
        return $new_id_carga;
    }
    public static function deleteLog($id_carga)
    {
        self::destroy($id_carga);
    }

    public static function getHistory()
    {
        return \DB::table('logs_cargas_crediticias')
                    ->select(\DB::raw("id_carga, DATE_FORMAT(fecha_hora_carga,'%d %b %Y %T:%i') as fecha_hora_carga, hash_validacion,nro_registros,nombre_empresa,name"))
                    ->join('empresas', 'logs_cargas_crediticias.id_empresa', '=', 'empresas.id_empresa')
                    ->join('users', 'logs_cargas_crediticias.user_id', '=', 'users.id')
        ->orderBy('id_carga','desc')->get();
    }
}
