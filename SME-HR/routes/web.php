<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\EmployeeController;
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
    return view('auth.login');
});

Route::group([ "middleware" => ['auth:sanctum', config('jetstream.auth_session'), 'verified'] ], function() {
    Route::view('/dashboard', "dashboard")->name('dashboard');
});

Route::controller(App\Http\Controllers\EmployeeController::class)->group(function () {

    Route::get('/Register_Employee', 'CreateEmployee')->name('CreateEmployee');//link to go to reporthomepage
    Route::post('/storeEmployee', 'RegisterEmployee')->name('RegisterEmployee');//link to store the data to the database
    Route::get('/List_Employee', 'ListEmployee')->name('ListEmployee');//link to view list of employee

}); 
