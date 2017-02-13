<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadFileRequest extends FormRequest
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
            'lote_credito'  =>  "required|file|mimetypes:application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,text/csv,text/plain",
            'filetype'      =>  "required|in:csv,xls"
            # 'lote_credito' => "required|file|mimes:xls,xlsx,csv,txt",

        ];
    }
    public function messages()
    {
        return [
            'lote_credito.required'     => 'Debe cargar un archivo',
            'lote_credito.file'         => 'Debe cargar un archivo válido de Excel (XLS, XLSX,CSV)',            
            'lote_credito.mimetypes'    => 'Debe cargar un archivo válido de Excel (XLS, XLSX,CSV)',

            'filetype.required'         =>  'Debe seleccionar que tipo de archivo va a cargar',
            'filetype.in'               =>  'Debe seleccionar un tipo de archivo válido'

        ];
    }
}
