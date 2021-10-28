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
    return view('welcome');
});


// create user route
Route::get('todo/register','App\Http\Controllers\todoListController@createUser');
// store user 
Route::post('todo/register','App\Http\Controllers\todoListController@storeUser');

Route::get('todo/login','App\Http\Controllers\todoListController@loginView');
Route::post('dologin','App\Http\Controllers\todoListController@login');
Route::get('todo/logout','App\Http\Controllers\todoListController@logout');
// resources routes
Route::resource('todo','App\Http\Controllers\todoListController');
