<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\GeneratePayslipRecord;
use App\Models\PayrollRecord;
use App\Models\EmployeeRecord;
use Illuminate\Http\Request;

class GeneratePayslipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function payslipReceipt(string $id)
    {
        $payslipInfo = GeneratePayslipRecord::find($id);
        $employeeInfo = EmployeeRecord::with('position')->find($payslipInfo->user_id); // Retrieve the specific employee record // Fetch employee from the database

        return view('ManagePayroll.PayslipReceipt', compact('payslipInfo', 'employeeInfo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function savePayslip(Request $request)
    {
        // Retrieve the selected salaries, year, and month from the request
        $selectedSalaries = $request->input('check');
        $year = $request->input('year');
        $month = $request->input('month');

        // Perform any validation or additional processing if needed
        if (!empty($selectedSalaries)) {
            // Save the selected payslips to the generate_payslip table
            foreach ($selectedSalaries as $id) {
                // Retrieve the salary information from the payslip_info table
                $payslipInfo = PayrollRecord::find($id);

                if ($payslipInfo) {
                    // Create a new instance of the GeneratePayslip model
                    $generatePayslip = new GeneratePayslipRecord();

                    // Retrieve the necessary data from the payslipInfo object
                    $generatePayslip->user_id = $payslipInfo->user_id;
                    $generatePayslip->basic_salary = $payslipInfo->basic_salary;
                    $generatePayslip->kwsp_staff = $payslipInfo->kwsp_staff;
                    $generatePayslip->kwsp_company = $payslipInfo->kwsp_company;
                    $generatePayslip->socso_staff = $payslipInfo->socso_staff;
                    $generatePayslip->socso_company = $payslipInfo->socso_company;
                    $generatePayslip->eis_staff = $payslipInfo->eis_staff;
                    $generatePayslip->eis_company = $payslipInfo->eis_company;
                    $generatePayslip->zakat = $payslipInfo->zakat;
                    $generatePayslip->deduction = $payslipInfo->deduction;
                    $generatePayslip->allowance = $payslipInfo->allowance;
                    $generatePayslip->bonus = $payslipInfo->bonus;
                    $generatePayslip->netpay = $payslipInfo->netpay;
                    $generatePayslip->year = $year;
                    $generatePayslip->month = $month;

                    // Save the generated payslip
                    $generatePayslip->save();
                }
            }
        }

        // Perform any additional actions or redirect the user as needed

        // Return a response indicating the success of the operation
        return back()->with('success', 'Payslips generated and saved successfully');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function listGenerated()
    {
        if (auth()->user()->user_type_id == 1) {
            $payslipInfo = GeneratePayslipRecord::with('employee')->get();
            $employeeInfo = EmployeeRecord::all();
        } else {
            $payslipInfo = GeneratePayslipRecord::with('employee')
                ->where('user_id', auth()->user()->id)
                ->get();
            $employeeInfo = EmployeeRecord::where('id', auth()->user()->id)->get();
        }

        return view('ManagePayroll.ViewPayslip', compact('payslipInfo', 'employeeInfo'));
    }

    // Filter function
    public function filterData(Request $request)
    {
        // Retrieve the filter values from the request payload
        $year = $request->input('year');
        $month = $request->input('month');
        $name = $request->input('user_id');

        // Query the database to fetch the filtered data
        $query = GeneratePayslipRecord::with('employee');

        // Apply filters if provided
        if ($year) {
            $query->where('year', $year);
        }
        if ($month) {
            $query->where('month', $month);
        }
        if ($name) {
            $query->where('user_id', $name);
        }

        // Get the filtered data
        $filteredData = $query->get();

        // Return the filtered data as JSON response
        return response()->json($filteredData);
    }

    //check payroll (already generated or not)
    public function checkPayroll(Request $request)
    {
        // Retrieve the selected year, month, and user_id from the request
        $year = $request->input('year');
        $month = $request->input('month');
        $user_id = auth()->user()->id; // Assuming you are using Laravel's authentication and getting the user ID from the authenticated user

        // Query your data source to check if the payroll entry exists
        $existingPayroll = GeneratePayslipRecord::where('user_id', $user_id)
            ->where('year', $year)
            ->where('month', $month)
            ->first();

        // Check if the existing payroll entry was found
        $payrollExists = !is_null($existingPayroll);

        // Prepare the response
        $response = [
            'generated' => $payrollExists,
        ];

        // Return the response as JSON
        return response()->json($response);
    }
}
