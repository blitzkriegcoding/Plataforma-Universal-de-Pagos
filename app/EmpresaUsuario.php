<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Empresa;
class EmpresaUsuario extends Model
{
    //
    protected $table = 'empresas_usuarios';
    protected $fillable = ['id_empresa', 'user_id'];
    public $primaryKey = 'id';
    public $timestamps = false;

    public function User()
    {
    	return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function Empresa()
    {
    	return $this->belongsTo(Empresa::class, 'id_empresa', 'id_empresa');
    }

    public static function associateEnterpriseUser($data)
    {
        try
        {
            self::firstOrCreate(['id_empresa' => $data->id_empresa , 'user_id' => $data->id]);    
        }
        catch(Exception $e)
        {
            #abort(500, 'No pudo asociarse el usuario con la empresa');
            abort(500, 'No pudo asociarse el usuario con la empresa');
            throw $e;
        }
        
    }

}
