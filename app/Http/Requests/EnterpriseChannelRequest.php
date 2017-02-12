<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnterpriseChannelRequest extends FormRequest
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
            'id_empresa'    => 'required|integer|exists:empresas,id_empresa',
            'id_canal'      => 'required|integer|exists:canales,id_canal'
        ];
    }

    public function messages()
    {
        return [
            'id_empresa.required'   => 'Debe seleccionar una empresa',
            'id_empresa.integer'    => 'Debe seleccionar una opción válida',
            'id_empresa.exists'     => 'La empresa seleccionada no existe ',

            'id_canal.required'   => 'Debe seleccionar un canal',
            'id_canal.integer'    => 'Debe seleccionar una opción válida',
            'id_canal.exists'     => 'El canal seleccionada no existe ',
        ];
    }
}
