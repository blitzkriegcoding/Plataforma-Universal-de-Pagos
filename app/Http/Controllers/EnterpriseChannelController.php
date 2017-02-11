<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\EnterpriseChannelRequest;

use App\EmpresaCanal;
class EnterpriseChannelController extends Controller
{
    //
    public function newAssociation()
    {
    	return view('new_enterprise_channel');
    }

    public function createAssociation(EnterpriseChannelRequest $request)
    {
    	$data = NULL;
    	$data = EmpresaCanal::firstOrCreate(['id_empresa' => $request->id_empresa, 'id_canal' => $request->id_canal]);
    	if($data->wasRecentlyCreated == FALSE)
		{
			flash('Atención! Los valores seleccionados ya se encuentran en la base de datos', 'warning');
			return redirect()->route('admin.new_enterprise_channel');
		}
		flash('Se ha asociado la empresa y el canal seleccionados', 'success');
		return redirect()->route('admin.new_enterprise_channel');
    }
}
