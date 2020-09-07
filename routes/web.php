<?php

use App\Http\Controllers\UserController;
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

Route::resource('employee', 'EmployeeController');

Route::resource('voucher', 'VoucherController');

Route::resource('attendance', 'AttendanceController');

//Route::get('/employees', 'EmployeeController@index');
//Route::get('/create', 'EmployeeController@create');
//Route::post('/store', 'EmployeeController@store')->name('employees.store');
//Route::post('/employees/{emp_id}', 'EmployeeController@show');


Route::get('/sample', function () {
    return view('sampleAddForm');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/pos', function(){
    return view('POS.pos');
});

Route::resource('user', 'UserController');

Route::patch('/password/{id}','UserController@updatePassword')->name('user.password');
Route::patch('/pin/{id}','UserController@updatePin')->name('user.pin');
