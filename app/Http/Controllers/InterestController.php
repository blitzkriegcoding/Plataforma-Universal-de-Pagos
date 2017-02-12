<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\InteresDiario;
use App\InteresMensual;

use App\Http\Requests;
use App\Http\Requests\InterestRequest;
class InterestController extends Controller
{
    //
	public function newDailyInterest()
	{
		return view('new_daily_interest');
	}

	public function newMonthlyInterest()
	{
		return view('new_monthly_interest');
	}

    public function createDailyInterest(InterestRequest $request)
    {
    	# dd($request);
    	$result = InteresDiario::firstOrCreate(['valor_interes' => $request->valor]);
    	if($result->wasRecentlyCreated == FALSE)
    	{
    		flash('El valor del interés diario que intenta crear ya existe, por lo tanto se omite','warning');
    		return redirect()->route('admin.new_daily_interest');
    	}
		flash('Tasa de interés diario creada con éxito','success');
		return redirect()->route('admin.new_daily_interest');    	
    }

    public function createMonthlyInterest(InterestRequest $request)
    {
    	$result = InteresMensual::firstOrCreate(['valor' => $request->valor]);
    	if($result->wasRecentlyCreated == FALSE)
    	{
    		flash('El valor del interés mensual que intenta crear ya existe, por lo tanto se omite','warning');
    		return redirect()->route('admin.new_monthly_interest');
    	}
		flash('Tasa de interés mensual creada con éxito','success');
		return redirect()->route('admin.new_monthly_interest');       	
    }
}
