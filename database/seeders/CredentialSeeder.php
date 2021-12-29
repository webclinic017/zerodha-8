<?php

namespace Database\Seeders;
use App\Models\Credential;

use Illuminate\Database\Seeder;

class CredentialSeeder extends Seeder{
    public function run(){
        $data = [
            'api_key' => '262g9l62v67cisk6',
            'api_secrate' => '1abmptf0yy7mxim4gaw72o6d1nbumab3',
            'request_token' => null,
            'access_token' => null
        ];

        foreach ($data as $key => $val) {
            Credential::create(['key' => $key, 'value' => $val]);
        }

    }
}