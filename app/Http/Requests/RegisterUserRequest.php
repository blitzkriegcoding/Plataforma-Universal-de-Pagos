<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'rut_usuario'   => 'required|unique:users,rut_usuario',
            'name'          => 'required|max:255',
            'email'         => 'required|email|max:255|unique:users,email',
            'password'      => 'required|min:6|confirmed',
            'active'        => 'required|in:0,1',
            'id_empresa'    => 'required|exists:empresas,id_empresa'
        ];
    }

    public function messages()
    {
        return [
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
            'id_empresa.exists'     =>  'Debe seleccionar una opción válida'

        ];

    }
}
