<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateQuoteRequest extends FormRequest
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
            'nro_cuota'         => 'required|integer',
            'valor_cuota'       => 'required|numeric',
            'activa'            => 'required|in:V,F',
            'status_cuota'      => 'required',
            'fecha_vencimiento' => 'required|date:d-m-Y'
        ];
    }

    public function messages()
    {
        return [
            'nro_cuota.required'            =>  'El número de cuota es requerido',
            'nro_cuota.integer'             =>  'El valor consecutivo de la cuota es numérico',
            'valor_cuota.required'          =>  'EL valor de la cuota es requerido',
            'valor_cuota.numeric'           =>  'El valor de la cuota es numérico',
            'activa.required'               =>  'La cuota debe estar activa o inactiva',
            'activa.max'                    =>  '¿La cuota está activa o inactiva?',
            'status_cuota.required'         =>  'El estado de la cuota es requerido',
            'fecha_vencimiento.required'    =>  'La fecha de vencimiento es requerida',
            'fecha_vencimiento.date'        =>  'La fecha de vencimiento debe tener formato DD-MM-AAAA'

        ];
    }
}
