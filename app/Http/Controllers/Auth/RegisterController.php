<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\EmpresaUsuario;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        # $this->middleware('admin');
    }



    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    // protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //         'rut_cliente'   => 'required|exists:users,rut_cliente',
    //         'name'          => 'required|max:255',
    //         'email'         => 'required|email|max:255|unique:users',
    //         'password'      => 'required|min:6|confirmed',
    //         'active'        => 'required|in:0,1'
    //     ]);
    // }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {   
        $new_user = User::create([
            'rut_cliente'   => $data['rut_cliente'],
            'name'          => $data['name'],
            'email'         => $data['email'],
            'password'      => bcrypt($data['password']),
            'active'        => 0        
        ]);
        EmpresaUsuario::create(['id_empresa' => $data['id_empresa'], 'user_id' => $new_user->id]);
        return $new_user;
    }
}
