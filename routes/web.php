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
        Route::get('/id={id}', 'App\Http\Controllers\HomeController@index');
    });
});

Route::get('/logout', 'App\Http\Controllers\UserController@logout')->name('logout');

Route::get('/registration', 'App\Http\Controllers\HomeController@register')->name('register');
Route::post('/register', 'App\Http\Controllers\UserController@register');

Route::get('/login', 'App\Http\Controllers\HomeController@login')->name('login');
Route::post('/log_in', 'App\Http\Controllers\UserController@login');
