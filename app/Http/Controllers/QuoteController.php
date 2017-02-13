<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Cuota;
class QuoteController extends Controller
{
    //
    public function viewClientQuotes(Request $request)
    {
    	
    }

    public function getClientQuotes(Request $request)
    {
    	# dd($request->id_cliente_cuota);
    	return Cuota::getClientQuotes($request->id_cliente_cuota);
    }

    public function getFilteredQuotes(Request $request)
    {
    	// dd($request->id_cliente_cuota);
    	return Cuota::getFilteredQuotes($request);
    }


}
