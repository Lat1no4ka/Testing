<?php

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

use Illuminate\Http\Response;

Route::get('/GetData', 'QUERY@GetData')->middleware('check'); //Перед выполнением запроса роутер проверяет состояние БД

Route::get('/', function () {
     return response()->view('welcome');
});
