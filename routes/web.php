<?php

use Illuminate\Support\Facades\Route;

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


Route::fallback('IndexController@index');

Route::get('/admin','IndexController@admin')->name('admin');
// Route::get('{any}', 'IndexController@index')->where('any', '.*');

Route::post('/excell/import','IndexController@import')->name('import_excel');

Route::get('/auth/{name}/redirect', 'Auth\LoginController@redirect')->name('redirectauth');
Route::get('/auth/{name}/callback', 'Auth\LoginController@callback')->name('callbackauth');

Route::get('/login', 'Auth\LoginController@login')->name('login');
Route::get('/register', 'Auth\LoginController@register')->name('register');

Route::post('/login/auth', 'Auth\LoginController@authlogin')->name('auth_login');
Route::post('/register/auth', 'Auth\LoginController@authregister')->name('auth_register');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/get/a_u', 'Auth\LoginController@getAU')->name('getAU');

Route::get('/pdf/{id}','IndexController@pdf')->name('pdf');
Route::get('/pdf-show/{id}','IndexController@pdfShow')->name('pdfShow');