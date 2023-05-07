<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Employee Details') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Employee</a></div>
            <div class="breadcrumb-item"><a href="">Employee Details</a></div>
        </div>
    </x-slot>

    <div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{route('ListEmployee')}}"><button class="btn btn-primary float-md-right"><i class="fas fa-chevron-left"></i></button></a>
                        <!--begin::Tab-->
                        <div class="tab-pane show active px-7" id="kt_user_edit_tab_1" role="tabpanel">
                            <!--begin::Row-->
                            <div class="card-header">
                                <h1 class="card-title"><i class="fas fa-user">&nbsp;&nbsp;&nbsp;</i>Employee Information</h1>
                            </div>
                            <div class="card-content collpase show">
                                <div class="card-body">
                                    <form method="POST" class="form form-horizontal" action="{{route('updateEmployee' , ['id' => $employeeInfo->id])}}">
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
                                                        <select name="position_id" class="form-control border-primary" id="position_id" value="{{ old('position_id', $employeeInfo->position_id) }}" disabled>
                                                            <option disabled value="" selected hidden>Select</option>
                                                            <option value="1">Female</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">User Type</label>
                                                    <div class="col-md-9 mx-auto">
                                                        <select name="user_type" class="form-control border-primary" id="user_type" value="{{ old('user_type', $employeeInfo->user_type) }}" disabled>
                                                            <option disabled value="" selected hidden>Select</option>
                                                            <option value="1">Female</option>
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
                                                        <select name="gender" class="form-control border-primary" id="gender" value="{{ old('gender', $employeeInfo->gender) }}" disabled>
                                                            <option disabled value="" selected hidden>Select</option>
                                                            <option value="1">Female</option>
                                                            <option value="2">Male</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">Address</label>
                                                    <div class="col-md-9 mx-auto">
                                                        <textarea rows="6" class="form-control border-primary" name="address" placeholder="Address" id="address" value="{{ old('address', $employeeInfo->address) }}" disabled></textarea>
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