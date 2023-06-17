<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Employee Details') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Employee</a></div>
            <div class="breadcrumb-item"><a href="">Employee Details</a></div>
        </div>
    </x-slot>

    <div class="row">
        <div class="col-md-12">
            <div class="text-md-right">
                <a href="{{route('ListEmployee')}}"><button class="btn btn-primary float-md-right"><i class="fas fa-chevron-left"></i></button></a>
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
                                <h1 class="card-title"><i class="fas fa-user">&nbsp;&nbsp;&nbsp;</i>Employee Information</h1>
                            </div>
                            <div class="card-content collpase show">
                                <div class="card-body">
                                    <form method="POST" class="form form-horizontal" action="">
                                        <div class="form-body">
                                            <h4 class="form-section"><i class="fas fa-file-alt">&nbsp;&nbsp;&nbsp;</i>Employee Details</h4>
                                            <br>
                                            <hr>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control">Full Name</label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input type="text" class="form-control border-primary" placeholder="Full Name" id="name" name="name" value="{{ old('name', $employeeInfo->name) }}" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control">Username</label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input type="text" class="form-control border-primary" placeholder="Username" name="username" id="username" value="{{ old('username', $employeeInfo->username) }}" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control">Identification Number</label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input type="text" class="form-control border-primary" placeholder="Identification Number" name="ic" id="ic" value="{{ old('ic', $employeeInfo->ic) }}" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control">Phone Number</label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input type="text" class="form-control border-primary" placeholder="Phone Number" name="phone_number" id="phone_number" value="{{ old('phone_number', $employeeInfo->phone_number) }}" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control">Email</label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input class="form-control border-primary" type="email" placeholder="Email" name="email" id="email" value="{{ old('email', $employeeInfo->email) }}" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control">Password</label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input class="form-control border-primary" type="password" placeholder="Password" name="password" id="password" value="{{ old('password', $employeeInfo->password) }}" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control">Confirmation Password</label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input class="form-control border-primary" type="password" placeholder="Confirm Password" name="password" id="password" value="{{ old('password', $employeeInfo->password) }}" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <h4 class="form-section"><i class="fas fa-calendar-alt">&nbsp;&nbsp;&nbsp;</i>Employement Details</h4>
                                        <br>
                                        <hr>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">Position</label>
                                                    <div class="col-md-9 mx-auto">
                                                        <select name="position_id" class="form-control border-primary" id="position_id" disabled>
                                                            @foreach ($positions as $position)
                                                            <option value="{{ $position->id }}" {{ old('position_id', $employeeInfo->position_id) == $position->id ? 'selected' : '' }}>
                                                                {{ $position->position_name }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">User Type</label>
                                                    <div class="col-md-9 mx-auto">
                                                        <select name="user_type" class="form-control border-primary" id="user_type" disabled>
                                                            <option value="1" {{ old('user_type_id', $employeeInfo->user_type_id) == '1' ? 'selected' : '' }}>Administrator</option>
                                                            <option value="2" {{ old('user_type_id', $employeeInfo->user_type_id) == '2' ? 'selected' : '' }}>Manager</option>
                                                            <option value="3" {{ old('user_type_id', $employeeInfo->user_type_id) == '3' ? 'selected' : '' }}>Staff</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">Start Date </label>
                                                    <div class="col-md-9 mx-auto">
                                                        <input type="date" class="form-control border-primary" placeholder="Start Date" id="start_date" name="start_date" value="{{ old('start_date', $employeeInfo->start_date) }}" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">End Date</label>
                                                    <div class="col-md-9 mx-auto">
                                                        <input type="date" class="form-control border-primary" placeholder="" name="end_date" id="end_date" value="{{ old('end_date', $employeeInfo->end_date) }}" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">Gender</label>
                                                    <div class="col-md-9 mx-auto">
                                                        <select name="gender" class="form-control border-primary" id="gender" disabled>
                                                            <option value="1" {{ old('gender', $employeeInfo->gender) == '1' ? 'selected' : '' }}>Female</option>
                                                            <option value="2" {{ old('gender', $employeeInfo->gender) == '2' ? 'selected' : '' }}>Male</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">Address</label>
                                                    <div class="col-md-9 mx-auto">
                                                        <textarea rows="6" class="form-control border-primary" name="address" placeholder="Address" id="address" disabled>{{ old('address', $employeeInfo->address) }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <h4 class="form-section"><i class="fas fa-money-bill-alt">&nbsp;&nbsp;&nbsp;</i>Account Details</h4>
                                        <br>
                                        <hr>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">Bank Name</label>
                                                    <div class="col-md-9 mx-auto">
                                                        <select name="bank_name" class="form-control border-primary" id="bank_name" disabled>
                                                            <option disabled value="" selected hidden>Select</option>
                                                            <option value="1" {{ old('bank_name', $employeeInfo->bank_name) == '1' ? 'selected' : '' }}>Affin Bank Berhad</option>
                                                            <option value="2" {{ old('bank_name', $employeeInfo->bank_name) == '2' ? 'selected' : '' }}>Agrobank</option>
                                                            <option value="3" {{ old('bank_name', $employeeInfo->bank_name) == '3' ? 'selected' : '' }}>Al Rajhi & Investment Corporation (Malaysia) Berhad</option>
                                                            <option value="4" {{ old('bank_name', $employeeInfo->bank_name) == '4' ? 'selected' : '' }}>Alliance Bank Malaysia Berhad</option>
                                                            <option value="5" {{ old('bank_name', $employeeInfo->bank_name) == '5' ? 'selected' : '' }}>AmBank Berhad</option>
                                                            <option value="6" {{ old('bank_name', $employeeInfo->bank_name) == '6' ? 'selected' : '' }}>Bank Kerjasama Rakyat Malaysia Berhad</option>
                                                            <option value="7" {{ old('bank_name', $employeeInfo->bank_name) == '7' ? 'selected' : '' }}>Bank Muamalat Malaysia Berhad</option>
                                                            <option value="8" {{ old('bank_name', $employeeInfo->bank_name) == '8' ? 'selected' : '' }}>Bank of America (Malaysia) Berhad</option>
                                                            <option value="9" {{ old('bank_name', $employeeInfo->bank_name) == '9' ? 'selected' : '' }}>Bank of China (Malaysia) Berhad</option>
                                                            <option value="10" {{ old('bank_name', $employeeInfo->bank_name) == '10' ? 'selected' : '' }}>Bank Simpanan Nasional</option>
                                                            <option value="11" {{ old('bank_name', $employeeInfo->bank_name) == '11' ? 'selected' : '' }}>BigPay</option>
                                                            <option value="12" {{ old('bank_name', $employeeInfo->bank_name) == '12' ? 'selected' : '' }}>BNP Paribas Malaysia Berhad</option>
                                                            <option value="13" {{ old('bank_name', $employeeInfo->bank_name) == '13' ? 'selected' : '' }}>China Construction Bank (Malaysia) Berhad</option>
                                                            <option value="14" {{ old('bank_name', $employeeInfo->bank_name) == '14' ? 'selected' : '' }}>CIMB Bank Berhad</option>
                                                            <option value="15" {{ old('bank_name', $employeeInfo->bank_name) == '15' ? 'selected' : '' }}>Citibank Berhad</option>
                                                            <option value="16" {{ old('bank_name', $employeeInfo->bank_name) == '16' ? 'selected' : '' }}>Deutsche Bank (Malaysia) Berhad</option>
                                                            <option value="17" {{ old('bank_name', $employeeInfo->bank_name) == '17' ? 'selected' : '' }}>Finexus Cards Sdn. Bhd.</option>
                                                            <option value="18" {{ old('bank_name', $employeeInfo->bank_name) == '18' ? 'selected' : '' }}>Hong Leong Bank Berhad</option>
                                                            <option value="19" {{ old('bank_name', $employeeInfo->bank_name) == '19' ? 'selected' : '' }}>HSBC Bank Malaysia Berhad</option>
                                                            <option value="20" {{ old('bank_name', $employeeInfo->bank_name) == '20' ? 'selected' : '' }}>Industrial And Commercial Bank of China</option>
                                                            <option value="21" {{ old('bank_name', $employeeInfo->bank_name) == '21' ? 'selected' : '' }}>JP Morgan Chase Bank Berhad</option>
                                                            <option value="22" {{ old('bank_name', $employeeInfo->bank_name) == '22' ? 'selected' : '' }}>Kuwait Finance House (Malaysia) Berhad</option>
                                                            <option value="23" {{ old('bank_name', $employeeInfo->bank_name) == '23' ? 'selected' : '' }}>Maybank Berhad</option>
                                                            <option value="24" {{ old('bank_name', $employeeInfo->bank_name) == '24' ? 'selected' : '' }}>MBSB Bank Berhad</option>
                                                            <option value="25" {{ old('bank_name', $employeeInfo->bank_name) == '25' ? 'selected' : '' }}>Mizuho Bank (Malaysia) Berhad</option>
                                                            <option value="26" {{ old('bank_name', $employeeInfo->bank_name) == '26' ? 'selected' : '' }}>MUFG Bank (Malaysia) Berhad</option>
                                                            <option value="27" {{ old('bank_name', $employeeInfo->bank_name) == '27' ? 'selected' : '' }}>OCBC Bank (Malaysia) Berhad</option>
                                                            <option value="28" {{ old('bank_name', $employeeInfo->bank_name) == '28' ? 'selected' : '' }}>Public Bank Berhad</option>
                                                            <option value="29" {{ old('bank_name', $employeeInfo->bank_name) == '29' ? 'selected' : '' }}>RHB Bank Berhad</option>
                                                            <option value="30" {{ old('bank_name', $employeeInfo->bank_name) == '30' ? 'selected' : '' }}>Standard Chartered Bank Malaysia Berhad</option>
                                                            <option value="31" {{ old('bank_name', $employeeInfo->bank_name) == '31' ? 'selected' : '' }}>Sumitomo Mitsui Banking Corporation</option>
                                                            <option value="32" {{ old('bank_name', $employeeInfo->bank_name) == '32' ? 'selected' : '' }}>Touch n Go eWallet</option>
                                                            <option value="33" {{ old('bank_name', $employeeInfo->bank_name) == '33' ? 'selected' : '' }}>United Overseas Bank Berhad</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">Account Number</label>
                                                    <div class="col-md-9 mx-auto">
                                                        <input type="text" class="form-control border-primary" placeholder="Account Number" name="account_number" id="account_number" value="{{ old('account_number', $employeeInfo->account_number) }}" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">Basic Salary</label>
                                                    <div class="col-md-9 mx-auto">
                                                        <input type="text" class="form-control border-primary" placeholder="Basic Salary" name="basic_salary" id="basic_salary" value="{{ old('basic_salary', $employeeInfo->basic_salary) }}" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <br>
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