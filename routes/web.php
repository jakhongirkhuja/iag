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
