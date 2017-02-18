<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Cliente;
use App\Empresa;
class ClienteEmpresa extends Model
{
    //
    protected $table = 'clientes_empresas';
    protected $fillable = ['rut_cliente', 'id_empresa'];
    protected $primaryKey = 'id_cliente_cuota';
    public $timestamps = false;

    private static function getIdEmpresa()
    {
        $empresa = \Auth::user()->EmpresaUsuario == null? '%%' : \Auth::user()->EmpresaUsuario->id_empresa;
        return $empresa;
    }

    public function Cliente()
    {
    	return $this->belongsTo('Cliente');
    }

    public function Empresa()
    {
    	return $this->belongsTo('Empresa');
    }

    public static function associateClientsEnterprise($data_lote, $id_carga)
    {
        // En el id de la empresa deberá contener la empresa 
        // segun la sesión que esté validada
        $new_associate_clients = \DB::table('lotes_creditos as t1')                                
                                ->select(\DB::raw("distinct t1.rut_cliente, self::getIdEmpresa() as id_empresa"))
                                ->leftJoin('clientes_empresas as t2', 't1.rut_cliente', '=', 't2.rut_cliente')
                                ->whereNull('t2.rut_cliente')
                                ->where('id_carga', '=', $id_carga)
                                ->get()->toArray();

        $f = function($value)
        {
            return (array)$value;
        };
        $array_new_associate_clients = array_map($f, $new_associate_clients);
        session(['clientes_asociados_empresa' => count($array_new_associate_clients)]);
        $result = self::insert($array_new_associate_clients);
        return $result;
    }
}
