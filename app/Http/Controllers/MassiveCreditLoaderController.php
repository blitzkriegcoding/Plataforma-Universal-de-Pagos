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
    	#$bulk = [];
    	$path_file = $request->file('lote_credito')->getRealPath();
    	$data_file = Excel::load($path_file, function($reader){})->get();
    	if(!empty($data_file) && $data_file->count())
    	{
    		foreach($data_file as $key => $value)
    		{
    			print_r($value->toArray()."<br>");


						// $bulk[] = [	'nro_cuota' 		=> $d['0'],
		    // 						'fecha_vencimiento' => $d['1'],
		    // 						'interes'			=> $d['2'],
		    // 						'amortizacion'		=> $d['3'],
		    // 						'valor_cuota'		=> $d['4'],
		    // 						'saldo_insoluto'	=> $d['5'],
		    // 						'estado'			=> $d['6'],
		    // 						'tipo_cuota'		=> $d['7'],
		    // 						'fecha_pago'		=> $d['8'],
		    // 						'rut_cliente'		=> $d['9'],
		    // 						'nro_credito'		=> $d['10'],
		    // 						'nombres_cliente'	=> $d['11'],
		    // 						'apellidos_cliente'	=> $d['12']];

    		}
    		dd($bulk);
    	}
    }
}
