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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/getRandomUrl/{id}','Api\ApiController@getRandomParsingPage')->name('getRandomUrl');
Route::post('/submit','Api\ApiController@index')->name('api_submit');


Route::get('/show/estate/{id?}','Api\ApiController@showing')->name('showing');
Route::get('/estate/{slug}','Api\ApiController@showingEstate')->name('showingEstate');
Route::get('/count/estates','Api\ApiController@countEstates')->name('countEstates');

