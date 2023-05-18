<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\EAFormRecord;
use App\Models\EmployeeRecord;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EAFormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function EAForm()
    {
        // Retrieve all eaform records and include the associated employee and position data
        $EAFormRecords = EAFormRecord::with('employee.position')->get();

        $EAFormRecords = EmployeeRecord::with('position')
            ->join('positions', 'users.position_id', '=', 'positions.id')
            ->select('users.*', 'positions.position_name')
            ->get();
        // Pass the data to the view
        return view('ManageEAForm.EAFormHome', ["EAFormRecords" => $EAFormRecords]);
    }

    public function listEAForm($id)
    {
        $eaFormInfo = EAFormRecord::with('employee.position')->where('user_id', $id)->get();

        return view('ManageEAForm.EAFormList', [
            'eaFormInfo' => $eaFormInfo,
            'id' => $id,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function addEAForm(Request $request, $id)
    {
        // Your code to handle the add EA form functionality
        $eaFormData = EAFormRecord::with('employee.position')->where('user_id', $id)->get();
        
        return view('ManageEAForm.AddEAForm', [
            'eaFormData' => $eaFormData,
            'id' => $id,
        ]);
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
