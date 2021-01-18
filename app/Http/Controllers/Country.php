<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Country extends Controller
{
    /**
     * @return mixed
     */
    public static function getCountryCodes(){
        $response = Http::get('http://country.io/continent.json');
        return json_decode($response, true);
    }
}
