<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Generate EA Form') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">EA Form</a></div>
            <div class="breadcrumb-item"><a href="">Add EA Form</a></div>
        </div>
    </x-slot>

    <div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <!--begin::Tab-->
                        <!-- <div class="tab-pane show active px-7" id="kt_user_edit_tab_1" role="tabpanel"> -->
                        <!--begin::Row-->
                        <div class="card-header">
                            <h1 class="card-title"><i class="fas fa-user">&nbsp;&nbsp;&nbsp;</i>EA Form Information</h1>
                        </div>
                        <div class="card-content collpase show">
                            <div class="card-body">
                                <form method="POST" class="form form-horizontal" action="{{route('RegisterEmployee')}}">
                                    @csrf
                                    <div class="form-body">
                                        <h4 class="form-section"><i class="fas fa-file-alt">&nbsp;&nbsp;&nbsp;</i>Company Details</h4>
                                        <br>
                                        <hr>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">Serial Number</label>
                                                    <div class="col-md-9 mx-auto">
                                                        <input type="text" class="form-control border-primary" id="serial_number" name="serial_number">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">LHDN Branch</label>
                                                    <div class="col-md-9 mx-auto">
                                                        <input type="text" class="form-control border-primary name="branch" id="branch">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">Employer Name</label>
                                                    <div class="col-md-9 mx-auto">
                                                        <input type="text" class="form-control border-primary" name="emp_name" id="emp_name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">Position</label>
                                                    <div class="col-md-9 mx-auto">
                                                        <input type="text" class="form-control border-primary" name="position" id="position" value="{{$eaFormData->first()->employee->position->position_name}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">Date</label>
                                                    <div class="col-md-9 mx-auto">
                                                        <input class="form-control border-primary" type="date" name="date" id="date">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">Year</label>
                                                    <div class="col-md-9 mx-auto">
                                                        @php
                                                        $currentYear = date('Y');
                                                        $years = range($currentYear - 2, $currentYear);
                                                        $years = array_reverse($years);
                                                        @endphp
                                                        <select name="year" class="form-control border-primary" id="year">
                                                            <option disabled value="" selected hidden>Select Year</option>
                                                            @foreach ($years as $year)
                                                            <option value="{{ $year }}">{{ $year }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h4 class="form-section"><i class="fas fa-calendar-alt">&nbsp;&nbsp;&nbsp;</i>Particulars of Employee</h4>
                                    <br>
                                    <hr>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control">Full Name</label>
                                                <div class="col-md-9 mx-auto">
                                                    <input type="text" class="form-control border-primary" id="name" name="name" value="{{$eaFormData->first()->employee->name}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control">Position</label>
                                                <div class="col-md-9 mx-auto">
                                                    <input type="text" class="form-control border-primary" name="position" id="position" value="{{$eaFormData->first()->employee->position->position_name}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control">New IC Number</label>
                                                <div class="col-md-9 mx-auto">
                                                    <input type="text" class="form-control border-primary" name="ic" id="ic" value="{{$eaFormData->first()->employee->ic}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control">Staff / Payroll Number</label>
                                                <div class="col-md-9 mx-auto">
                                                    <input type="text" class="form-control border-primary" name="payroll_num" id="payroll_num">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control">EPF Number</label>
                                                <div class="col-md-9 mx-auto">
                                                    <input type="text" class="form-control border-primary" name="epf_num" id="epf_num">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control">KWSP Number</label>
                                                <div class="col-md-9 mx-auto">
                                                    <input type="text" class="form-control border-primary" name="kwsp_num" id="kwsp_num">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control">Start Date</label>
                                                <div class="col-md-9 mx-auto">
                                                    <input type="date" class="form-control border-primary" name="start_date" id="start_date">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control">End Date</label>
                                                <div class="col-md-9 mx-auto">
                                                    <input type="date" class="form-control border-primary" name="end_date" id="end_date">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control">Number of Children Qualified for Tax Relief</label>
                                                <div class="col-md-9 mx-auto">
                                                    <input type="number" class="form-control border-primary" name="children_num" id="children_num">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h4 class="form-section"><i class="fas fa-calendar-alt">&nbsp;&nbsp;&nbsp;</i>Employement Income, Benefits and Living Accommodation</h4>
                                    <h5 class="form-section">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(Excluding Tax Exempt, Allowances / Perquisites / Gifts / Benefits)</h5>
                                    <br>
                                    <hr>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control">Gross Salary, Wages or Leave Pay (including overtime pay)</label>
                                                <div class="col-md-9 mx-auto">
                                                    <input type="text" class="form-control border-primary" id="gross_salary" name="gross_salary">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control">Fees (including director fess), commission or bonus</label>
                                                <div class="col-md-9 mx-auto">
                                                    <input type="text" class="form-control border-primary" id="fees" name="fees">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control">Gross Tips, Perquisites, Award / Rewards or Other Allowance</label>
                                                <div class="col-md-9 mx-auto">
                                                    <input type="text" class="form-control border-primary" id="gross_tip" name="gross_tip">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control">Income Tax Borne by the Employer in Respect of his Employee</label>
                                                <div class="col-md-9 mx-auto">
                                                    <input type="text" class="form-control border-primary" id="income_tax" name="income_tax">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control">Refund from Unapproved Provident / Pension Fund</label>
                                                <div class="col-md-9 mx-auto">
                                                    <input type="text" class="form-control border-primary" name="refund" id="refund">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control">Compensation for Loss of Employment</label>
                                                <div class="col-md-9 mx-auto">
                                                    <input type="text" class="form-control border-primary" name="compensation" id="compensation">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h4 class="form-section"><i class="fas fa-calendar-alt">&nbsp;&nbsp;&nbsp;</i>Pension and Others</h4>
                                    <br>
                                    <hr>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control">Pension</label>
                                                <div class="col-md-9 mx-auto">
                                                    <input type="text" class="form-control border-primary" id="pension" name="pension">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control">Annuities or Other Periodical Payments</label>
                                                <div class="col-md-9 mx-auto">
                                                    <input type="text" class="form-control border-primary" id="annuities" name="annuities">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h4 class="form-section"><i class="fas fa-calendar-alt">&nbsp;&nbsp;&nbsp;</i>Total Deduction</h4>
                                    <br>
                                    <hr>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control">Monthly Tax Deduction (MTD) Remitted to LHDNM</label>
                                                <div class="col-md-9 mx-auto">
                                                    <input type="text" class="form-control border-primary" id="tax_deduction" name="tax_deduction">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control">CP38 Deduction Remitted to LHDNM</label>
                                                <div class="col-md-9 mx-auto">
                                                    <input type="text" class="form-control border-primary" id="cp38_deduction" name="cp38_deduction">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control">Zakat Paid via Salary Deduction</label>
                                                <div class="col-md-9 mx-auto">
                                                    <input type="text" class="form-control border-primary" id="zakat_deduction" name="zakat_deduction">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control">Zakat Other thab that paid via Monthly Salary Deduction</label>
                                                <div class="col-md-9 mx-auto">
                                                    <input type="text" class="form-control border-primary" id="zakat" name="zakat">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control">Total Qualifying Child Relief</label>
                                                <div class="col-md-9 mx-auto">
                                                    <input type="text" class="form-control border-primary" id="child_relief" name="child_relief">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h4 class="form-section"><i class="fas fa-calendar-alt">&nbsp;&nbsp;&nbsp;</i>Contributions Paid by Employee to Approved Proident Pension Fund and SOCSO</h4>
                                    <br>
                                    <hr>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control">Amount of Compulsory Cotribution Paid</label>
                                                <div class="col-md-9 mx-auto">
                                                    <input type="text" class="form-control border-primary" id="amount" name="amount">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control">SOCSO Amount</label>
                                                <div class="col-md-9 mx-auto">
                                                    <input type="text" class="form-control border-primary" id="socso" name="socso">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <br>
                                    <div class="form-actions text-center">
                                        <button class="btn btn-primary float-md-right" id="generate_button">
                                            <i class="fa fa-dot-circle-o"></i>&nbsp;&nbsp;Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- </div> -->
                    </div>
                </div><!--end card-body-->
            </div><!--end card-->
        </div> <!--end col-->
    </div>

</x-app-layout>