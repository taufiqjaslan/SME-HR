<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\EAFormRecord;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EAFormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function listEA()
    {
        // Retrieve all payroll records and include the associated employee data and salary_type data
        $EAFormRecords = EAFormRecord::with('employee')->get();

        // Pass the data to the view
        return view('ManagePayroll.PayrollList', ["EAFormRecords" => $EAFormRecords]);
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
