<?php


use App\Http\Controllers\PhoneBooksController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/phone_books', [
    PhoneBooksController::class,'index'
]);

Route::middleware('auth:api')->post('/phone_book', [
    PhoneBooksController::class,'store'
]);

Route::middleware('auth:api')->get('/phone_books/{id}', [
    PhoneBooksController::class,'show'
]);

Route::middleware('auth:api')->put('/phone_books/{id}', [
    PhoneBooksController::class,'update'
]);

Route::middleware('auth:api')->delete('/phone_books/{id}', [
    PhoneBooksController::class,'destroy'
]);


