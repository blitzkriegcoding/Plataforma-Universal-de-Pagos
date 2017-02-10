<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empresa;
class EnterpriseController extends Controller
{
    //
    public function newEnterprise()
    {
    	return view('new_enterprise');
    }

    public function editEnterprise(Request $request)
    {

    }

    public function createEnterprise(Request $request)
    {
    	
    }

    public function getEnterpriseByName(Request $request)
    {
        return Empresa::getEnterpriseByName($request->name);
    }
}
