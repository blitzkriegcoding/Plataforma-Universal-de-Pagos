<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Http\Requests;
use App\Http\Requests\UserRequest;
use App\Http\Requests\PasswordRequest;

class UserController extends Controller
{
    public function editUser()
    {
    	$data_user = User::find(Auth::user()->id);
    	return view('edit_user')->with(['user' => $data_user]);
    }

    public function updateUser(UserRequest $request)
    {
        $result = User::updateuser($request);
        if($result['clase'] == 'danger')
        {
            flash($result['mensaje'], $result['clase']);
            return redirect()->back();
        }
        flash($result['mensaje'], $result['clase']);        
        return view('edit_user')->with(['user' => User::find(Auth::user()->id)]);
    }

    public function editPassword()
    {
    	return view('edit_password');
    }
    public function updatePassword(PasswordRequest $request)
    {
        if(!User::updatePassword($request))
        {
            flash('Una de las contraseñas no coincide', 'danger');
            return redirect()->back();
        }
        flash('Contraseña actualizada con éxito', 'success');
        return view('edit_password');
    }
}
