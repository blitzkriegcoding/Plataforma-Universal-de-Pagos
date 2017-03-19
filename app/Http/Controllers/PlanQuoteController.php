<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\CreateCreditRequest;
use App\Http\Requests\PlanQuoteRequest;

use App\PlanCuota;
use App\Cuota;

class PlanQuoteController extends Controller
{
    //


    public function newCredit()
    {
    	return view('new_credit');
    }

    public function createCredit(CreateCreditRequest $request)    
    {
    	#dd($request);
    }

    public function viewPlans()
    {
    	return view('view_client_quote_plan');
    }

    public function getPlan(Request $request)
    {
    	return PlanCuota::getPlan($request);
    }

    public function getFilteredPlan(Request $request)
    {
    	return PlanCuota::getFilteredPlan($request);
    }

    public function deletePlan(Request $request)
    {
        
        if(PlanCuota::deletePlan($request))
        {
            return response()->json(['mensaje' => 'Plan de crédito borrado con éxito'], 200);
        }
        else
        {
            return response()->json(['mensaje' => 'Plan de crédito no encontrado'], 404);   
        }
    }

    public function updatePlan(PlanQuoteRequest $request)
    {
        // dd($_POST);
        PlanCuota::updatePlan($request);
    }


}
