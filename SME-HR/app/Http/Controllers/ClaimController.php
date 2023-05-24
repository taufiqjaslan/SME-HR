<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ClaimRecord;
use App\Models\ClaimTypeRecord;
use App\Models\EmployeeRecord;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ClaimController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function ApplyClaim()
    {

        // Retrieve all usertype and position records and include the associated employee data
        $employee = EmployeeRecord::with('userType')->get();
        $claimType = ClaimTypeRecord::all();
        $lists = [
            'employee' => $employee,
            'claimType' => $claimType,
        ];
        return view('ManageClaim.AddClaim', ["listData" => $lists]); //link to go to addclaim page
    }

    public function StoreClaim(Request $request)
    {
        //store a new user (staff)
        $newUser = ClaimRecord::create([
            'name' => $request['name'],
            'username' => $request['username'],
            'phone_number' => $request['phone_number'],
            'email' => $request['email'],
            'address' => $request['address'],
            'gender' => $request['gender'],
            'start_date' => $request['start_date'],
            'end_date' => $request['end_date'],
            'position_id' => $request['position_id'],
            'user_type_id' => $request['user_type_id'],
            'status' => 1,
        ]);

        return redirect()->route('ListEmployee');
    }

    public function listClaim()
    {
        // Retrieve all payroll records and include the associated employee data and salary_type data
        $claimRecords = ClaimRecord::with('employee', 'claimType')->get();

        // Pass the data to the view
        return view('ManageClaim.ClaimList', ["claimRecords" => $claimRecords]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
