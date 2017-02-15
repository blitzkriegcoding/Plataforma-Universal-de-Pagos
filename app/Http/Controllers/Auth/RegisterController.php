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
    protected function validator(array $data)
    {
        return Validator::make($data,
            [
            'rut_usuario'   => 'required|unique:users,rut_usuario',
            'name'          => 'required|max:255',
            'email'         => 'required|email|max:255|unique:users,email',
            'password'      => 'required|min:6|confirmed',
            'active'        => 'required|in:0,1',
            'id_empresa'    => 'required|exists:empresas,id_empresa'
            ],[
            'rut_usuario.required'  =>  'El RUT del usuario es requerido',
            'rut_usuario.unique'    =>  'El RUT del usuario ya existe',
            'name.required'         =>  'El nombre del usuario es requerido',
            'name.max'              =>  'El nombre del usuario debe ser menor o igual a 255 caracteres',
            'email.required'        =>  'El email del usuario es requerido',
            'email.email'           =>  'El email del usuario debe ser una dirección válida: su_email@mail.cl',
            'email.max'             =>  'El email del usuario debe ser menor o igual a 255 caracteres',
            'email.unique'          =>  'El email ya existe',
            'password.required'     =>  'El password es requerido',
            'password.min'          =>  'El password debe tener mínimo 6 caracteres',
            'password.confirmed'    =>  'El password y su confirmación no coinciden',
            'active.required'       =>  'El usuario debe estar activo o inactivo',
            'active.in'             =>  'Las opciones válidas son SI o NO',
            'id_empresa.required'   =>  'La empresa es requerida',
            'id_empresa.exists'     =>  'Debe seleccionar una opción válida']);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {   
        $new_user = User::create([
            'rut_usuario'   => $data['rut_usuario'],
            'name'          => $data['name'],
            'email'         => $data['email'],
            'password'      => bcrypt($data['password']),
            'active'        => 0
        ]);
        EmpresaUsuario::create(['id_empresa' => $data['id_empresa'], 'user_id' => $new_user->id]);
        flash('Usuario creado con éxito', 'success');
        return $new_user;
    }
}
