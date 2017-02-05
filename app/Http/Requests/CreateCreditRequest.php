<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCreditRequest extends FormRequest
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
            'rut_cliente'       => 'required|integer',
            'paquete'           => 'required|size:50',
            'fecha_vencimiento' => 'required|date_format:d-m-Y',
            'total_credito'     => 'required|numeric',
            'nro_credito'       => 'required|integer|unique:plan_cuotas,nro_credito',
            'interes_diario'    => 'required|numeric',
            'interes_mensual'   => 'required|numeric',            
        ];
    }

    public function messages()
    {
        return [
        'rut_cliente.required'          => 'Debe seleccionar un cliente para el desarrollo del crédito', 
        'rut_cliente.integer'           => 'El cliente debe ser válido',
        'paquete.required'              => 'El paquete de crédito es requerido',
        'paquete.max'                   => 'El nombre del paquete excede el número máximo de caracteres (50)',
        'fecha_vencimiento.required'    => 'La fecha de vencimiento del crédito es requerida',
        'fecha_vencimiento.date_format' => 'El formato de la fecha de vencimiento del crédito es inválida',
        'total_credito.required'        => 'El monto total del crédito es requerido',
        'total_credito.numeric'         => 'El monto del crédito debe ser numérico',
        'nro_credito.required'          => 'El número de crédito es requerido',
        'nro_credito.integer'           => 'El número de crédito debe ser numérico entero',        
        'interes_diario.required'       => 'El valor del interés diario del cliente es requerido',
        'interes_diario.numeric'        => 'El valor del interés diario debe ser numérico',
        'interes_mensual.required'      => 'El valor del interes mensual es requerido ',
        'interes_mensual.numeric'       => 'El valor del interés mensual debe ser numérico',        
        ];
    }
}
