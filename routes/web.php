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

Route::get('/', function () {
    return view('create_session');
});

Route::group(['middleware' => 'web'], function() {
    Route::resource('sessions', 'SessionsController');
});

Route::group(['middleware' => 'web'], function() {
    Route::resource('sites', 'SitesController');
});

Route::get('/sessionResults/{id}', [
    'middleware' => 'web',
    'uses' => 'SitesController@exportCSV'
])->name('session.results');
