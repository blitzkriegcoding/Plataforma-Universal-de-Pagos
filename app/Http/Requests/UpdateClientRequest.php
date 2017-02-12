<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
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
            'rut_cliente' => 'required|max:12',
            'nombre_cliente' => 'required|max:75',
            'apellido_cliente' => 'required|max:75',
            'telefono_cliente' => 'required|max:15',
            'email_cliente' => 'required|max:50|email',
            'direccion_cliente' => 'required|max:255'
        ];
    }

    public function messages()
    {
        return ['rut_cliente.required' => 'El rut del cliente es requerido', 
        'rut_cliente.unique' => 'El rut que intenta incluir ya existe',
        'rut_cliente.max' => 'La longitud del rut es de máximo 12 caracteres',
        'nombre_cliente.required' => 'El nombre del cliente es requerido',
        'nombre_cliente.max' => 'La longitud del nombre es de máximo 75 caracteres',
        'apellido_cliente.required' => 'El apellido del cliente es requerido',
        'apellido_cliente.max' => 'La longitud del apellido del cliente es de máximo 75 caracteres',        
        'telefono_cliente.required' => 'El teléfono del cliente es requerido',
        'telefono_cliente.max' => 'La longitud del teléfono del cliente es mas larga de lo requerido',        
        'email_cliente.required' => 'El email del cliente es mas larga de lo requerido',
        'email_cliente.max' => 'La longitud del email del cliente es de máximo 50 caracteres',
        'email_cliente.email' => 'El email del cliente es inválido',
        'direccion_cliente.required' => 'La dirección del cliente es requerida',
        'direccion_cliente.max' => 'La dirección del cliente es de máximo 255 caracteres',
        ];
    }
}
