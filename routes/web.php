<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Milon\Barcode\PDF417;

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

Route::resource('/customer', 'CustomerController');


Route::resource('/cusfolder', 'PromotionController');



Route::resource('/bank','BankAccountController');
Route::resource('/exchange','ExchangeController');


Route::get('/', function () {
    return view('sample');
});

Route::resource('employee', 'EmployeeController');

Route::resource('voucher', 'VoucherController');

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
Route::get('/login', function(){
    return view('login');
});
Route::get('/role', function(){
    return view('User.addUserRole');
});

Route::get('/barcode', 'BarcodeController@index')->name('barcode');
Route::get('/barcodeprint', 'BarcodeController@createPDF')->name('printBarcode');


Route::resource('user', 'UserController');
Route::resource('role', 'UserRoleController');
Route::resource('category', 'CategoryController');
Route::resource('product', 'productController');
Route::resource('expense', 'ExpenseController');
Route::resource('sale', 'SalesController');
Route::patch('/updateExpense', 'ExpenseController@updateExpense')->name('updateExpense');
Route::patch('/password/{id}','UserController@updatePassword')->name('user.password');
Route::patch('/pin/{id}','UserController@updatePin')->name('user.pin');

Route::resource('inventories', 'InventoryController');
