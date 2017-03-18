<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
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
            'old_password'              =>  'required',
            'password'                  =>  'required|between:6,12|confirmed',
            'password_confirmation'     =>  'required|between:6,12'
        
        ];
    }

    public function messages()
    {
        return [
            'old_password.required'             => 'La contraseña anterior es requerida',
            'password.required'                 => 'La nueva contraseña es requerida',
            'password.between'                  => 'La nueva contraseña debe tener entre 6 y 12 carácteres',
            'password.confirmed'                => 'La nueva contraseña debe y su confirmación no coinciden',
            'password_confirmation.required'    => 'La confirmación de nueva contraseña es requerida',
        ];
    }
}
