<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\EmployeeRecord;
use App\Models\LeaveTypeRecord;
use App\Models\LeaveRecord;
use App\Models\ReportRecord;
use Illuminate\Support\Facades\File;

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

        $user = auth()->user();

        // Store a new leave record
        $newLeave = LeaveRecord::create([
            'user_id' => ($user->user_type_id == 1) ? $request->user_id : $user->id,
            'leave_type_id' => $request->leave_type_id,
            'detail' => $request->detail,
            'total_day' => $request->total_day,
            'attachment' => $filename,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => 1,
        ]);

        if ($user->user_type_id != 1) {
            // Check if report record already exists for the logged-in user
            $reportRecord = ReportRecord::where('user_id', $user->id)
                ->where('leave_type_id', $request->leave_type_id)
                ->first();

            if ($reportRecord) {
                // Update existing report record
                $reportRecord->days_remaining = $reportRecord->days_remaining - $request->total_day;
                $reportRecord->leave_pending = $reportRecord->leave_pending + $request->total_day;
                $reportRecord->save();
            } else {
                // Retrieve total_day from leave_types table
                $leaveType = LeaveTypeRecord::find($request->leave_type_id);
                $totalDayFromLeaveType = $leaveType->leave_days;

                // Create a new report record
                $newReport = ReportRecord::create([
                    'user_id' => $user->id,
                    'leave_type_id' => $request->leave_type_id,
                    'days_remaining' => $totalDayFromLeaveType - $request->total_day,
                    'leave_pending' => $request->total_day,
                    'leave_taken' => 0,
                ]);
            }
        }

        return redirect()->route('ListLeave');
    }


    //List leave function
    public function listLeave()
    {
        $user = auth()->user();

        // Retrieve all leave records and include the associated employee data and leave type data
        $leaveRecords = LeaveRecord::with('employee', 'leaveType')
            ->join('users', 'leaves.user_id', '=', 'users.id')
            ->join('leave_types', 'leaves.leave_type_id', '=', 'leave_types.id')
            ->select('leaves.*', 'users.name', 'leave_types.leave_name');

        if ($user->user_type_id != 1) {
            // Filter leave records for the logged-in user
            $leaveRecords = $leaveRecords->where('leaves.user_id', $user->id);
        }

        $leaveRecords = $leaveRecords->get();

        return view('ManageLeave.LeaveList', ["leaveRecords" => $leaveRecords]);
    }


    /**
     * Display the specified resource.
     */
    public function viewLeave(string $id)
    {
        $leaveInfo = Leaverecord::find($id);
        $employeeInfo = EmployeeRecord::all(); // Fetch employee from the database
        $leaveTypeInfo = LeaveTypeRecord::all(); // Fetch leavetype from the database

        return view('ManageLeave.ViewLeave', compact('leaveInfo', 'employeeInfo', 'leaveTypeInfo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editLeave(string $id)
    {
        $leaveInfo = LeaveRecord::find($id);
        $employeeInfo = EmployeeRecord::all(); // Fetch employee from the database
        $leaveTypeInfo = LeaveTypeRecord::all(); // Fetch leavetype from the database

        return view('ManageLeave.EditLeave', compact('leaveInfo', 'employeeInfo', 'leaveTypeInfo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateLeave(Request $request, $id)
    {
        // Update employee info from the database
        $updateInfo = LeaveRecord::findOrFail($id);

        $validatedData = $request->validate([
            'user_id' => 'required',
            'leave_type_id' => 'required',
            'detail' => 'required',
            'total_day' => 'required',
            'start_date' => 'nullable',
            'end_date' => 'nullable',
        ]);

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/attachment/', $filename);

            // Update the attachment field in the database
            $validatedData['attachment'] = $filename;

            // Delete the previous attachment file if it exists
            if (!empty($updateInfo->attachment)) {
                $previousFile = 'uploads/attachment/' . $updateInfo->attachment;
                if (File::exists($previousFile)) {
                    File::delete($previousFile);
                }
            }
        }

        $updateInfo->update($validatedData);
        return redirect()->route('ListLeave')->with('success', 'Leave Info updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteLeave($id)
    {
        $leaveRecord = LeaveRecord::find($id);

        if (!$leaveRecord) {
            return redirect()->back()->with('error', 'Leave record not found.');
        }

        // delete record
        $leaveRecord->delete();
        session()->flash('success', 'Leave record deleted successfully.');

        // redirect to previous page
        return redirect()->back();
    }
}
