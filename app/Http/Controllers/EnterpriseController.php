<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\EnterpriseRequest;

use App\Empresa;
use App\EmpresaCanal;
class EnterpriseController extends Controller
{
    //
    public function newEnterprise()
    {
    	return view('new_enterprise');
    }

    public function editEnterprise(EnterpriseRequest $request)
    {

    }

    public function createEnterprise(EnterpriseRequest $request)
    {
    	#dd($request);
        # dd(base_path('resources/uploads/keys/private.key'));
        # base_path('resources/uploads/keys/');
        $new_enterprise = new Empresa();
        
        $new_enterprise->nombre_empresa = $request->nombre_empresa;
        $new_enterprise->nombre_fantasia = $request->nombre_fantasia || NULL;
        $new_enterprise->rut_empresa = str_replace('.','',strtolower(trim($request->rut_empresa)));
        $new_enterprise->email_empresa = trim($request->email_empresa);
        $new_enterprise->url_autorizada_1 = trim($request->ruta_h2h);
        $new_enterprise->url_autorizada_2 = trim($request->ruta_callback);

        #dd($new_enterprise);
        // Trabajando con los archivos subidos 

        /*
            La variable $nombre_empresa corresponderá al subdirectorio dentro del directorio uploads/keys
            como carpeta de identificacion única para almacenar sus claves, tanto la pública como la privada
        */
        $nombre_empresa = $new_enterprise->rut_empresa;

        #dd($request->rut_empresa);
        if(FALSE == is_dir(base_path('resources/uploads/keys/').$nombre_empresa.'_'.$request->id_empresa))
        {
            try
            {
                mkdir(base_path('resources/uploads/keys/').$nombre_empresa.'_'.$request->id_empresa, 755);
                $dir_key = base_path('resources/uploads/keys/').$nombre_empresa.'_'.$request->id_empresa;
                $llave_publica = $request->file('archivo_llave_publica');
                $llave_privada = $request->file('archivo_llave_privada');

                $llave_publica->move($dir_key, $llave_publica->getClientOriginalName());
                $llave_privada->move($dir_key, $llave_privada->getClientOriginalName());

                $new_enterprise->ruta_clave_publica = $dir_key."/".$llave_publica->getClientOriginalName();
                $new_enterprise->ruta_clave_privada = $dir_key."/".$llave_privada->getClientOriginalName();

            }
            catch(Exception $e)
            {
                throw $e;
                exit;
            }            
        }
        else
        {
            $dir_key = base_path('resources/uploads/keys/').$nombre_empresa.'_'.$request->id_empresa;
            $llave_publica = $request->file('archivo_llave_publica');
            $llave_privada = $request->file('archivo_llave_privada');

            $llave_publica->move($dir_key, $llave_publica->getClientOriginalName());
            $llave_privada->move($dir_key, $llave_privada->getClientOriginalName());

            $new_enterprise->ruta_clave_publica = $dir_key."/".$llave_publica->getClientOriginalName();
            $new_enterprise->ruta_clave_privada = $dir_key."/".$llave_privada->getClientOriginalName();

            

        }
        if(FALSE == is_dir(base_path('resources/uploads/logs/').$nombre_empresa.'_'.$request->id_empresa))
        {
            try
            {
                mkdir(base_path('resources/uploads/logs/').$nombre_empresa.'_'.$request->id_empresa, 755);
                $dir_log = base_path('resources/uploads/logs/').$nombre_empresa.'_'.$request->id_empresa;
                $new_enterprise->ruta_log = $dir_log;
            }
            catch(Exception $e)
            {
                throw $e;
                exit;
            } 
        }
        else
        {
            $dir_log = base_path('resources/uploads/logs/').$nombre_empresa.'_'.$request->id_empresa;
            $new_enterprise->ruta_log = $dir_log;            
        }
        if(FALSE == is_dir(base_path('resources/uploads/images/').$nombre_empresa.'_'.$request->id_empresa))
        {
            try
            {
                mkdir(base_path('resources/uploads/images/').$nombre_empresa.'_'.$request->id_empresa, 755);
                $dir_image = base_path('resources/uploads/images/').$nombre_empresa.'_'.$request->id_empresa;
                $logo = $request->file('ruta_imagen_empresa');
                $logo->move($dir_image, $logo->getClientOriginalName());
                $new_enterprise->ruta_img_empresa = $dir_image."/".$logo->getClientOriginalName();
            }
            catch(Exception $e)
            {
                throw $e;
                exit;
            }
        }
        else
        {
            $dir_image = base_path('resources/uploads/images/').$nombre_empresa.'_'.$request->id_empresa;
            $logo = $request->file('ruta_imagen_empresa');
            $logo->move($dir_image, $logo->getClientOriginalName());            
            $new_enterprise->ruta_img_empresa = $dir_image."/".$logo->getClientOriginalName();
        }

        dd($new_enterprise);
    }

    public function getEnterpriseByName(Request $request)
    {
        return Empresa::getEnterpriseByName($request->name);
    }
}
