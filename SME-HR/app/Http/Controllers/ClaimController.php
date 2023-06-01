<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ClaimRecord;
use App\Models\ClaimTypeRecord;
use App\Models\EmployeeRecord;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;

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
        $filename = null; // Initialize with a default value of null

        // Check if file is uploaded
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/attachment/', $filename);
        }

        // Store a new claim record
        $newClaim = ClaimRecord::create([
            'user_id' => $request->user_id,
            'date' => $request->date,
            'claim_type_id' => $request->claim_type_id,
            'detail' => $request->detail,
            'amount' => $request->amount,
            'attachment' => $filename,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => 1,
        ]);

        return redirect()->route('ListClaim');
    }


    public function listClaim()
    {
        // Retrieve all payroll records and include the associated employee data and salary_type data
        $claimRecords = ClaimRecord::with('claimType')
            ->join('claim_types', 'claims.claim_type_id', '=', 'claim_types.id')
            ->select('claims.*', 'claim_types.name')
            ->get();


        // Pass the data to the view
        return view('ManageClaim.ClaimList', ["claimRecords" => $claimRecords]);
    }

    public function viewClaim(string $id)
    {
        $claimInfo = ClaimRecord::find($id);
        $employeeInfo = EmployeeRecord::all(); // Fetch employee from the database
        $claimTypeInfo = ClaimTypeRecord::all(); // Fetch claimtype from the database

        return view('ManageClaim.ViewClaim', compact('claimInfo', 'employeeInfo', 'claimTypeInfo'));
    }


    //go to edit claim page
    public function editClaim(string $id)
    {
        $claimInfo = ClaimRecord::find($id);
        $employeeInfo = EmployeeRecord::all(); // Fetch employee from the database
        $claimTypeInfo = ClaimTypeRecord::all(); // Fetch claimtype from the database

        return view('ManageClaim.EditClaim', compact('claimInfo', 'employeeInfo', 'claimTypeInfo'));
    }

    //update function
    public function updateClaim(Request $request, $id)
    {
        // Update employee info from the database
        $updateInfo = ClaimRecord::findOrFail($id);

        $validatedData = $request->validate([
            'user_id' => 'required',
            'date' => 'required',
            'claim_type_id' => 'required',
            'detail' => 'required',
            'amount' => 'nullable',
            'start_time' => 'nullable',
            'end_time' => 'nullable',
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
        return redirect()->route('ListClaim')->with('success', 'Claim Info updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteClaim($id)
    {
        $claimRecord = ClaimRecord::find($id);

        if (!$claimRecord) {
            return redirect()->back()->with('error', 'Claim record not found.');
        }

        // delete record
        $claimRecord->delete();
        session()->flash('success', 'Claim record deleted successfully.');

        // redirect to previous page
        return redirect()->back();
    }
}
