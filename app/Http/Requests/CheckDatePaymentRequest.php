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
            'date_start'    =>  'date_format: Y-m-d|required',
            'date_end'      =>  'date_format: Y-m-d|required'  
        ];
    }

    public function messages()
    {
        return [
            'date_start.date_format'    => 'El campo de fecha de inicio tiene formato inválido',
            'date_start.required'       => 'El campo de fecha de inicio es requerido',
            'date_end.date_format'      => 'El campo de fecha final tiene formato inválido',
            'date_end.required'         => 'El campo de fecha final es requerido',
        ];
    }
}
