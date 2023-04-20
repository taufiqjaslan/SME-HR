<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\PayrollRecord;

class PayrollController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function listPayroll()
    {
        // Retrieve all payroll records and include the associated employee data and salary_type data
        $payrollRecords = PayrollRecord::with('employee', 'salaryType')->get();

        // Pass the data to the view
        return view('ManagePayroll.PayrollList', ["payrollRecords" => $payrollRecords]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function generatePayslip()
    {
        // Retrieve all payroll records and include the associated employee data and salary_type data
        $generatePayslip = PayrollRecord::with('employee', 'salaryType')->get();

        // Pass the data to the view
        return view('ManagePayroll.GeneratePayroll', ["generatePayslip" => $generatePayslip]);
    }

    public function viewPayslip()
    {
        // Retrieve all payroll records and include the associated employee data and salary_type data
        $viewPayslip = PayrollRecord::with('employee', 'salaryType')->get();

        // Pass the data to the view
        return view('ManagePayroll.ViewPayroll', ["viewPayslip" => $viewPayslip]);
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
