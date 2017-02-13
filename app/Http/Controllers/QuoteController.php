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
    	dd(Cuota::getClientQuotes($request->rut_cliente));
    }


}
