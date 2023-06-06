<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('View Payroll') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Leave</a></div>
            <div class="breadcrumb-item"><a href="">View Payroll</a></div>
        </div>
    </x-slot>

    <div class="row">
        <div class="col-md-12">
            <div class="text-md-right">
                <a href="{{route('ListPayroll')}}"><button class="btn btn-primary float-md-right"><i class="fas fa-chevron-left"></i></button></a>
            </div>
        </div>
    </div>
    <br>

    <div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <!--begin::Tab-->
                        <div class="tab-pane show active px-7" id="kt_user_edit_tab_1" role="tabpanel">
                            <!--begin::Row-->
                            <div class="card-header">
                                <h1 class="card-title"><i class="fas fa-money-bill-trend-up">&nbsp;&nbsp;&nbsp;</i>Income</h1>
                            </div>
                            <div class="card-content collpase show">
                                <div class="card-body">
                                    <form method="POST" class="form form-horizontal" action="" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control">Basic Salary</label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input type="text" class="form-control border-primary" placeholder="Basic Salary" name="basic_salary" id="basic_salary" value="{{ old('basic_salary', $employeeInfo->basic_salary) }}" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control">Allowance</label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input type="text" class="form-control border-primary" placeholder="Other Allowance" name="allowance" id="allowance" value="{{ old('allowance', $payrollInfo->allowance) }}" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control">Bonus</label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input type="text" class="form-control border-primary" placeholder="Bonus" name="bonus" id="bonus" value="{{ old('bonus', $payrollInfo->bonus) }}" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <h4 class="form-section"><i class="fas fa-money-bill-trend-up">&nbsp;&nbsp;&nbsp;</i>Expenses</h4>
                                            <br>
                                            <hr>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control">KWSP Staff</label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input type="text" class="form-control border-primary" placeholder="KWSP Staff" name="kwsp_staff" id="kwsp_staff" value="{{ old('kwsp_staff', $payrollInfo->kwsp_staff) }}" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control">SOCSO Staff</label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input type="text" class="form-control border-primary" placeholder="SOCSO Staff" name="socso_staff" id="socso_staff" value="{{ old('socso_staff', $payrollInfo->socso_staff) }}" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control">EIS Staff</label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input type="text" class="form-control border-primary" placeholder="EIS Staff" name="eis_staff" id="eis_staff" value="{{ old('eis_staff', $payrollInfo->eis_staff) }}" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control">Deduction
                                                            /Advance</label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input type="text" class="form-control border-primary" placeholder="Deduction/Advance" name="deduction" id="deduction" value="{{ old('deduction', $payrollInfo->deduction) }}" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control">Zakat</label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input type="text" class="form-control border-primary" placeholder="Zakat" name="zaakt" id="zakat" value="{{ old('zakat', $payrollInfo->zakat) }}" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <h4 class="form-section"><i class="fas fa-money-bill-trend-up">&nbsp;&nbsp;&nbsp;</i>Contribution</h4>
                                            <br>
                                            <hr>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control">KWSP Employer</label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input type="text" class="form-control border-primary" placeholder="KWSP Employer" name="kwsp_company" id="kwsp_company" value="{{ old('kwsp_company', $payrollInfo->kwsp_company) }}" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control">SOCSO Employer</label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input type="text" class="form-control border-primary" placeholder="SOCSO Employer" name="socso_company" id="socso_company" value="{{ old('socso_company', $payrollInfo->socso_company) }}" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control">EIS Employer</label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input type="text" class="form-control border-primary" placeholder="EIS Employer" name="eis_company" id="eis_company" value="{{ old('eis_company', $payrollInfo->eis_company) }}" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--end card-body-->
            </div><!--end card-->
        </div> <!--end col-->
    </div>

</x-app-layout>