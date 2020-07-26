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
    return view('sample');
});

Route::get('/employees', 'EmployeeController@index');
Route::get('/create', 'EmployeeController@create');
//Route::get('/create', 'EmployeeController@store');
//Route::post('/employees/{emp_id}', 'EmployeeController@show');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
