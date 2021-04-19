<?php

use Illuminate\Support\Facades\Route;
use App\Controllers\questionController;
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
    return view('cadastroVacinas');
})->where('any', '.*');
//Route::get('/home', 'App\Http\Controllers\ControllerAsk@index');
Route::get('/register', function (){
    return view('register');
});
Route::get('/pacientes', function (){
    return view('registerP');
});

Route::resource('/regiterv', 'App\Http\Controllers\pacientes');