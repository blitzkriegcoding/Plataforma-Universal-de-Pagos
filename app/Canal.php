<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\EmpresaCanal;
class Canal extends Model
{
    //
    protected $table = 'canales';
    protected $fillable = ['canal', 'canal_hash'];
    public $primaryKey = 'id_canal';
    public $timestamps = false;


    public function EmpresaCanal()
    {
    	return $this->hasOne('EmpresaCanal', 'id_canal', 'id_canal');
    }

    public static function getChannelByNumber($channel)
    {
    	return \DB::table('canales as t1')
    				->select(\DB::raw('t1.id_canal, upper(canal) as canal'))
    				->leftJoin('empresa_canal as t2', 't1.id_canal', '=', 't2.id_canal')
    				->where('canal','like',strtoupper(trim("$channel%")))
    				->whereNull('t2.id_canal')
    				->orderBy('canal', 'asc')
    				->get()->toJson();
    }

}
