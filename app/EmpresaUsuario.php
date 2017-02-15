<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Empresa;
class EmpresaUsuario extends Model
{
    //
    protected $table = 'empresa_usuario';
    protected $fillable = ['id_empresa', 'user_id'];
    public $primaryKey = 'id';
    public $timestamps = false;

    public function User()
    {
    	return $this->belongsTo('User', 'id','id');
    }

    public function Empresa()
    {
    	return $this->belongsTo('Empresa', 'id_empresa', 'id_empresa');
    }

}
