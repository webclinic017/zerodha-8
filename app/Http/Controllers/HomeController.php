<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use KiteConnect\KiteConnect;

class HomeController extends Controller{
    public function index(Request $request){
        $kite = _kite();
        $api_key = _credential('api_key');
        $request_token = $request->request_token ?? null;
        $error = false;
        $access_token = false;
        
        if($request_token){
            _set_credential('request_token', $request_token);
            $set_access_token = _set_access_token($request_token);

            if($set_access_token)
                $access_token = $set_access_token;
            else
                $error = 'Something went wrong, please try again later';
        }

        if($access_token){
            return redirect()->route('instrument');
        }else{
            return view('index', ['error' => $error, 'api_key' => $api_key]);
        }
    }

    public function instrument(Request $request){
        if($request->ajax()){
            $kite = _kite();
            $instruments = $kite->getInstruments('NSE');
            return response()->json($instruments);
        }

        return view('instrument');
    }
}
