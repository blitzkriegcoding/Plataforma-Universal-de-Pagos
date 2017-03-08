<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\CreateClientRequest;
use App\Http\Requests\UpdateClientRequest;

use App\Cliente;
use App\ClienteEmpresa;
use App\Empresa;

class ClientController extends Controller
{
    //
    public function newClient()
    {
    	return view('new_client');
    }

    public function createClient(CreateClientRequest $request)
    {
    	$new_client = new Cliente();
    	$new_client->rut_cliente = $request->rut_cliente ;
    	$new_client->nombre_cliente = $request->nombre_cliente ;
    	$new_client->apellido_cliente = $request->apellido_cliente ;
    	$new_client->telefono_cliente = $request->telefono_cliente ;
    	$new_client->email_cliente = $request->email_cliente ;
        $new_client->direccion_cliente = $request->direccion_cliente;
    	$new_client->save();

    	$cliente_empresa = ClienteEmpresa::firstOrCreate(['rut_cliente' => $request->rut_cliente, 'id_empresa' => Empresa::getIdEmpresa()]);
    	flash('Cliente registrado con éxito', 'success');
    	return redirect()->route('admin.new_client');
    }

    public function getClientByRut(Request $request)
    {
    	return Cliente::getClientByRut($request->rut_cliente);
    }

    public function getQuotePlanClientByRut(Request $request)
    {
        return Cliente::getQuotePlanClientByRut($request->rut_cliente);
    }

    public function reportClients()
    {
        return view('report_clients');
    }

    public function getAllClients()
    {
        return Cliente::getAllClients();
    }

    public function getFilteredClients(Request $request)
    {
        return Cliente::getFilteredClients($request);
    }
    
    public function updateClient(UpdateClientRequest $request)
    {
        try
        {
            Cliente::updateClient($request);
        }
        catch(Exception $e)
        {
            $e;
        }
    }

    public function viewClientQuotes()
    {
        return view('view_client_quote');
    }
}
