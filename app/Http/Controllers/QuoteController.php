<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Cuota;
use App\Http\Requests;
use App\Http\Requests\UpdateQuoteRequest;
use App\Http\Requests\CreateQuoteRequest;
use App\Http\Requests\CheckDatePaymentRequest;
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
        $data = Cuota::getClientsPaymentByDate($request->dt_start, $request->dt_end);
        return Excel::create('pagos_generados_'.date('Y_m_d'), function($excel) use ($data) {
            $excel->sheet('pagos_'.date('Y_m_d'), function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->store('xls');        
    }
}
