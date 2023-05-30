<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\ClaimController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\SalaryTypeController;
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
    Route::get('/Apply_claim', 'ApplyClaim')->name('ApplyClaim');//link to go to apply claim
    Route::get('/List_Claim', 'ListClaim')->name('ListClaim');//link to go to claim list page
    Route::post('/storeClaim', 'StoreClaim')->name('StoreClaim');//link to store the data to the database
    Route::get('viewClaim/{id}', 'viewClaim')->name('viewClaim');//link to go to view page
});

Route::controller(App\Http\Controllers\LeaveController::class)->group(function () {
    Route::get('/Apply_Leave', 'ApplyLeave')->name('ApplyLeave');//link to go to apply leave page
});

Route::controller(App\Http\Controllers\EAFormController::class)->group(function () {
    Route::get('/EAForm', 'EAForm')->name('EAForm');//link to view list of employee 
    Route::get('viewEAForm/{id}', 'ListEAForm')->name('ListEAForm');//link to go to view ea form
    Route::get('Add_EAForm/{id}', 'addEAForm')->name('addEAForm');//link to go to add ea form
});

Route::controller(App\Http\Controllers\PositionController::class)->group(function () {
    Route::get('/List_Position', 'ListPosition')->name('ListPosition');//link to list of position page
    Route::get('Add_Position', 'addPosition')->name('addPosition');//link to go to add position page
    Route::post('/Store_Position', 'StorePosition')->name('StorePosition');//link to go to store the postion data into db
});

Route::controller(App\Http\Controllers\SalaryTypeController::class)->group(function () {

});

Route::controller(App\Http\Controllers\ClaimTypeController::class)->group(function () {
    Route::get('/ListClaimType', 'ListClaimType')->name('ListClaimType');//link to list of claim typepage
    Route::get('AddClaimType', 'addClaimType')->name('addClaimType');//link to go to add claim type page
    Route::post('/StoreClaimType', 'StoreClaimType')->name('StoreClaimType');//link to go to store the claim type data into db
});