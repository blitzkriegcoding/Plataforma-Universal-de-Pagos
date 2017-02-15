<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    //

    public function check()
    {
        // dd(\Auth::user()->EmpresaUsuario()->id_empresa);  
        return view('view_check');
    }    
}
