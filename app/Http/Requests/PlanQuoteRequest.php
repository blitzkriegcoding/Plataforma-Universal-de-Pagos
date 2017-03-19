<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlanQuoteRequest extends FormRequest
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
            'cuotas'        => 'required|integer',
            'paquete'       => 'required|between:5,50',
            'vencimiento'   => 'required|date_format:Y-m-d',
            'credito'       => 'required|integer',
            'id_plan_cuota' => 'required|exists:plan_cuotas,id_plan_cuota'
        ];
    }

    public function messages()
    {
        return [
            'cuotas.required'           =>  'El número de cuotas es requerido',
            'cuotas.integer'            =>  'Este campo es solo númerico',

            'paquete.required'          =>  'El nombre del paquete es requerido',
            'paquete.between'           =>  'El nombre del paquete debe tener entre 5 y 50 caracteres',

            'vencimiento.required'      =>  'La fecha de vencimiento es requerido',
            'vencimiento.date_format'   =>  'El formato de la fecha es AAAA-MM-DD',

            'credito.required'          =>  'El número de crédito es requerido',
            'credito.integer'           =>  'El campo crédito debe ser un campo entero',

            'id_plan_cuota.required'    =>  'El Plan de cuotas es requerido',
            'id_plan_cuota.exists'      =>  'El Plan de cuotas debe existir en la base de datos'
        ];
    }
}
