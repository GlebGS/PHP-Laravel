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


Route::prefix('user')->group(function (){
    Route::middleware('auth')->group(function (){
        Route::get('/id={id}', 'App\Http\Controllers\HomeController@index')->name('main');
        Route::get('/create/id={id}', 'App\Http\Controllers\HomeController@create');
        Route::get('/edit/id={id}', 'App\Http\Controllers\HomeController@edit');
        Route::get('/security/id={id}', 'App\Http\Controllers\HomeController@security');
        Route::get('/status/id={id}', 'App\Http\Controllers\HomeController@status');
        Route::get('/media/id={id}', 'App\Http\Controllers\HomeController@media');
        Route::get('/delete/id={id}', 'App\Http\Controllers\UserController@delete');
    });
});

Route::get('/logout', 'App\Http\Controllers\UserController@logout')->name('logout');
Route::get('/registration', 'App\Http\Controllers\HomeController@register')->name('register');
Route::get('/login', 'App\Http\Controllers\HomeController@login')->name('login');

Route::post('/register', 'App\Http\Controllers\UserController@register');
Route::post('/log_in', 'App\Http\Controllers\UserController@login');
Route::post('/edit_user/id={id}', 'App\Http\Controllers\UserController@edit');
Route::post('/security/id={id}', 'App\Http\Controllers\UserController@security');
Route::post('/status/id={id}', 'App\Http\Controllers\UserController@status');
Route::post('/media/id={id}', 'App\Http\Controllers\UserController@media');
Route::post('/create_user/id={id}', 'App\Http\Controllers\UserController@create');
