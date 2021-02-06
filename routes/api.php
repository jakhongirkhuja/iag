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


Route::get('/show/estate/','Api\ApiController@showing')->name('showing');
Route::get('/estate/{slug}','Api\ApiController@showingEstate')->name('showingEstate');



Route::get('/remont/types','Api\FilterController@getRemonts')->name('getRemonts');
Route::get('/remont/generalFilter','Api\FilterController@generalFilter')->name('generalFilter');


Route::get('/show/owners/','Api\ApiController@getOwners')->name('owners');
Route::get('/show/owners/ownerstype','Api\ApiController@getOwnersType')->name('ownersType');

Route::get('/show/owner/estate/{id}','Api\ApiController@OwnerEstate')->name('OwnerEstate');
Route::get('/show/owner/info/{id}','Api\ApiController@OwnerInfo')->name('OwnerInfo');

Route::post('/getnumber','Api\ApiController@getnumber')->name('getnumber');
Route::post('/getnumberEstate','Api\ApiController@getnumberbyEstate')->name('getnumberbyEstate');



Route::get('/getposttocheck','Api\ApiController@getposttocheck')->name('getposttocheck');
Route::post('/setStatusEstate','Api\ApiController@setStatusEstate')->name('setStatusEstate');

