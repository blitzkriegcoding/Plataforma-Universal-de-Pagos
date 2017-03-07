<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\EmpresaCanal;
class Empresa extends Model
{
    //
    protected $table = 'empresas';
    
    protected $fillable = ['nombre_empresa', 'nombre_fantasia', 'rut_empresa', 
    'email_empresa', 'url_autorizada_1', 'url_autorizada_2', 'ruta_clave_publica', 
    'ruta_clave_privada', 'ruta_log', 'ruta_img_empresa'];

    public $primaryKey = 'id_empresa';
    public $timestamps = false;

    public function EmpresaCanal()
    {
    	return $this->hasMany('EmpresaCanal', 'id_empresa', 'id_empresa');
    }


    public static function getEnterpriseByName($name)
    {
        $empresa = \Auth::user()->EmpresaUsuario == null? '%%' : \Auth::user()->EmpresaUsuario->id_empresa;
    	return \DB::table('empresas')
    				->select(\DB::raw('id_empresa, upper(nombre_empresa) as nombre_empresa'))
    				->where('nombre_empresa', 'like', strtoupper(trim("$name%")))
                    ->where('id_empresa', 'like', $empresa)
    				->orderBy('nombre_empresa', 'asc')
    				->get()->toJson();
    }

    public static function getIdEmpresa()
    {
        $empresa = \Auth::user()->EmpresaUsuario->id_empresa;
        return $empresa;
    }
}
