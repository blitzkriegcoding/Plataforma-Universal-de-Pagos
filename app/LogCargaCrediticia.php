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

    private static function getIdEmpresa()
    {
        $empresa = \Auth::user()->EmpresaUsuario == null? '%%' : \Auth::user()->EmpresaUsuario->id_empresa;
        return $empresa;
    }

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
        return \DB::table('logs_cargas_crediticias as t1')
                    ->select(\DB::raw("id_carga, DATE_FORMAT(fecha_hora_carga,'%d-%m-%Y %T') as fecha_hora_carga, hash_validacion, 
                        nro_registros, nombre_empresa, upper(name) as nombre_usuario,cargado"))
                    ->join('empresas as t2', 't1.id_empresa', '=', 't2.id_empresa')
                    ->join('users as t3', 't1.user_id', '=', 't3.id')                    
                    ->where('t1.id_empresa', 'like', self::getIdEmpresa())
                    ->orderBy('id_carga','desc')->get()->toArray();
    }
    public static function getFilteredHistory($request)
    {
        
        return \DB::table('logs_cargas_crediticias as t1')
                    ->select(\DB::raw("id_carga, DATE_FORMAT(fecha_hora_carga,'%d-%m-%Y %T') as fecha_hora_carga, hash_validacion, 
                        nro_registros, nombre_empresa, upper(name) as nombre_usuario,cargado"))
                    ->join('empresas as t2', 't1.id_empresa', '=', 't2.id_empresa')
                    ->join('users as t3', 't1.user_id', '=', 't3.id')
                    ->where('t1.id_empresa', 'like', self::getIdEmpresa())
                    ->where('id_carga', 'like', $request->id_carga == NULL?"%%":$request->id_carga."%")
                    ->where('fecha_hora_carga', 'like', $request->fecha_hora_carga == NULL?"%%":$request->fecha_hora_carga."%")
                    ->where('nro_registros', 'like', $request->nro_registros == NULL?"%%":$request->nro_registros."%")
                    ->where('nombre_empresa', 'like', $request->nombre_empresa == NULL?"%%":strtoupper($request->nombre_empresa)."%")
                    ->where('name', 'like', $request->name == NULL?"%%":strtoupper($request->name)."%")
                    ->where('cargado','like', $request->cargado == NULL?"%%":strtoupper($request->cargado)."%")
                    ->orderBy('id_carga','desc')->get()->toArray();
    }    
}
