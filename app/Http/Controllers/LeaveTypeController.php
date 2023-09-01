<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LeaveTypeRecord;


class LeaveTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addLeaveType()
    {
        return view('ManageLeave.AddLeaveType');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeLeaveType(Request $request)
    {
        $newLeaveType = LeaveTypeRecord::create([
            'leave_name' => $request['leave_name'],
            'leave_days' => $request['leave_days'],
        ]);

        return redirect()->route('listLeaveType');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function listLeaveType()
    {
        $listLeaveType = LeaveTypeRecord::all();
        return view('ManageLeave.LeaveTypeList', ["listLeaveType" => $listLeaveType]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editLeaveType(string $id)
    {
        $leaveTypeInfo = LeaveTypeRecord::find($id);

        return view('ManageLeave.EditLeaveType', compact('leaveTypeInfo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateLeaveType(Request $request, $id)
    {
        // Update employee info from the database
        $updateInfo = LeaveTypeRecord::findOrFail($id);

        $validatedData = $request->validate([
            'leave_name' => 'required',
            'leave_days' => 'required',
        ]);


        $updateInfo->update($validatedData);
        return redirect()->route('listLeaveType')->with('success', 'Leave Type Info updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteLeaveType($id)
    {
        $leaveTypeRecord = LeaveTypeRecord::find($id);

        if (!$leaveTypeRecord) {
            return redirect()->back()->with('error', 'Leave type record not found.');
        }

        // delete record
        $leaveTypeRecord->delete();
        session()->flash('success', 'Leave type record deleted successfully.');

        // redirect to previous page
        return redirect()->back();
    }
}
