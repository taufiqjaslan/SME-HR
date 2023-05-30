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

        return view('ManageClaim.ViewClaim', [
            'claimInfo' => $claimInfo,
        ]); //returns the employee information
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
