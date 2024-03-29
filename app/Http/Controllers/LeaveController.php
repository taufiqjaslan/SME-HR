<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\EmployeeRecord;
use App\Models\EntitlementRecord;
use App\Models\LeaveTypeRecord;
use App\Models\LeaveRecord;
use App\Models\NotificationRecord;
use App\Models\ReportRecord;
use Dotenv\Exception\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function applyLeave()
    {
        $user = Auth::user(); // Assuming you are using Laravel's authentication
    
        if ($user->user_type_id == 1) {
            $employee = EmployeeRecord::with('userType')->get();
            $leaveType = LeaveTypeRecord::all();
        } else {
            $userId = $user->id;
    
            $employee = EmployeeRecord::with('userType')->where('id', $userId)->get();
            $leaveType = EntitlementRecord::where('user_id', $userId)->with('leaveType')->get();
        }
    
        $lists = [
            'employee' => $employee,
            'leaveType' => $leaveType,
        ];
    
        return view('ManageLeave.AddLeave', ["listData" => $lists]);
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

        NotificationRecord::create([
            'user_id' => ($user->user_type_id == 1) ? $request->user_id : $user->id,
            'noti_type' => 2,
            'noti_text' => "has apply a new leave",
        ]);

        if ($user->user_type_id == 1) {
            // Check if report record already exists for the logged-in user
            $reportRecord = ReportRecord::where('user_id', $request->user_id)
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
                    'user_id' => $request->user_id,
                    'leave_type_id' => $request->leave_type_id,
                    'days_remaining' => $totalDayFromLeaveType - $request->total_day,
                    'leave_pending' => $request->total_day,
                    'leave_taken' => 0,
                ]);
            }
        }

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
        // Update leave record from the database
        $leaveRecord = LeaveRecord::findOrFail($id);

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
            if (!empty($leaveRecord->attachment)) {
                $previousFile = 'uploads/attachment/' . $leaveRecord->attachment;
                if (File::exists($previousFile)) {
                    File::delete($previousFile);
                }
            }
        }

        // Retrieve the user's leave report
        $leaveReport = ReportRecord::where('user_id', $leaveRecord->user_id)
            ->where('leave_type_id', $leaveRecord->leave_type_id)
            ->first();

        if ($leaveReport) {
            // Retrieve the total total_day for the same leave_type_id and user_id
            $totalDays = LeaveRecord::where('leave_type_id', $leaveRecord->leave_type_id)
                ->where('user_id', $leaveRecord->user_id)
                ->where('id', '!=', $leaveRecord->id) // Exclude the current leave record being updated
                ->sum('total_day');

            // Add the total_day of the current leave record being updated
            $totalDays += intval($validatedData['total_day']);

            // Update the days_remaining and leave_pending values
            $leaveReport->days_remaining = $totalDays;
            $leaveReport->leave_pending = $totalDays;

            // Save the updated leave report
            $leaveReport->save();
        }

        $leaveRecord->update($validatedData);
        return redirect()->route('ListLeave')->with('success', 'Leave Info updated successfully!');
    }



    //check total leave
    public function checkLeave(Request $request)
    {
        $leaveTypeId = $request->input('leave_type_id');
        $totalDays = intval($request->input('total_day'));
        $userId = Auth::id();

        $existingLeave = LeaveRecord::where('leave_type_id', $leaveTypeId)
            ->where('user_id', $userId)
            ->first();

        if ($existingLeave) {
            $daysRemaining = ReportRecord::where('leave_type_id', $leaveTypeId)
                ->where('user_id', $userId)
                ->value('days_remaining');
        } else {
            $daysRemaining = LeaveTypeRecord::where('id', $leaveTypeId)
                ->value('leave_days');
        }

        if ($totalDays > $daysRemaining) {
            return response()->json(['sufficient' => false]);
        }

        return response()->json(['sufficient' => true]);
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

        // Retrieve the total_day value
        $totalDay = $leaveRecord->total_day;

        // Retrieve the user's leave report
        $leaveReport = ReportRecord::where('user_id', $leaveRecord->user_id)->first();

        if ($leaveReport) {
            // Update the days_remaining and leave_pending values
            $leaveReport->days_remaining -= $totalDay;
            $leaveReport->leave_pending -= $totalDay;

            // Save the updated leave report
            $leaveReport->save();
        }

        // Delete the leave record
        $leaveRecord->delete();

        session()->flash('success', 'Leave record deleted successfully.');

        // Redirect to the previous page
        return redirect()->back();
    }

    // Update status to approve
    public function updateStatus(Request $request, $id)
    {
        // Find the leave record by ID
        $leave = LeaveRecord::find($id);

        if (!$leave) {
            // Leave not found
            return response()->json(['message' => 'Leave not found'], 404);
        }

        // Retrieve the total_day from the leave record
        $totalDay = $leave->total_day;

        // Update the leave_pending and leave_taken values
        $leaveReport = ReportRecord::where('user_id', $leave->user_id)->first();

        if ($leaveReport) {
            $leaveReport->leave_pending -= $totalDay;
            $leaveReport->leave_taken += $totalDay;
            $leaveReport->save();
        }

        // Update the status
        $leave->status = 2;
        $leave->save();

        // Return a response indicating the successful update
        return response()->json(['message' => 'Status updated successfully']);
    }

    // Update status to reject
    public function updateStatusReject(Request $request, $id)
    {
        // Find the claim by ID
        $leave = LeaveRecord::find($id);

        if (!$leave) {
            // Claim not found
            return response()->json(['message' => 'Leave not found'], 404);
        }

        // Retrieve the total_day from the leave record
        $totalDay = $leave->total_day;

        // Update the leave_pending and leave_taken values
        $leaveReport = ReportRecord::where('user_id', $leave->user_id)->first();

        if ($leaveReport) {
            $leaveReport->leave_pending -= $totalDay;
            $leaveReport->days_remaining -= $totalDay;
            $leaveReport->save();
        }

        // Update the status
        $leave->status = 0; // 
        $leave->save();

        // Return a response indicating the successful update
        return response()->json(['message' => 'Status updated successfully']);
    }

    public function getEvents(Request $request)
    {
        $leaves = LeaveRecord::with('employee')
            ->join('users', 'leaves.user_id', '=', 'users.id')
            ->select('leaves.*', 'users.*')->where('status', 1)->get();
        $events = [];

        foreach ($leaves as $leave) {
            $name = $leave->employee->name;
            $leaveType = $leave->leave_type_id;
            $startDate = $leave->start_date;
            $endDate = $leave->end_date;

            $event = [
                'title' => $name,
                'start' => $startDate,
                'end' => $endDate,
                'backgroundColor' => "#2596be",
                'borderColor' => "#2596be",
                'textColor' => '#000'
            ];

            $events[] = $event;
        }
        dd($events); // Add this line

        return response()->json($events);
    }

    public function showChart()
    {
        $leaveTypes = LeaveTypeRecord::pluck('leave_name', 'leave_days')->toArray();
        $chartData = [
            'Leave Types' => array_keys($leaveTypes),
            'Leave Days' => array_values($leaveTypes),
        ];
    
        return response()->json($chartData);
    }
}
