<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EntitlementRecord;
use App\Models\EmployeeRecord;
use App\Models\LeaveTypeRecord;

class EntitlementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listEntitlement()
    {
        $entitlementInfo = EntitlementRecord::all();
        $employeeInfo = EmployeeRecord::all(); // Fetch employee info from the database

        return view('ManageLeave.ListEntitlement', compact('entitlementInfo', 'employeeInfo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addEntitlement()
    {
        $leaveType = LeaveTypeRecord::all();
        $employeeInfo = EmployeeRecord::all(); // Fetch employee info from the database

        return view('ManageLeave.AddEntitlement', compact('leaveType', 'employeeInfo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeEntitlement(Request $request)
    {
        //store a new entitlement (staff)
        $newEntitlement = EntitlementRecord::create([
            'user_id' => $request['user_id'],
            'leave_type_id' => $request['leave_type_id'],
            'valid_from' => $request['valid_from'],
            'valid_to' => $request['valid_to'],
            'leave_assign' => $request['leave_assign'],
        ]);

        return redirect()->route('listEntitlement');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function viewEntitlement(Request $request)
    {
        // Retrieve the staff ID from the request
        $staffId = $request->input('user_id');
    
        // Fetch the leave data from the database based on the staff ID,
        // eager load the related leave type data
        $leaveData = EntitlementRecord::with('leaveType')->where('user_id', $staffId)->get();
    
        // Transform the leave data to include additional fields if needed
        $transformedLeaveData = $leaveData->map(function ($leave) {
            return [
                'leave_name' => $leave->leaveType->leave_name, // Access the leave type data using the relationship
                'leave_days' => $leave->leaveType->leave_days,
                'validFrom' => $leave->valid_from,
                'validTo' => $leave->valid_to,
                'id' => $leave->id,
            ];
        });
    
        // Return the transformed leave data as a JSON response
        return response()->json(['leaveData' => $transformedLeaveData]);
    }
    



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteEntitlement($id)
    {
        $EntitlementRecord = EntitlementRecord::find($id);

        if (!$EntitlementRecord) {
            return redirect()->back()->with('error', 'Entitlement record not found.');
        }

        // delete record
        $EntitlementRecord->delete();
        session()->flash('success', 'Entitlement record deleted successfully.');

        // redirect to previous page
        return redirect()->back();
    }
}
