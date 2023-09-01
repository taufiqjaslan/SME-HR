<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ClaimRecord;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\EmployeeRecord;
use App\Models\LeaveRecord;
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
            'bank_name' => $request['bank_name'],
            'account_number' => $request['account_number'],
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

        if ($basicSalary <= 30) {
            $socsoCompany = 0.40;
            $socsoStaff = 0.10;
            $eisCompany = 0.05;
            $eisStaff = 0.05;
        } elseif ($basicSalary > 30 && $basicSalary <= 50) {
            $socsoCompany = 0.70;
            $socsoStaff = 0.20;
            $eisCompany = 0.10;
            $eisStaff = 0.10;
        } elseif ($basicSalary > 50 && $basicSalary <= 70) {
            $socsoCompany = 1.10;
            $socsoStaff = 0.30;
            $eisCompany = 0.15;
            $eisStaff = 0.15;
        } elseif ($basicSalary > 70 && $basicSalary <= 100) {
            $socsoCompany = 1.50;
            $socsoStaff = 0.40;
            $eisCompany = 0.20;
            $eisStaff = 0.20;
        } elseif ($basicSalary > 100 && $basicSalary <= 140) {
            $socsoCompany = 2.10;
            $socsoStaff = 0.60;
            $eisCompany = 0.25;
            $eisStaff = 0.25;
        } elseif ($basicSalary > 140 && $basicSalary <= 200) {
            $socsoCompany = 2.95;
            $socsoStaff = 0.85;
            $eisCompany = 0.35;
            $eisStaff = 0.35;
        } elseif ($basicSalary > 200 && $basicSalary <= 300) {
            $socsoCompany = 4.35;
            $socsoStaff = 1.25;
            $eisCompany = 0.50;
            $eisStaff = 0.50;
        } elseif ($basicSalary > 300 && $basicSalary <= 400) {
            $socsoCompany = 6.15;
            $socsoStaff = 1.75;
            $eisCompany = 0.70;
            $eisStaff = 0.70;
        } elseif ($basicSalary > 400 && $basicSalary <= 500) {
            $socsoCompany = 7.85;
            $socsoStaff = 2.25;
            $eisCompany = 0.90;
            $eisStaff = 0.90;
        } elseif ($basicSalary > 500 && $basicSalary <= 600) {
            $socsoCompany = 9.65;
            $socsoStaff = 2.75;
            $eisCompany = 1.10;
            $eisStaff = 1.10;
        } elseif ($basicSalary > 600 && $basicSalary <= 700) {
            $socsoCompany = 11.35;
            $socsoStaff = 3.25;
            $eisCompany = 1.30;
            $eisStaff = 1.30;
        } elseif ($basicSalary > 700 && $basicSalary <= 800) {
            $socsoCompany = 13.15;
            $socsoStaff = 3.75;
            $eisCompany = 1.50;
            $eisStaff = 1.50;
        } elseif ($basicSalary > 800 && $basicSalary <= 900) {
            $socsoCompany = 14.85;
            $socsoStaff = 4.25;
            $eisCompany = 1.70;
            $eisStaff = 1.70;
        } elseif ($basicSalary > 900 && $basicSalary <= 1000) {
            $socsoCompany = 16.65;
            $socsoStaff = 4.75;
            $eisCompany = 1.90;
            $eisStaff = 1.90;
        } elseif ($basicSalary > 1000 && $basicSalary <= 1100) {
            $socsoCompany = 18.35;
            $socsoStaff = 5.25;
            $eisCompany = 2.10;
            $eisStaff = 2.10;
        } elseif ($basicSalary > 1100 && $basicSalary <= 1200) {
            $socsoCompany = 20.15;
            $socsoStaff = 5.75;
            $eisCompany = 2.30;
            $eisStaff = 2.30;
        } elseif ($basicSalary > 1200 && $basicSalary <= 1300) {
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
        } elseif ($basicSalary > 2300 && $basicSalary <= 2400) {
            $socsoCompany = 41.15;
            $socsoStaff = 11.75;
            $eisCompany = 4.70;
            $eisStaff = 4.70;
        } elseif ($basicSalary > 2400 && $basicSalary <= 2500) {
            $socsoCompany = 42.85;
            $socsoStaff = 12.25;
            $eisCompany = 4.90;
            $eisStaff = 4.90;
        } elseif ($basicSalary > 2500 && $basicSalary <= 2600) {
            $socsoCompany = 44.65;
            $socsoStaff = 12.75;
            $eisCompany = 5.10;
            $eisStaff = 5.10;
        } elseif ($basicSalary > 2600 && $basicSalary <= 2700) {
            $socsoCompany = 46.35;
            $socsoStaff = 13.25;
            $eisCompany = 5.30;
            $eisStaff = 5.30;
        } elseif ($basicSalary > 2700 && $basicSalary <= 2800) {
            $socsoCompany = 48.15;
            $socsoStaff = 13.75;
            $eisCompany = 5.50;
            $eisStaff = 5.50;
        } elseif ($basicSalary > 2800 && $basicSalary <= 2900) {
            $socsoCompany = 49.85;
            $socsoStaff = 14.25;
            $eisCompany = 5.70;
            $eisStaff = 5.70;
        } elseif ($basicSalary > 2900 && $basicSalary <= 3000) {
            $socsoCompany = 51.65;
            $socsoStaff = 14.75;
            $eisCompany = 5.90;
            $eisStaff = 5.90;
        } elseif ($basicSalary > 3000 && $basicSalary <= 3100) {
            $socsoCompany = 53.35;
            $socsoStaff = 15.25;
            $eisCompany = 6.10;
            $eisStaff = 6.10;
        } elseif ($basicSalary > 3100 && $basicSalary <= 3200) {
            $socsoCompany = 55.15;
            $socsoStaff = 15.75;
            $eisCompany = 6.30;
            $eisStaff = 6.30;
        } elseif ($basicSalary > 3200 && $basicSalary <= 3300) {
            $socsoCompany = 56.85;
            $socsoStaff = 16.25;
            $eisCompany = 6.50;
            $eisStaff = 6.50;
        } elseif ($basicSalary > 3300 && $basicSalary <= 3400) {
            $socsoCompany = 58.65;
            $socsoStaff = 16.75;
            $eisCompany = 6.70;
            $eisStaff = 6.70;
        } elseif ($basicSalary > 3400 && $basicSalary <= 3500) {
            $socsoCompany = 60.35;
            $socsoStaff = 17.25;
            $eisCompany = 6.90;
            $eisStaff = 6.90;
        } elseif ($basicSalary > 3500 && $basicSalary <= 3600) {
            $socsoCompany = 62.15;
            $socsoStaff = 17.75;
            $eisCompany = 7.10;
            $eisStaff = 7.10;
        } elseif ($basicSalary > 3600 && $basicSalary <= 3700) {
            $socsoCompany = 63.85;
            $socsoStaff = 18.25;
            $eisCompany = 7.30;
            $eisStaff = 7.30;
        } elseif ($basicSalary > 3700 && $basicSalary <= 3800) {
            $socsoCompany = 65.65;
            $socsoStaff = 18.75;
            $eisCompany = 7.50;
            $eisStaff = 7.50;
        } elseif ($basicSalary > 3800 && $basicSalary <= 3900) {
            $socsoCompany = 67.35;
            $socsoStaff = 19.25;
            $eisCompany = 7.70;
            $eisStaff = 7.70;
        } elseif ($basicSalary > 3900 && $basicSalary <= 4000) {
            $socsoCompany = 69.15;
            $socsoStaff = 19.75;
            $eisCompany = 7.90;
            $eisStaff = 7.90;
        } elseif ($basicSalary > 4000 && $basicSalary <= 4100) {
            $socsoCompany = 70.85;
            $socsoStaff = 20.25;
            $eisCompany = 8.10;
            $eisStaff = 8.10;
        } elseif ($basicSalary > 4100 && $basicSalary <= 4200) {
            $socsoCompany = 72.65;
            $socsoStaff = 20.75;
            $eisCompany = 8.30;
            $eisStaff = 8.30;
        } elseif ($basicSalary > 4200 && $basicSalary <= 4300) {
            $socsoCompany = 74.35;
            $socsoStaff = 21.25;
            $eisCompany = 8.50;
            $eisStaff = 8.50;
        } elseif ($basicSalary > 4300 && $basicSalary <= 4400) {
            $socsoCompany = 76.15;
            $socsoStaff = 21.75;
            $eisCompany = 8.70;
            $eisStaff = 8.70;
        } elseif ($basicSalary > 4400 && $basicSalary <= 4500) {
            $socsoCompany = 77.85;
            $socsoStaff = 22.25;
            $eisCompany = 8.90;
            $eisStaff = 8.90;
        } elseif ($basicSalary > 4500 && $basicSalary <= 4600) {
            $socsoCompany = 79.65;
            $socsoStaff = 22.75;
            $eisCompany = 9.10;
            $eisStaff = 9.10;
        } elseif ($basicSalary > 4600 && $basicSalary <= 4700) {
            $socsoCompany = 81.35;
            $socsoStaff = 23.25;
            $eisCompany = 9.30;
            $eisStaff = 9.30;
        } elseif ($basicSalary > 4700 && $basicSalary <= 4800) {
            $socsoCompany = 83.15;
            $socsoStaff = 23.75;
            $eisCompany = 9.50;
            $eisStaff = 9.50;
        } elseif ($basicSalary > 4800 && $basicSalary <= 4900) {
            $socsoCompany = 84.85;
            $socsoStaff = 24.25;
            $eisCompany = 9.70;
            $eisStaff = 9.70;
        } elseif ($basicSalary > 4900 && $basicSalary <= 5000) {
            $socsoCompany = 86.65;
            $socsoStaff = 24.75;
            $eisCompany = 9.90;
            $eisStaff = 9.90;
        } elseif ($basicSalary > 5000) {
            $socsoCompany = 88.35;
            $socsoStaff = 25.25;
            $eisCompany = 9.90;
            $eisStaff = 9.90;
        }
        $netPay = $basicSalary - ($kwspStaff + $socsoStaff + $eisStaff);

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
            'bank_name' => 'required',
            'account_number' => 'required',
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

    // Execute the query to count the total number of users
    public function count()
    {
        // Check if the user is an admin (user_type_id == 1)
        if (auth()->user()->user_type_id == 1) {
            // Retrieve the total number of employees from the database
            $totalEmployees = EmployeeRecord::count();

            // Retrieve the total number of claims with status 0
            $totalClaim = ClaimRecord::where('status', 0)->count();

            // Retrieve the total number of leaves with status 1
            $totalLeave = LeaveRecord::where('status', 1)->count();
        } else {

            $totalEmployees = EmployeeRecord::count();
            // Retrieve the total number of claims with status 0 for the current user
            $totalClaim = ClaimRecord::where('status', 0)
                ->where('user_id', auth()->user()->id)
                ->count();

            // Retrieve the total number of leaves with status 1 for the current user
            $totalLeave = LeaveRecord::where('status', 1)
                ->where('user_id', auth()->user()->id)
                ->count();
        }

        // Return the counts as JSON response
        return response()->json([
            'totalEmployees' => $totalEmployees ?? null,
            'totalClaim' => $totalClaim,
            'totalLeave' => $totalLeave
        ]);
    }
}
