<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnterpriseRequest extends FormRequest
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
        // application/x-iwork-keynote-sffkey
        // application/x-iwork-keynote-sffkey
        return [
            'nombre_empresa'            =>  'required',            
            'email_empresa'             =>  'required|email',
            'rut_empresa'               =>  'required',
            'ruta_h2h'                  =>  'required|url',
            'ruta_callback'             =>  'required|url',
            'archivo_llave_publica'     =>  'required|mimetypes:text/plain',
            'archivo_llave_privada'     =>  'required|mimetypes:text/plain',
            'ruta_imagen_empresa'       =>  'image'
        ];
    }

    public function messages()
    {
        return [
            'nombre_empresa.required'           =>  'El nombre de la empresa es requerido',
            
            'email_empresa.required'            =>  'El email es requerido',
            'email_empresa.email'               =>  'El email es inválido',
            
            'rut_empresa.required'              =>  'El rut de la empresa es requerido',

            'ruta_h2h.required'                 =>  'La ruta h2h es requerida',
            'ruta_h2h.url'                      =>  'La ruta h2h es inválida',

            'ruta_callback.required'            =>  'La ruta callback es requerida',
            'ruta_callback.url'                 =>  'La ruta callback es inválida',


            'ruta_callback.required'            =>  'La ruta callback es requerida',
            'ruta_callback.url'                 =>  'La ruta callback es inválida',
            
            'archivo_llave_publica.required'    =>  'El archivo de llave pública es requerido',
            'archivo_llave_publica.mimetypes'   =>  'El archivo de llave pública es inválido',

            'archivo_llave_privada.required'    =>  'El archivo de llave privada es requerido',
            'archivo_llave_privada.mimetypes'   =>  'El archivo de llave privada es inválido',

            'ruta_imagen_empresa.image'         =>  'El logo de la empresa debe ser una imagen válida'
        ];
    }
}
