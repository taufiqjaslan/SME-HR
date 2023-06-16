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
                        <div class="card-body">

                            <div id="invoice-template">
                                <!-- Invoice Company Details -->
                                <div id="invoice-company-details">
                                    <div>
                                        <img src="../build/assets/images/sme_logo2.png" alt="company logo" width="250" height="100" />
                                    </div>
                                </div>

                                <center>
                                    <strong>
                                        <h1>PAY ADVICE</h1>
                                    </strong>
                                </center>
                                <br><br>

                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-content collapse show">
                                            <div class="table-responsive dash-social">
                                                <table id="datatable" class="table">
                                                    <tr bgcolor="#a69e9d">
                                                        <th>
                                                            <font color="black">Earning</font>
                                                        </th>
                                                        <th>
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="black">Amount (RM)</font>
                                                        </th>
                                                        <th>
                                                            &nbsp;&nbsp;<font color="black">Deduction</font>
                                                        </th>
                                                        <th>
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="black" align="right">Amount(RM)</font>
                                                        </th>
                                                    </tr>

                                                    <tbody class="noborders">
                                                        <tr>
                                                            <td>Basic Salary</td>
                                                            <td text align="right">
                                                                <input type="hidden" id="BASIC" name="BASIC" value="BASIC_AMOUNT">
                                                                BASIC_AMOUNT
                                                                &nbsp;&nbsp;
                                                            </td>
                                                            <td class=" border-left">EPF Contribution</td>
                                                            <td text align="right">
                                                                <input type="hidden" id="KWSP_STAFF" name="KWSP_STAFF" value="KWSP_AMOUNT">
                                                                KWSP_AMOUNT
                                                                &nbsp;&nbsp;
                                                            </td>
                                                        </tr>
                                                        <tr class="noborders">
                                                            <td></td>
                                                            <td>
                                                                <input type="hidden" id="OTHERS" name="OTHERS" value="OTHERS_AMOUNT">
                                                            </td>
                                                            <td class=" border-left">Socso Contribution</td>
                                                            <td text align="right">
                                                                <input type="hidden" id="SOCSO_STAFF" name="SOCSO_STAFF" value="SOCSO_AMOUNT">
                                                                SOCSO_AMOUNT
                                                                &nbsp;&nbsp;
                                                            </td>
                                                        </tr>
                                                        <tr class="noborders">
                                                            <td></td>
                                                            <td>
                                                                <input type="hidden" id="bonus" name="bonus" value="BONUS_AMOUNT">
                                                            </td>
                                                            <td class=" border-left">Eis Contribution</td>
                                                            <td text align="right">
                                                                <input type="hidden" id="EIS_STAFF" name="EIS_STAFF" value="EIS_AMOUNT">
                                                                EIS_AMOUNT
                                                                &nbsp;&nbsp;
                                                            </td>
                                                        </tr>
                                                        <tr class="noborders">
                                                            <td></td>
                                                            <td></td>
                                                            <td class=" border-left">Zakat</td>
                                                            <td text align="right">
                                                                <input type="hidden" id="ZAKAT" name="ZAKAT" value="ZAKAT_AMOUNT">
                                                                ZAKAT_AMOUNT
                                                                &nbsp;&nbsp;
                                                            </td>
                                                        </tr>
                                                        <tr class="noborders">
                                                            <td></td>
                                                            <td></td>
                                                            <td class=" border-left">Tax</td>
                                                            <td text align="right">
                                                                <input type="hidden" id="TAX" name="TAX" value="TAX_AMOUNT">
                                                                TAX_AMOUNT
                                                                &nbsp;&nbsp;
                                                            </td>
                                                        </tr>
                                                        <tr class="noborders">
                                                            <td></td>
                                                            <td></td>
                                                            <td class=" border-left">Others</td>
                                                            <td text align="right">
                                                                <input type="hidden" id="OTHERS2" name="OTHERS2" value="OTHERS2_AMOUNT">
                                                                OTHERS2_AMOUNT
                                                                &nbsp;&nbsp;
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Gross Pay</strong></td>
                                                            <td>
                                                                <strong>
                                                                    <input type="hidden" id="GROSS" name="GROSS" value="GROSS_AMOUNT">
                                                                    GROSS_AMOUNT
                                                                    &nbsp;&nbsp;
                                                                </strong>
                                                            </td>
                                                            <td class=" border-left"><strong>Total Deduction</strong></td>
                                                            <td>
                                                                <strong>
                                                                    <input type="hidden" id="DEDUCTION" name="DEDUCTION" value="DEDUCTION_AMOUNT">
                                                                    DEDUCTION_AMOUNT
                                                                    &nbsp;&nbsp;
                                                                </strong>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td class=" border-left"></td>
                                                            <td text align="right"></td>
                                                        </tr>
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td class=" border-left"><strong>Net Pay</strong></td>
                                                            <td>
                                                                <strong>
                                                                    <input type="hidden" id="NET_PAY" name="NET_PAY" value="NET_PAY_AMOUNT">
                                                                    NET_PAY_AMOUNT
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

                                <!-- Account Details -->
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-content collapse show">
                                            <div class="table-responsive">
                                                <table width="930">
                                                    <tr>
                                                        <td>
                                                            <b>Account No:</b> ACCOUNT_NO
                                                        </td>
                                                        <td>
                                                            <b>Bank:</b> BANK
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <b>Account Holder:</b> ACCOUNT_HOLDER
                                                        </td>
                                                        <td>
                                                            <b>Branch:</b> BRANCH
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
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