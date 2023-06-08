<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\PayrollRecord;
use App\Models\EmployeeRecord;

class PayrollController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function listPayroll()
    {
        // Retrieve all payroll records and include the associated employee data
        $payrollInfo = PayrollRecord::all();
        $employeeInfo = EmployeeRecord::all();

        return view('ManagePayroll.PayrollList', compact('payrollInfo', 'employeeInfo'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function generatePayslip()
    {
        // Retrieve all payroll records and include the associated employee data and salary_type data
        $generatePayslip = PayrollRecord::with('employee')->get();

        // Pass the data to the view
        return view('ManagePayroll.GeneratePayroll', ["generatePayslip" => $generatePayslip]);
    }

    public function viewPayslip()
    {
        // Retrieve all payroll records and include the associated employee data and salary_type data
        $viewPayslip = PayrollRecord::with('employee')->get();

        // Pass the data to the view
        return view('ManagePayroll.ViewPayslip', ["viewPayslip" => $viewPayslip]);
    }

    /**
     * Display the specified resource.
     */
    public function viewPayroll(string $id)
    {
        $payrollInfo = PayrollRecord::find($id);
        $employeeInfo = EmployeeRecord::find($payrollInfo->user_id); // Fetch the associated employee from the database

        return view('ManagePayroll.ViewPayroll', compact('payrollInfo', 'employeeInfo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editPayroll(string $id)
    {
        $payrollInfo = PayrollRecord::find($id);
        $employeeInfo = EmployeeRecord::find($payrollInfo->user_id); // Fetch the associated employee from the database

        return view('ManagePayroll.EditPayroll', compact('payrollInfo', 'employeeInfo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updatePayroll(Request $request, $id)
    {
        // Retrieve the values from the request
        $bonus = $request->input('bonus');
        $allowance = $request->input('allowance');
        $basic_salary = $request->input('basic_salary');
        $basicSalary = $request->input('basic_salary') + $bonus + $allowance;

        $kwspStaff = $basicSalary <= 5000 ? (11 / 100) * $basicSalary : (11 / 100) * $basicSalary;
        $kwspCompany = $basicSalary <= 5000 ? (13 / 100) * $basicSalary : (12 / 100) * $basicSalary;

        // Calculate socsoCompany, socsoStaff, eisCompany, eisStaff based on the given conditions
        $socsoCompany = 0;
        $socsoStaff = 0;
        $eisCompany = 0;
        $eisStaff = 0;

        if ($basicSalary > 1200 && $basicSalary <= 1300) {
            $socsoCompany = 21.85;
            $socsoStaff = 6.25;
            $eisCompany = 2.50;
            $eisStaff = 2.50;
        } elseif ($basicSalary > 1300 && $basicSalary <= 1400) {
            $socsoCompany = 23.65;
            $socsoStaff = 6.75;
            $eisCompany = 2.70;
            $eisStaff = 2.70;
        } elseif ($basicSalary > 1400 && $basicSalary <= 1500) {
            $socsoCompany = 25.35;
            $socsoStaff = 7.25;
            $eisCompany = 2.90;
            $eisStaff = 2.90;
        } elseif ($basicSalary > 1500 && $basicSalary <= 1600) {
            $socsoCompany = 27.15;
            $socsoStaff = 7.75;
            $eisCompany = 3.10;
            $eisStaff = 3.10;
        } elseif ($basicSalary > 1600 && $basicSalary <= 1700) {
            $socsoCompany = 28.85;
            $socsoStaff = 8.25;
            $eisCompany = 3.30;
            $eisStaff = 3.30;
        } elseif ($basicSalary > 1700 && $basicSalary <= 1800) {
            $socsoCompany = 30.65;
            $socsoStaff = 8.75;
            $eisCompany = 3.50;
            $eisStaff = 3.50;
        } elseif ($basicSalary > 1800 && $basicSalary <= 1900) {
            $socsoCompany = 32.35;
            $socsoStaff = 9.25;
            $eisCompany = 3.70;
            $eisStaff = 3.70;
        } elseif ($basicSalary > 1900 && $basicSalary <= 2000) {
            $socsoCompany = 34.15;
            $socsoStaff = 9.75;
            $eisCompany = 3.90;
            $eisStaff = 3.90;
        } elseif ($basicSalary > 2000 && $basicSalary <= 2100) {
            $socsoCompany = 35.85;
            $socsoStaff = 10.25;
            $eisCompany = 4.10;
            $eisStaff = 4.10;
        } elseif ($basicSalary > 2100 && $basicSalary <= 2200) {
            $socsoCompany = 37.65;
            $socsoStaff = 10.75;
            $eisCompany = 4.30;
            $eisStaff = 4.30;
        } elseif ($basicSalary > 2200 && $basicSalary <= 2300) {
            $socsoCompany = 39.35;
            $socsoStaff = 11.25;
            $eisCompany = 4.50;
            $eisStaff = 4.50;
        }
        // Add more elseif conditions for the remaining salary ranges

        $netPay = $basicSalary - ($kwspStaff + $kwspCompany + $socsoCompany + $socsoStaff + $eisCompany + $eisStaff);

        // Retrieve the payroll record from the database
        $payroll = PayrollRecord::find($id);

        if (!$payroll) {
            return redirect()->route('ListPayroll')->with('error', 'Payroll record not found.');
        }

        // Update the corresponding data in the payroll record
        $payroll->basic_salary = $basic_salary;
        $payroll->bonus = $bonus;
        $payroll->allowance = $allowance;
        $payroll->kwsp_staff = $kwspStaff;
        $payroll->kwsp_company = $kwspCompany;
        $payroll->socso_staff = $socsoStaff;
        $payroll->socso_company = $socsoCompany;
        $payroll->eis_staff = $eisStaff;
        $payroll->eis_company = $eisCompany;
        $payroll->netpay = $netPay;
        $payroll->save();

        // Update the basic_salary in the associated employee record
        $employee = $payroll->employee;
        $employee->basic_salary = $basic_salary;
        $employee->save();

        return redirect()->route('ListPayroll');
    }

    public function listPayslip()
    {
        // Retrieve all payroll records and include the associated employee data
        $payslipInfo = PayrollRecord::all();
        $employeeInfo = EmployeeRecord::all();

        return view('ManagePayroll.GeneratePayroll', compact('payslipInfo', 'employeeInfo'));
    }


}
