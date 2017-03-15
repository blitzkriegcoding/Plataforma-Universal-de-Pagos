<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckDatePaymentRequest extends FormRequest
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
            'dt_start'    =>  'date_format: d/m/Y|required',
            'dt_end'      =>  'date_format: d/m/Y|required'  
        ];
    }

    public function messages()
    {
        return [
            'dt_start.date_format'    => 'El campo de fecha de inicio tiene formato inválido',
            'dt_start.required'       => 'El campo de fecha de inicio es requerido',
            'dt_end.date_format'      => 'El campo de fecha final tiene formato inválido',
            'dt_end.required'         => 'El campo de fecha final es requerido',
        ];
    }
}
