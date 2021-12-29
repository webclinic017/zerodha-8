<?php

use KiteConnect\KiteConnect;

if(!function_exists('_site_title')){
    function _site_title(){
        return 'Zerodha';
    }
}

if(!function_exists('_credential')){
    function _credential($param){
        $data = DB::table('credentials')->select('value')->where(['key' => $param])->first();

        if($data)
            return $data->value;
        else
            return false;
    }
}

if(!function_exists('_set_credential')){
    function _set_credential($key, $value){
        $update = DB::table('credentials')->where(['key' => $key])->update(['value' => $value]);

        if($update)
            return true;
        else
            return false;
    }
}

if(!function_exists('_kite')){
    function _kite(){
        $api_key = _credential('api_key');
        $access_token = _credential('access_token');
        $kite = new KiteConnect($api_key, $access_token, null, false, 1000);
        return $kite;
    }
}

if(!function_exists('_set_access_token')){
    function _set_access_token($request_token){
        $api_secrate = _credential('api_secrate');
        $kite = _kite();

        try {
            $user = $kite->generateSession($request_token, $api_secrate);
            $access_token = $user->access_token;
            $kite->setAccessToken($user->access_token);
            _set_credential('access_token', $access_token);
            return $access_token;
        } catch(Exception $e) {
            return false;
        }
    }
}

?>