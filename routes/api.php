<?php

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
Route::get('/home', 'App\Http\Controllers\pacientes@index');
Route::apiResource('/home', 'App\Http\Controllers\pacientes');
Route::get('/vacina', 'App\Http\Controllers\vacina@index');
Route::apiResource('/vacina', 'App\Http\Controllers\vacina');
Route::post('addVacina', 'App\Http\Controllers\vacina@add');
Route::post('add', 'App\Http\Controllers\pacientes@add');
Route::apiResource('/vacinaregistro', 'App\Http\Controllers\registrovacina');
Route::get('/vacinaregistro', 'App\Http\Controllers\registrovacina@index');
Route::post('addRegistroV', 'App\Http\Controllers\registrovacina@add');
