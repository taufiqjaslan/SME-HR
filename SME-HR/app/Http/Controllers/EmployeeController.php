<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\EmployeeRecord;
use App\Models\UserTypeRecord;
use App\Models\PositionRecord;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function ListEmployee()
    {
        $lists = EmployeeRecord::with('position', 'userType')
            ->join('positions', 'users.position_id', '=', 'positions.id')
            ->join('user_types', 'users.user_type_id', '=', 'user_types.id')
            ->select('users.*', 'positions.position_name', 'user_types.user_type_name')
            ->get();

        return view('ManageEmployee.EmployeeList', ["lists" => $lists]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createEmployee()
    {
        // Retrieve all usertype and position records and include the associated employee data
        $userTypes = UserTypeRecord::with('userType')->get();
        $positions = PositionRecord::all();
        $lists = [
            'userTypes' => $userTypes,
            'positions' => $positions,
        ];
        return view('ManageEmployee.AddEmployee', ["userTypesAndPositions" => $lists]); //link to go to addEmployee page
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
            'ic' => $request['ic'],
            'start_date' => $request['start_date'],
            'end_date' => $request['end_date'],
            'position_id' => $request['position_id'],
            'user_type_id' => $request['user_type_id'],
            'status' => 1,
        ]);

        return redirect()->route('ListEmployee');
    }

    public function viewEmployee(string $id)
    {
        $employeeInfo = EmployeeRecord::find($id);

        return view('ManageEmployee.ViewEmployee', [
            'employeeInfo' => $employeeInfo,
        ]); //returns the employee information
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
    public function editEmployee(string $id)
    {
        $employeeInfo = EmployeeRecord::find($id);

        return view('ManageEmployee.EditEmployee', [
            'employeeInfo' => $employeeInfo,
        ]); //returns the edit view with the employee information
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateEmployee(Request $request, $id)
    {
        //update employee info from database
        $updateInfo = EmployeeRecord::findOrFail($id);
        $validatedData = $request->validate([
            'name' => 'required',
            'username' => 'required',
            'phone_number' => 'required',
            'email' => 'required',
            'password' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'ic' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'position_id' => 'required',
            'user_type_id' => 'required',

        ]);

        $updateInfo->update($validatedData);
        return redirect()->route('ListEmployee')->with('success', 'Employee Info updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteEmployee($id)
    {
        $employeeRecord = EmployeeRecord::find($id);

        if (!$employeeRecord) {
            return redirect()->back()->with('error', 'Employee record not found.');
        }
    
        // delete record
        $employeeRecord->delete();
        session()->flash('success', 'Employee record deleted successfully.');
    
        // redirect to previous page
        return redirect()->back();
    }
}
