<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\EmployeeRecord;
use App\Models\LeaveTypeRecord;
use App\Models\LeaveRecord;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function applyLeave()
    {

        // Retrieve all usertype and position records and include the associated employee data
        $employee = EmployeeRecord::with('userType')->get();
        $leaveType = LeaveTypeRecord::all();
        $lists = [
            'employee' => $employee,
            'leaveType' => $leaveType,
        ];
        return view('ManageLeave.AddLeave', ["listData" => $lists]); //link to go to addleave page
    }

    /**
     * Show the form for creating a new resource.
     */
    public function StoreLeave(Request $request)
    {
        $filename = null; // Initialize with a default value of null

        // Check if file is uploaded
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/attachment/', $filename);
        }

        // Store a new claim record
        $newleave = LeaveRecord::create([
            'user_id' => $request->user_id,
            'leave_type_id' => $request->leave_type_id,
            'detail' => $request->detail,
            'attachment' => $filename,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => 1,
        ]);

        return redirect()->route('ApplyLeave');
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
