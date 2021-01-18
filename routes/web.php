<?php

use App\Http\Controllers\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//integration

Route::get('prepare-to-login',function(){

    $state = Str::random(48);

    session(['state'=>$state]);

    $query = http_build_query([
        'client_id'=>'',
        'redirect_url'=>'',
        'response_type'=>'code',
        'scope'=>'',
        'state'=>$state
    ]);


    return redirect(env('API_URL').'oauth/authorize?'.$query);

})->name('prepare.login');

Route::get('callback',function(Request $request){

    $response = Http::post(env('API_URL').'oauth/token',[
        'grant_type'=> 'authorization_code',
        'client_id'=>'',
        'client_secret'=>'',
        'redirect_url'=>'',
        'code'=>$request->code,
    ]);

    dd($response->json());
});





//other grant types

Route::get('grant-password',function(){

    $response = Http::post(env('API_URL').'oauth/token',[
        'grant_type'=> 'password',
        'client_id'=>'',
        'client_secret'=>'',
        'username'=>'',
        'password'=> '',
        'scope'=>'',
    ]);

    dd($response->json());
});

Route::get('grant-client',function(Request $request){

    $response = Http::post(env('API_URL').'oauth/token',[
        'grant_type'=> 'client_credentials',
        'client_id'=>'',
        'client_secret'=>'',
        'scope'=>'',
    ]);

    dd($response->json());
});

