<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Cuota;
use App\Empresa;
use App\Http\Requests;
use App\Http\Requests\UpdateQuoteRequest;
use App\Http\Requests\CreateQuoteRequest;
use App\Http\Requests\CheckDatePaymentRequest;
use Carbon\Carbon;
use Excel;

class QuoteController extends Controller
{
    //
    public function viewClientQuotes(Request $request)
    {
    	
    }

    public function getClientQuotes(Request $request)
    {
    	# dd($request->id_cliente_cuota);
    	return Cuota::getClientQuotes($request);
    }

    public function getFilteredQuotes(Request $request)
    {
    	
    	return Cuota::getFilteredQuotes($request);
    }

    #public function updateQuote(UpdateQuoteRequest $request)
    public function updateQuote(UpdateQuoteRequest $request)
    {
    	Cuota::updateQuote($request);
    }

    public function deleteQuote(Request $request)
    {
    	Cuota::deleteQuote($request);
    }

    public function createQuote(CreateQuoteRequest $request)
    {
        Cuota::createQuote($request);
    }

    public function viewClientsPayments()
    {
       // return Cuota::getClientsPaymentByDate($request->date_start, $request->date_end);
        return view('report_clients_payments');
    }

    public function getPayments(CheckDatePaymentRequest $request)
    {
        $dt_start   = date("Y-m-d", strtotime(str_replace('/','-',$request->dt_start)));
        $dt_end     = date("Y-m-d",strtotime(str_replace('/','-',$request->dt_end)));

        $start  = Carbon::parse($dt_start);
        $end    = Carbon::parse($dt_end);
        $diff = $end->lt($start);

        if($diff == TRUE)
        {
            return response()->json(['message' => 'La fecha de inicio no puede ser mayor a la fecha fin'], 422);
        }
       
        $data = Cuota::getClientsPaymentByDate($dt_start, $dt_end);
        #dd($data);
        $file_name = 'pagos_generados_'.date('Y_m_d');
        $sheet_name = 'pagos_'.date('Y_m_d');
        $extension = 'xls';
        $empresa = sha1(Empresa::getIdEmpresa());
        Excel::create($file_name, function($excel) use ($data, $sheet_name) {
            $excel->sheet($sheet_name, function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->store('xls', public_path($empresa)) ; 

        $path['final_path'] = '/'.$empresa.'/'.$file_name.'.'.$extension;
        return json_encode($path);
    }
}
