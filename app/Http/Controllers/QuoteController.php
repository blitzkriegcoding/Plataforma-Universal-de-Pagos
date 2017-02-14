<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cuota;

use App\Http\Requests;
use App\Http\Requests\UpdateQuoteRequest;
use App\Http\Requests\CreateQuoteRequest;

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
    	// dd($request->id_cliente_cuota);
    	return Cuota::getFilteredQuotes($request);
    }

    #public function updateQuote(UpdateQuoteRequest $request)
    public function updateQuote(UpdateQuoteRequest $request)
    {
    	//dd($request->id_cuota);
    	Cuota::updateQuote($request);
    }

    public function deleteQuote(Request $request)
    {
    	Cuota::deleteQuote($request);
    }

    public function createQuote(CreateQuoteRequest $request)
    {
        //dd($request->fecha_vencimiento);
        Cuota::createQuote($request);
    }


}
