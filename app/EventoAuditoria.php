<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventoAuditoria extends Model
{
    //
    protected $table = 'eventos_auditoria';
    protected $fillable = ['usuario', 'evento'];

    public static function addEventLog($data)
    {
    	self::create($data);
    	return true;
    }
}
