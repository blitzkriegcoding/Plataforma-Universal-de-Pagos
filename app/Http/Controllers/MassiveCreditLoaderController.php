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
    private $bulk = [];
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
    		#dd($data_file->toArray());
    		foreach($data_file->toArray() as $key => $value)
    		{
				$this->bulk[] = ['nro_cuota'	=> $value['nro_cuota'],
    						'fecha_vencimiento' => $value['fecha_vencimiento'],
    						'interes'			=> $value['interes'],
    						'amortizacion'		=> $value['amortizacion'],
    						'valor_cuota'		=> $value['valor_cuota'],
    						'saldo_insoluto'	=> $value['saldo_insoluto'],
    						'estado_cuota'		=> trim($value['estado_cuota']),
    						'tipo_cuota'		=> trim($value['tipo_cuota']),
    						'fecha_pago'		=> NULL,
    						'rut_cliente'		=> $value['rut_cliente'],
    						'nro_credito'		=> $value['nro_credito'],
    						'nombres_cliente'	=> $value['nombres_cliente'],
    						'apellidos_cliente'	=> $value['apellidos_cliente']];
    		}
    		if(!empty($this->bulk))
    		{
    			$works_fine = LogCargaCrediticia::createNewLog($this->bulk);
                if($works_fine == TRUE)
                {
                    flash('El lote ha sido cargado satisfactoriamente', 'success');
                    return back();
                }
    		}
            else
            {
                flash('Lote vacío o memoria insuficiente', 'error');
                return back();
            }
    	}
        else
        {
            flash('Lote vacío o con valores inválidos', 'error');
            return back();
        }


    }


}
