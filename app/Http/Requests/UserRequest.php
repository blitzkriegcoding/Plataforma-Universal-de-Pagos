<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'rut_usuario'       =>  'required|regex:/[0-9]{1,8}\-[0-9kK]{1}/',
            'name'              =>  'required|between:10,50',
            'email'             =>  'required|email'
        ];
    }

    public function messages()
    {
        return [
            'rut_usuario.required'      =>  'El RUT del usuario es requerido',
            'rut_usuario.regex'         =>  'El RUT del usuario es inválido',
            'name.required'             =>  'El nombre del usuario es requerido',
            'name.between'              =>  'El nombre del usuario debe ser entre 10 y 50 caracteres',
            'email.required'            =>  'El email del usuario es requerido',            
            'email.email'               =>  'El email es inválido',
        ];
    }
}
