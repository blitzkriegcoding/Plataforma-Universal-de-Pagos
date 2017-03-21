<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ValorUf extends Model
{
    //
    protected $table = 'valores_uf';
    protected $fillable = ['valor_uf', 'fecha'];
    public $timestamps = false;

    public static function getApiRoute($index, $date = NULL)
    {
    	$_date = $date == NULL ? date('d-m-Y'):$date;
    	$f = ['uf' => ('http://mindicador.cl/api/uf/'.$_date), 'dolar' => ('http://mindicador.cl/api/dolar/'.$_date) ];
    	if(array_key_exists ($index, $f) == TRUE)
    		return $f[$index];
    	return NULL;
    }

    public static function addNewValues($date = NULL)
    {
    	$response = [];
    	$new_values = NULL;
    	$response['uf'] = \Curl::to(self::getApiRoute('uf',$date))->asJson()->get();
    	$response['dolar'] = \Curl::to(self::getApiRoute('dolar',$date))->asJson()->get();
    	
    	if(!empty($response['uf']->serie))
    	{
    		$new_values = self::create(['valor_uf' => $response['uf']->serie[0]->valor, 'fecha' => date('Y-m-d H:i:s', strtotime($response['uf']->serie[0]->fecha))]);    		
    	}
    	return $new_values;
    }
}
