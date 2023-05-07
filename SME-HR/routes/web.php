<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\ClaimController;
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
    Route::get('/employees/total', 'getTotalEmployees')->name('getTotalEmployees');;//to get total employee
    Route::delete('deleteEmployee/{id}', 'App\Http\Controllers\EmployeeController@deleteEmployee')->name('deleteEmployee');//link to delete the data from the database
    Route::get('editEmployee/{id}', 'editEmployee')->name('editEmployee');//link to go to edit page
    Route::put('updateEmployee/{id}', 'App\Http\Controllers\EmployeeController@updateEmployee')->name('updateEmployee');//link to update the data in the database
    Route::get('viewEmployee/{id}', 'viewEmployee')->name('viewEmployee');//link to go to edit page
}); 

Route::controller(App\Http\Controllers\PayrollController::class)->group(function () {

    Route::get('/List_Payroll', 'ListPayroll')->name('ListPayroll');//link to go to payroll list page
    Route::get('/Generate_Payslip', 'GeneratePayslip')->name('GeneratePayslip');//link to go to generate payslip
    Route::get('/View_Payslip', 'ViewPayslip')->name('ViewPayslip');//link to go to generate payslip

});

Route::controller(App\Http\Controllers\ClaimController::class)->group(function () {

    Route::get('/Apply_claim', 'ApplyClaim')->name('ApplyClaim');//link to go to reporthomepage
    Route::get('/List_Claim', 'ListClaim')->name('ListClaim');//link to go to claim list page

});

Route::controller(App\Http\Controllers\LeaveController::class)->group(function () {

    Route::get('/Apply_Leave', 'ApplyLeave')->name('ApplyLeave');//link to go to apply leave page

});