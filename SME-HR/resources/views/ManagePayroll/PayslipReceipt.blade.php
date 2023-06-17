<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Payslip Information') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Employee</a></div>
            <div class="breadcrumb-item"><a href="{{ route('addPosition') }}">Add Position</a></div>
        </div>
    </x-slot>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!--begin::Tab-->
                    <!--begin::Row-->
                    <div class="card-content collpase show">
                        <div class="col-md-12">
                            <div class="text-md-right">
                                <a href="javascript:void(0)" onclick="printInvoice()"><button class="btn btn-warning float-md-right"><i class="fas fa-print">&nbsp;Print</i></button></a>
                            </div>
                        </div>
                        <div class="card-body" id="invoice-template">
                            <div class="col-12">
                                <!-- Invoice Company Details -->
                                <div id="invoice-company-details">
                                    <div>
                                        <img src="../build/assets/images/sme_logo2.png" alt="company logo" width="100" height="100" />
                                    </div>
                                </div>
                                <div class="card">
                                    <center>
                                        <strong>
                                            <h1>PAY ADVICE</h1>
                                        </strong>
                                        <h1>Payment slip for the month of <?php
                                                                            $month = $payslipInfo->month;
                                                                            $monthRanges = [
                                                                                '1' => 'January',
                                                                                '2' => 'February',
                                                                                '3' => 'March',
                                                                                '4' => 'April',
                                                                                '5' => 'May',
                                                                                '6' => 'June',
                                                                                '7' => 'July',
                                                                                '8' => 'August',
                                                                                '9' => 'September',
                                                                                '10' => 'October',
                                                                                '11' => 'November',
                                                                                '12' => 'December',
                                                                            ];
                                                                            ?>
                                            {{ $monthRanges[$month] }} {{ old('year', $payslipInfo->year) }}
                                        </h1>
                                    </center>
                                    <br><br>

                                    <!-- Account Details -->
                                    <div class="col-12">
                                        <div class="card" style="width: 100%;">
                                            <div class="card-content collapse show">
                                                <div class="table-responsive">
                                                    <center>
                                                        <table style="width: 100%;">
                                                            <tr>
                                                                <td>
                                                                    <b>Company:</b> Ahn Exora Enterprises
                                                                </td>
                                                                <td text align="center">
                                                                    <b>Employee Name:</b> {{ old('name', $employeeInfo->name) }}
                                                                </td>
                                                                <td text align="right">
                                                                    <b>Bank:</b> <?php
                                                                                    $bank = $employeeInfo->bank_name;
                                                                                    $bankNames = [
                                                                                        '1' => 'Affin Bank Berhad',
                                                                                        '2' => 'Agrobank',
                                                                                        '3' => 'Al Rajhi & Investment Corporation (Malaysia) Berhad',
                                                                                        '4' => 'Alliance Bank Malaysia Berhad',
                                                                                        '5' => 'AmBank Berhad',
                                                                                        '6' => 'Bank Kerjasama Rakyat Malaysia Berhad',
                                                                                        '7' => 'Bank Muamalat Malaysia Berhad',
                                                                                        '8' => 'Bank of America (Malaysia) Berhad',
                                                                                        '9' => 'Bank of China (Malaysia) Berhad',
                                                                                        '10' => 'Bank Simpanan Nasional',
                                                                                        '11' => 'BigPay',
                                                                                        '12' => 'BNP Paribas Malaysia Berhad',
                                                                                        '13' => 'China Construction Bank (Malaysia) Berhad',
                                                                                        '14' => 'CIMB Bank Berhad',
                                                                                        '15' => 'Citibank Berhad',
                                                                                        '16' => 'Deutsche Bank (Malaysia) Berhad',
                                                                                        '17' => 'Finexus Cards Sdn. Bhd.',
                                                                                        '18' => 'Hong Leong Bank Berhad',
                                                                                        '19' => 'HSBC Bank Malaysia Berhad',
                                                                                        '20' => 'Industrial And Commercial Bank of China',
                                                                                        '21' => 'JP Morgan Chase Bank Berhad',
                                                                                        '22' => 'Kuwait Finance House (Malaysia) Berhad',
                                                                                        '23' => 'Maybank Berhad',
                                                                                        '24' => 'MBSB Bank Berhad',
                                                                                        '25' => 'Mizuho Bank (Malaysia) Berhad',
                                                                                        '26' => 'MUFG Bank (Malaysia) Berhad',
                                                                                        '27' => 'OCBC Bank (Malaysia) Berhad',
                                                                                        '28' => 'Public Bank Berhad',
                                                                                        '29' => 'RHB Bank Berhad',
                                                                                        '30' => 'Standard Chartered Bank Malaysia Berhad',
                                                                                        '31' => 'Sumitomo Mitsui Banking Corporation',
                                                                                        '32' => 'Touch n Go eWallet',
                                                                                        '33' => 'United Overseas Bank Berhad'
                                                                                    ];
                                                                                    ?>
                                                                    {{ $bankNames[$bank] }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <b>Branch:</b> Sitiawan
                                                                </td>
                                                                <td text align="center">
                                                                    <b>Designation:</b> {{ old('position_id', $employeeInfo->position->position_name) }}
                                                                </td>
                                                                <td text align="right">
                                                                    <b>Account No:</b> {{ old('account_number', $employeeInfo->account_number) }}
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="card-content collapse show">
                                        <div class="table-responsive dash-social">
                                            <table id="datatable" class="table" style="border-collapse: collapse; border: 1px solid black;">
                                                <tr bgcolor="#a69e9d" style="border: 1px solid black;">
                                                    <th style="border-bottom: 1px solid black;">
                                                        <font color="black">Earning</font>
                                                    </th>
                                                    <th style="text-align: right; border-bottom: 1px solid black;">
                                                        <font color="black">Amount (RM)</font>
                                                    </th>

                                                    <th class=" border-left" style="border-bottom: 1px solid black;">
                                                        <font color="black">Deduction</font>
                                                    </th>
                                                    <th style="text-align: right; border-bottom: 1px solid black;">
                                                        <font color="black">Amount (RM)</font>
                                                    </th>
                                                </tr>

                                                <tbody>
                                                    <tr>
                                                        <td class=" border-left">Basic Salary</td>
                                                        <td text align="right">
                                                            <input type="hidden" id="basic_salary" name="basic_salary" value="basic_salary">
                                                            {{ old('basic_salary', $payslipInfo->basic_salary) }}
                                                            &nbsp;&nbsp;
                                                        </td>
                                                        <td class=" border-left">KWSP Contribution</td>
                                                        <td text align="right">
                                                            <input type="hidden" id="kwsp_staff" name="kwsp_staff" value="kwsp_staff">
                                                            {{ old('kwsp_staff', $payslipInfo->kwsp_staff) }}
                                                            &nbsp;&nbsp;
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class=" border-left">Allowance</td>
                                                        <td text align="right">
                                                            <input type="hidden" id="allowance" name="allowance" value="allowance">
                                                            {{ old('allowance', $payslipInfo->allowance ?? 0.00) }}
                                                            &nbsp;&nbsp;
                                                        </td>
                                                        <td class=" border-left">SOCSO Contribution</td>
                                                        <td text align="right">
                                                            <input type="hidden" id="socso_staff" name="socso_staff" value="socso_staff">
                                                            {{ old('socso_staff', $payslipInfo->socso_staff) }}
                                                            &nbsp;&nbsp;
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class=" border-left">Bonus</td>
                                                        <td text align="right">
                                                            <input type="hidden" id="bonus" name="bonus" value="bonus">
                                                            {{ old('bonus', $payslipInfo->bonus ?? 0.00) }}
                                                            &nbsp;&nbsp;
                                                        </td>
                                                        <td class=" border-left">EIS Contribution</td>
                                                        <td text align="right">
                                                            <input type="hidden" id="eis_staff" name="eis_staff" value="eis_staff">
                                                            {{ old('eis_staff', $payslipInfo->eis_staff) }}
                                                            &nbsp;&nbsp;
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class=" border-left"></td>
                                                        <td></td>
                                                        <td class=" border-left">Zakat</td>
                                                        <td text align="right">
                                                            <input type="hidden" id="zakat" name="zakat" value="zakat">
                                                            {{ old('zakat', $payslipInfo->zakat ?? 0.00) }}
                                                            &nbsp;&nbsp;
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class=" border-left"></td>
                                                        <td></td>
                                                        <td class=" border-left">Deduction</td>
                                                        <td text align="right">
                                                            <input type="hidden" id="deduction" name="deduction" value="deduction">
                                                            {{ old('deduction', $payslipInfo->deduction ?? 0.00) }}
                                                            &nbsp;&nbsp;
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class=" border-left"></td>
                                                        <td></td>
                                                        <td class=" border-left"></td>
                                                        <td></td>
                                                    </tr>

                                                    <?php
                                                    $basic_salary = floatval(old('basic_salary', $payslipInfo->basic_salary));
                                                    $allowance = floatval(old('allowance', $payslipInfo->allowance));
                                                    $bonus = floatval(old('bonus', $payslipInfo->bonus));
                                                    $kwsp_staff = floatval(old('kwsp_staff', $payslipInfo->kwsp_staff));
                                                    $socso_staff = floatval(old('socso_staff', $payslipInfo->socso_staff));
                                                    $eis_staff = floatval(old('eis_staff', $payslipInfo->eis_staff));
                                                    $zakat = floatval(old('zakat', $payslipInfo->zakat));
                                                    $deduction = floatval(old('deduction', $payslipInfo->deduction));

                                                    $gross_pay = $basic_salary + $allowance + $bonus;
                                                    $total_deduction = $kwsp_staff + $socso_staff + $eis_staff + $zakat + $deduction;
                                                    $net_pay = $gross_pay - $total_deduction;

                                                    ?>

                                                    <tr>
                                                        <td class=" border-left"><strong>Gross Pay</strong></td>
                                                        <td text align="right">
                                                            <strong>
                                                                <input type="hidden" id="gross" name="gross" value="gross">
                                                                {{ $gross_pay }}
                                                                &nbsp;&nbsp;
                                                            </strong>
                                                        </td>
                                                        <td class=" border-left"><strong>Total Deduction</strong></td>
                                                        <td text align="right">
                                                            <strong>
                                                                <input type="hidden" id="total_deduction" name="total_deduction" value="total_deduction">
                                                                {{ $total_deduction }}
                                                                &nbsp;&nbsp;
                                                            </strong>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class=" border-left"></td>
                                                        <td></td>
                                                        <td class=" border-left"><strong>Net Pay</strong></td>
                                                        <td text align="right">
                                                            <strong>
                                                                <input type="hidden" id="net_pay" name="net_pay" value="net_pay">
                                                                {{ $net_pay }}
                                                                &nbsp;&nbsp;
                                                            </strong>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--end card-body-->
        </div><!--end card-->
    </div> <!--end col-->

</x-app-layout>

<script>
    function printInvoice() {
        var printContents = document.getElementById('invoice-template').innerHTML;
        var originalContents = document.body.innerHTML;

        // Replace the entire body content with the desired div content
        document.body.innerHTML = printContents;

        // Trigger the print function
        window.print();

        // Restore the original body content
        document.body.innerHTML = originalContents;
    }
</script>