<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\CanalesRequest;
use App\Canal;

class ChannelController extends Controller
{
    public function newChannel()
    {
    	return view('new_channel');
    }

    public function createChannel(CanalesRequest $request)
    {
    	#dd($request->canal);
    	Canal::create(['canal' => $request->canal, 'canal_hash' => bcrypt($request->canal)]);
    	flash("Canal $request->canal creado satisfactoriamente", "success");
    	return redirect()->route('admin.new_channel');
    }

    public function getChannelByNumber(Request $request)
    {
        return Canal::getChannelByNumber($request->channel);
    }
}
