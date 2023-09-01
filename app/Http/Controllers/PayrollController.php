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
        $basicSalary = $request->input('basic_salary');
        $basic_Salary = $request->input('basic_salary') + $bonus + $allowance;

        $kwspStaff = $basic_Salary <= 5000 ? (11 / 100) * $basic_Salary : (11 / 100) * $basic_Salary;
        $kwspCompany = $basic_Salary <= 5000 ? (13 / 100) * $basic_Salary : (12 / 100) * $basic_Salary;

        // Calculate socsoCompany, socsoStaff, eisCompany, eisStaff based on the given conditions
        $socsoCompany = 0;
        $socsoStaff = 0;
        $eisCompany = 0;
        $eisStaff = 0;

        if ($basicSalary <= 30) {
            $socsoCompany = 0.40;
            $socsoStaff = 0.10;
            $eisCompany = 0.05;
            $eisStaff = 0.05;
        } elseif ($basicSalary > 30 && $basicSalary <= 50) {
            $socsoCompany = 0.70;
            $socsoStaff = 0.20;
            $eisCompany = 0.10;
            $eisStaff = 0.10;
        } elseif ($basicSalary > 50 && $basicSalary <= 70) {
            $socsoCompany = 1.10;
            $socsoStaff = 0.30;
            $eisCompany = 0.15;
            $eisStaff = 0.15;
        } elseif ($basicSalary > 70 && $basicSalary <= 100) {
            $socsoCompany = 1.50;
            $socsoStaff = 0.40;
            $eisCompany = 0.20;
            $eisStaff = 0.20;
        } elseif ($basicSalary > 100 && $basicSalary <= 140) {
            $socsoCompany = 2.10;
            $socsoStaff = 0.60;
            $eisCompany = 0.25;
            $eisStaff = 0.25;
        } elseif ($basicSalary > 140 && $basicSalary <= 200) {
            $socsoCompany = 2.95;
            $socsoStaff = 0.85;
            $eisCompany = 0.35;
            $eisStaff = 0.35;
        } elseif ($basicSalary > 200 && $basicSalary <= 300) {
            $socsoCompany = 4.35;
            $socsoStaff = 1.25;
            $eisCompany = 0.50;
            $eisStaff = 0.50;
        } elseif ($basicSalary > 300 && $basicSalary <= 400) {
            $socsoCompany = 6.15;
            $socsoStaff = 1.75;
            $eisCompany = 0.70;
            $eisStaff = 0.70;
        } elseif ($basicSalary > 400 && $basicSalary <= 500) {
            $socsoCompany = 7.85;
            $socsoStaff = 2.25;
            $eisCompany = 0.90;
            $eisStaff = 0.90;
        } elseif ($basicSalary > 500 && $basicSalary <= 600) {
            $socsoCompany = 9.65;
            $socsoStaff = 2.75;
            $eisCompany = 1.10;
            $eisStaff = 1.10;
        } elseif ($basicSalary > 600 && $basicSalary <= 700) {
            $socsoCompany = 11.35;
            $socsoStaff = 3.25;
            $eisCompany = 1.30;
            $eisStaff = 1.30;
        } elseif ($basicSalary > 700 && $basicSalary <= 800) {
            $socsoCompany = 13.15;
            $socsoStaff = 3.75;
            $eisCompany = 1.50;
            $eisStaff = 1.50;
        } elseif ($basicSalary > 800 && $basicSalary <= 900) {
            $socsoCompany = 14.85;
            $socsoStaff = 4.25;
            $eisCompany = 1.70;
            $eisStaff = 1.70;
        } elseif ($basicSalary > 900 && $basicSalary <= 1000) {
            $socsoCompany = 16.65;
            $socsoStaff = 4.75;
            $eisCompany = 1.90;
            $eisStaff = 1.90;
        } elseif ($basicSalary > 1000 && $basicSalary <= 1100) {
            $socsoCompany = 18.35;
            $socsoStaff = 5.25;
            $eisCompany = 2.10;
            $eisStaff = 2.10;
        } elseif ($basicSalary > 1100 && $basicSalary <= 1200) {
            $socsoCompany = 20.15;
            $socsoStaff = 5.75;
            $eisCompany = 2.30;
            $eisStaff = 2.30;
        } elseif ($basicSalary > 1200 && $basicSalary <= 1300) {
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
        } elseif ($basicSalary > 2300 && $basicSalary <= 2400) {
            $socsoCompany = 41.15;
            $socsoStaff = 11.75;
            $eisCompany = 4.70;
            $eisStaff = 4.70;
        } elseif ($basicSalary > 2400 && $basicSalary <= 2500) {
            $socsoCompany = 42.85;
            $socsoStaff = 12.25;
            $eisCompany = 4.90;
            $eisStaff = 4.90;
        } elseif ($basicSalary > 2500 && $basicSalary <= 2600) {
            $socsoCompany = 44.65;
            $socsoStaff = 12.75;
            $eisCompany = 5.10;
            $eisStaff = 5.10;
        } elseif ($basicSalary > 2600 && $basicSalary <= 2700) {
            $socsoCompany = 46.35;
            $socsoStaff = 13.25;
            $eisCompany = 5.30;
            $eisStaff = 5.30;
        } elseif ($basicSalary > 2700 && $basicSalary <= 2800) {
            $socsoCompany = 48.15;
            $socsoStaff = 13.75;
            $eisCompany = 5.50;
            $eisStaff = 5.50;
        } elseif ($basicSalary > 2800 && $basicSalary <= 2900) {
            $socsoCompany = 49.85;
            $socsoStaff = 14.25;
            $eisCompany = 5.70;
            $eisStaff = 5.70;
        } elseif ($basicSalary > 2900 && $basicSalary <= 3000) {
            $socsoCompany = 51.65;
            $socsoStaff = 14.75;
            $eisCompany = 5.90;
            $eisStaff = 5.90;
        } elseif ($basicSalary > 3000 && $basicSalary <= 3100) {
            $socsoCompany = 53.35;
            $socsoStaff = 15.25;
            $eisCompany = 6.10;
            $eisStaff = 6.10;
        } elseif ($basicSalary > 3100 && $basicSalary <= 3200) {
            $socsoCompany = 55.15;
            $socsoStaff = 15.75;
            $eisCompany = 6.30;
            $eisStaff = 6.30;
        } elseif ($basicSalary > 3200 && $basicSalary <= 3300) {
            $socsoCompany = 56.85;
            $socsoStaff = 16.25;
            $eisCompany = 6.50;
            $eisStaff = 6.50;
        } elseif ($basicSalary > 3300 && $basicSalary <= 3400) {
            $socsoCompany = 58.65;
            $socsoStaff = 16.75;
            $eisCompany = 6.70;
            $eisStaff = 6.70;
        } elseif ($basicSalary > 3400 && $basicSalary <= 3500) {
            $socsoCompany = 60.35;
            $socsoStaff = 17.25;
            $eisCompany = 6.90;
            $eisStaff = 6.90;
        } elseif ($basicSalary > 3500 && $basicSalary <= 3600) {
            $socsoCompany = 62.15;
            $socsoStaff = 17.75;
            $eisCompany = 7.10;
            $eisStaff = 7.10;
        } elseif ($basicSalary > 3600 && $basicSalary <= 3700) {
            $socsoCompany = 63.85;
            $socsoStaff = 18.25;
            $eisCompany = 7.30;
            $eisStaff = 7.30;
        } elseif ($basicSalary > 3700 && $basicSalary <= 3800) {
            $socsoCompany = 65.65;
            $socsoStaff = 18.75;
            $eisCompany = 7.50;
            $eisStaff = 7.50;
        } elseif ($basicSalary > 3800 && $basicSalary <= 3900) {
            $socsoCompany = 67.35;
            $socsoStaff = 19.25;
            $eisCompany = 7.70;
            $eisStaff = 7.70;
        } elseif ($basicSalary > 3900 && $basicSalary <= 4000) {
            $socsoCompany = 69.15;
            $socsoStaff = 19.75;
            $eisCompany = 7.90;
            $eisStaff = 7.90;
        } elseif ($basicSalary > 4000 && $basicSalary <= 4100) {
            $socsoCompany = 70.85;
            $socsoStaff = 20.25;
            $eisCompany = 8.10;
            $eisStaff = 8.10;
        } elseif ($basicSalary > 4100 && $basicSalary <= 4200) {
            $socsoCompany = 72.65;
            $socsoStaff = 20.75;
            $eisCompany = 8.30;
            $eisStaff = 8.30;
        } elseif ($basicSalary > 4200 && $basicSalary <= 4300) {
            $socsoCompany = 74.35;
            $socsoStaff = 21.25;
            $eisCompany = 8.50;
            $eisStaff = 8.50;
        } elseif ($basicSalary > 4300 && $basicSalary <= 4400) {
            $socsoCompany = 76.15;
            $socsoStaff = 21.75;
            $eisCompany = 8.70;
            $eisStaff = 8.70;
        } elseif ($basicSalary > 4400 && $basicSalary <= 4500) {
            $socsoCompany = 77.85;
            $socsoStaff = 22.25;
            $eisCompany = 8.90;
            $eisStaff = 8.90;
        } elseif ($basicSalary > 4500 && $basicSalary <= 4600) {
            $socsoCompany = 79.65;
            $socsoStaff = 22.75;
            $eisCompany = 9.10;
            $eisStaff = 9.10;
        } elseif ($basicSalary > 4600 && $basicSalary <= 4700) {
            $socsoCompany = 81.35;
            $socsoStaff = 23.25;
            $eisCompany = 9.30;
            $eisStaff = 9.30;
        } elseif ($basicSalary > 4700 && $basicSalary <= 4800) {
            $socsoCompany = 83.15;
            $socsoStaff = 23.75;
            $eisCompany = 9.50;
            $eisStaff = 9.50;
        } elseif ($basicSalary > 4800 && $basicSalary <= 4900) {
            $socsoCompany = 84.85;
            $socsoStaff = 24.25;
            $eisCompany = 9.70;
            $eisStaff = 9.70;
        } elseif ($basicSalary > 4900 && $basicSalary <= 5000) {
            $socsoCompany = 86.65;
            $socsoStaff = 24.75;
            $eisCompany = 9.90;
            $eisStaff = 9.90;
        } elseif ($basicSalary > 5000 ) {
            $socsoCompany = 88.35;
            $socsoStaff = 25.25;
            $eisCompany = 9.90;
            $eisStaff = 9.90;
        }

        $netPay = $basic_Salary - ($kwspStaff + $socsoStaff + $eisStaff);

        // Retrieve the payroll record from the database
        $payroll = PayrollRecord::find($id);

        if (!$payroll) {
            return redirect()->route('ListPayroll')->with('error', 'Payroll record not found.');
        }

        // Update the corresponding data in the payroll record
        $payroll->basic_salary = $basicSalary;
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
        $employee->basic_salary = $basicSalary;
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
