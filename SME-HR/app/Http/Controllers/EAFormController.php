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
    public function EAFormHome()
    {
        // Retrieve all eaform records and include the associated employee and position data
        $EAFormRecords = EmployeeRecord::with('position')
            ->join('positions', 'users.position_id', '=', 'positions.id')
            ->select('users.*', 'positions.position_name')
            ->get();
        // Pass the data to the view
        return view('ManageEAForm.EAFormHome', ["EAFormRecords" => $EAFormRecords]);
    }

    public function ListEAForm($id)
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
        // Retrieve the EAFormRecord with the associated employee and position
        $eaFormData = EmployeeRecord::with('position')->where('id', $id)->first();
    
        return view('ManageEAForm.AddEAForm', [
            'eaFormData' => $eaFormData,
            'id' => $id,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeEAForm(Request $request, $id)
    {
        // Create a new EAFormRecord instance
        $eaFormData = new EAFormRecord();

        // Set the values for the new EAFormRecord instance
        $eaFormData->user_id = $id;
        $eaFormData->date = $request->input('date');
        $eaFormData->year = $request->input('year');
        $eaFormData->tax_num = $request->input('tax_num');
        $eaFormData->payroll_num = $request->input('payroll_num');
        $eaFormData->epf_num = $request->input('epf_num');
        $eaFormData->kwsp_num = $request->input('kwsp_num');
        $eaFormData->start_date = $request->input('start_date');
        $eaFormData->end_date = $request->input('end_date');
        $eaFormData->children_num = $request->input('children_num');
        $eaFormData->gross_salary = $request->input('gross_salary');
        $eaFormData->fees = $request->input('fees');
        $eaFormData->gross_tip = $request->input('gross_tip');
        $eaFormData->income_tax = $request->input('income_tax');
        $eaFormData->refund = $request->input('refund');
        $eaFormData->compensation = $request->input('compensation');
        $eaFormData->pension = $request->input('pension');
        $eaFormData->annuities = $request->input('annuities');
        $eaFormData->tax_deduction = $request->input('tax_deduction');
        $eaFormData->cp38_deduction = $request->input('cp38_deduction');
        $eaFormData->zakat_deduction = $request->input('zakat_deduction');
        $eaFormData->zakat = $request->input('zakat');
        $eaFormData->child_relief = $request->input('child_relief');
        $eaFormData->amount = $request->input('amount');
        $eaFormData->socso = $request->input('socso');

        // Save the new EAFormRecord instance
        $eaFormData->save();

        return redirect()->route('ListEAForm', ['id' => $id]);
    }

    /**
     * Display the specified resource.
     */
    public function viewEAForm($id)
    {
        $EAFormData = EAFormRecord::find($id);
        $employee = EmployeeRecord::all(); // Fetch employee from the database

        return view('ManageEAForm.ViewEAForm', compact('EAFormData', 'employee'));

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
