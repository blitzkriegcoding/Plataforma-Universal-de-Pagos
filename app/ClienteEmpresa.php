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

    public function Cliente()
    {
    	return $this->belongsTo('Cliente');
    }
    public function Empresa()
    {
    	return $this->belongsTo('Empresa');
    }
}
