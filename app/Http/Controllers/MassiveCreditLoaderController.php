<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\UploadFileRequest;

use App\LoteCredito;
use App\LogCargaCrediticia;
use Excel;
class MassiveCreditLoaderController extends Controller
{
    //
    public function newLoad()
    {
    	return view('massive_upload');
    }

    public function uploadFile(UploadFileRequest $request)
    {
    	# dd($request->lote_credito);
    	$bulk = [];
    	$path_file = $request->file('lote_credito')->getRealPath();
    	$data_file = Excel::load($path_file, function($reader){})->get();
    	if(!empty($data_file) && $data_file->count())
    	{
    		foreach($data_file as $value =>$d)
    		{
    			print_r($d->toArray());
    		// 	if(!empty($value))
    		// 	{
    		// 		foreach($value as $v)
    		// 		{
						// $bulk[] = [	'nro_cuota' 		=> $value['NRO_CUOTA'], , 
		    // 						'fecha_vencimiento' => $value['FECHA_VENCIMIENTO'],
		    // 						'interes'			=> $value['INTERES'],
		    // 						'amortizacion'		=> $value['AMORTIZACION'],
		    // 						'valor_cuota'		=> $value['VALOR_CUOTA'],
		    // 						'saldo_insoluto'	=> $value['SALDO_INSOLUTO'],
		    // 						'estado'			=> $value['ESTADO'],
		    // 						'tipo_cuota'		=> $value['TIPO_CUOTA'],
		    // 						'fecha_pago'		=> $value['FECHA_PAGO'],
		    // 						'rut_cliente'		=> $value['RUT_CLIENTE'],
		    // 						'nro_credito'		=> $value['NRO_CREDITO'],
		    // 						'nombres_cliente'	=> $value['NOMBRES_CLIENTE'],
		    // 						'apellidos_cliente'	=> $value['APELLIDOS_CLIENTE']];
    		// 		}
    		// 	}
    		}
    		dd($bulk);
    	}
    }
}
