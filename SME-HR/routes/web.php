<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/employee', function () {
        return view('ManageEmployee.AddEmployee');
    })->name('employee');
});

Route::controller(App\Http\Controllers\EmployeeController::class)->group(function () {

    Route::post('/store', 'store')->name('store');//link to store the data to the database
    Route::get('/ListEmployee', '')->name('store');//link to store the data to the database

}); 

