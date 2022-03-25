<?php

use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\getApiyourtext;

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
    return view('welcome');
});



Route::post('/get-statistic', 'App\Http\Controllers\ApiController@apiYourtext')->name('get-statistic');
Route::post('/text-comparison', 'App\Http\Controllers\ApiController@checkGuid')->name('text-comparison');
Route::get('/', 'App\Http\Controllers\ApiController@sendText')->name('send-data');
Route::match(['get', 'post'],'/send-content/{id}', 'App\Http\Controllers\ApiController@sendContent')
    ->name('send-content');
