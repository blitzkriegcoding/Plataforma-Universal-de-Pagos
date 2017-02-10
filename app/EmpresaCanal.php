<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Canal;
class EmpresaCanal extends Model
{
    //
    protected $table = 'empresa_canal';
    protected $fillable = ['id_empresa', 'id_canal'];
    public $timestamps = false;
    public $incrementing = false;
    public $primaryKey = ['id_empresa', 'id_canal'];

    public function Canal()
    {
    	return $this->hasOne('Canal', 'id_canal', 'id_canal');
    }

}
