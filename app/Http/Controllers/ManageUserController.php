<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Http\Requests;
use App\Http\Requests\RegisterUserRequest;

class ManageUserController extends Controller
{
    //
    public function newUser()
    {
        return view('new_user');
    }

    public function createNewUser(RegisterUserRequest $request)
    {
    	$new_user = User::createNewUser($request);
    	if(NULL !== $new_user || NULL !== $new_user->id || !empty($new_user))
    	{
    		flash('Usuario creado con éxito', 'success');
    		return redirect()->route('admin.new_user');
    	}
    	flash('No pudo crearse el usuario', 'error');
    	return redirect()->route('admin.new_user');

    }
}
