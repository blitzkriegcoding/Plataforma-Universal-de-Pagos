<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CanalesRequest extends FormRequest
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
            'canal' => 'required|integer|unique:canales,canal'
        ];
    }
    public function messages()
    {
        return [
            'canal.required' => 'Debe escribir el número de canal',
            'canal.integer'  => 'El valor del canal es numérico',
            'canal.unique'  =>  'El valor del canal ya se encuentra registrado'
        ];
    }
}
