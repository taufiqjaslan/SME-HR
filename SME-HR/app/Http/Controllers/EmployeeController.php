<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\EmployeeRecord;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function ListEmployee()
    {
        //display list of employee
        $list = EmployeeRecord::all();
        return view('ManageEmployee.EmployeeList', ["lists" => $list]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function RegisterEmployee(Request $request)
    {
        //store a new user (staff)
        $newUser = EmployeeRecord::create([
            'name' => $request['name'],
            'username' => $request['username'],
            'phone_number' => $request['phone_number'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'address' => $request['address'],
            'gender' => $request['gender'],
            'start_date' => $request['start_date'],
            'end_date' => $request['end_date'],
            'position_id' => $request['position_id'],
            'user_type_id' => $request['user_type_id'],
        ]);

        return redirect()->route('employee');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
