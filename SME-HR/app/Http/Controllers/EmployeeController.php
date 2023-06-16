<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\EmployeeRecord;
use App\Models\PayrollRecord;
use App\Models\UserTypeRecord;
use App\Models\PositionRecord;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function ListEmployee()
    {
        if (auth()->user()->user_type_id == 1) {
            $lists = EmployeeRecord::with('position', 'userType')
                ->join('positions', 'users.position_id', '=', 'positions.id')
                ->join('user_types', 'users.user_type_id', '=', 'user_types.id')
                ->select('users.*', 'positions.position_name', 'user_types.user_type_name')
                ->get();
        } else {
            $lists = EmployeeRecord::with('position', 'userType')
                ->join('positions', 'users.position_id', '=', 'positions.id')
                ->join('user_types', 'users.user_type_id', '=', 'user_types.id')
                ->select('users.*', 'positions.position_name', 'user_types.user_type_name')
                ->where('users.id', auth()->user()->id)
                ->get();
        }

        return view('ManageEmployee.EmployeeList', ["listEmployee" => $lists]);
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
            'basic_salary' => $request['basic_salary'],
            'start_date' => $request['start_date'],
            'end_date' => $request['end_date'],
            'position_id' => $request['position_id'],
            'user_type_id' => $request['user_type_id'],
            'status' => 1,
        ]);

        // Insert basic salary into the "salaries" table
        $basicSalary = $request['basic_salary'];

        $kwspStaff = $basicSalary <= 5000 ? (11 / 100) * $basicSalary : (11 / 100) * $basicSalary;
        $kwspCompany = $basicSalary <= 5000 ? (13 / 100) * $basicSalary : (12 / 100) * $basicSalary;

        $socsoCompany = 0;
        $socsoStaff = 0;
        $eisCompany = 0;
        $eisStaff = 0;
        $netPay = 0;

        if ($basicSalary > 1200 && $basicSalary <= 1300) {
            $socsoCompany = 21.85;
            $socsoStaff = 6.25;
            $eisCompany = 2.50;
            $eisStaff = 2.50;
        } elseif ($basicSalary > 1300 && $basicSalary <= 1400) {
            $socsoCompany = 23.65;
            $socsoStaff = 6.75;
            $eisCompany = 2.70;
            $eisStaff = 2.70;
        } elseif ($basicSalary > 1400 && $basicSalary <= 1500) {
            $socsoCompany = 25.35;
            $socsoStaff = 7.25;
            $eisCompany = 2.90;
            $eisStaff = 2.90;
        } elseif ($basicSalary > 1500 && $basicSalary <= 1600) {
            $socsoCompany = 27.15;
            $socsoStaff = 7.75;
            $eisCompany = 3.10;
            $eisStaff = 3.10;
        } elseif ($basicSalary > 1600 && $basicSalary <= 1700) {
            $socsoCompany = 28.85;
            $socsoStaff = 8.25;
            $eisCompany = 3.30;
            $eisStaff = 3.30;
        } elseif ($basicSalary > 1700 && $basicSalary <= 1800) {
            $socsoCompany = 30.65;
            $socsoStaff = 8.75;
            $eisCompany = 3.50;
            $eisStaff = 3.50;
        } elseif ($basicSalary > 1800 && $basicSalary <= 1900) {
            $socsoCompany = 32.35;
            $socsoStaff = 9.25;
            $eisCompany = 3.70;
            $eisStaff = 3.70;
        } elseif ($basicSalary > 1900 && $basicSalary <= 2000) {
            $socsoCompany = 34.15;
            $socsoStaff = 9.75;
            $eisCompany = 3.90;
            $eisStaff = 3.90;
        } elseif ($basicSalary > 2000 && $basicSalary <= 2100) {
            $socsoCompany = 35.85;
            $socsoStaff = 10.25;
            $eisCompany = 4.10;
            $eisStaff = 4.10;
        } elseif ($basicSalary > 2100 && $basicSalary <= 2200) {
            $socsoCompany = 37.65;
            $socsoStaff = 10.75;
            $eisCompany = 4.30;
            $eisStaff = 4.30;
        } elseif ($basicSalary > 2200 && $basicSalary <= 2300) {
            $socsoCompany = 39.35;
            $socsoStaff = 11.25;
            $eisCompany = 4.50;
            $eisStaff = 4.50;
        }
        // Add more elseif conditions for the remaining salary ranges
        $netPay = $basicSalary - ($kwspStaff + $kwspCompany + $socsoCompany + $socsoStaff + $eisCompany + $eisStaff);

        PayrollRecord::create([
            'user_id' => $newUser->id,
            'basic_salary' => $basicSalary,
            'kwsp_staff' => $kwspStaff,
            'kwsp_company' => $kwspCompany,
            'socso_staff' => $socsoStaff,
            'socso_company' => $socsoCompany,
            'eis_staff' => $eisStaff,
            'eis_company' => $eisCompany,
            'netpay' => $netPay, // Set the initial value of netpay
        ]);
        


        return redirect()->route('ListEmployee');
    }

    public function viewEmployee(string $id)
    {
        $employeeInfo = EmployeeRecord::find($id);
        $positions = PositionRecord::all(); // Fetch positions from the database

        return view('ManageEmployee.ViewEmployee', compact('employeeInfo', 'positions'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function editEmployee(string $id)
    {
        $employeeInfo = EmployeeRecord::find($id);
        $positions = PositionRecord::all(); // Fetch positions from the database
        $userType = UserTypeRecord::all(); // Fetch positions from the database

        return view('ManageEmployee.EditEmployee', compact('employeeInfo', 'positions', 'userType')); //returns the edit view with the employee information
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

        $validatedData['password'] = Hash::make($request->password);
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

        // redirect to previous page
        return redirect()->back();
    }
}
