<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <!-- {{ __('Dashboard') }} -->
            Add Activity Proposal
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <!--begin::Tab-->
                            <div class="tab-pane show active px-7" id="kt_user_edit_tab_1" role="tabpanel">
                                <!--begin::Row-->
                                <div class="card-header">
                                    <h2 class="card-title">Employee Information</h2>
                                </div>
                                <div class="card-content collpase show">
                                    <div class="card-body">
                                        <form class="form form-horizontal" action="{{route('store')}}" method="POST">
                                            @csrf
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="fas fa-file-alt">&nbsp;&nbsp;&nbsp;</i>Employee Details</h4>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control">Full Name</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <input type="text" class="form-control border-primary" placeholder="Full Name" id="name" name="name">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control">Username</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <input type="text" class="form-control border-primary" placeholder="Username" name="username" id="username">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control">Identification Number</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <input type="text" class="form-control border-primary" placeholder="Identification Number" name="ic" id="ic">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control">Phone Number</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <input type="text" class="form-control border-primary" placeholder="Phone Number" name="phone_number" id="phone_number">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control">Email</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <input class="form-control border-primary" type="email" placeholder="Email" name="email" id="email">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control">Password</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <input class="form-control border-primary" type="password" placeholder="Password" name="password" id="password">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control">Confirmation Password</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <input class="form-control border-primary" type="password" placeholder="Confirm Password" name="password" id="password">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <h4 class="form-section"><i class="fas fa-calendar-alt">&nbsp;&nbsp;&nbsp;</i>Employement Details</h4>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control">Position</label>
                                                        <div class="col-md-9 mx-auto">
                                                            <select name="position_id" class="form-control border-primary" id="position_id">
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
                                                            <select name="user_type" class="form-control border-primary" id="user_type">
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
                                                            <input type="date" class="form-control border-primary" placeholder="Start Date" id="start_date" name="start_date">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control">End Date</label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input type="date" class="form-control border-primary" placeholder="" name="end_date" id="end_date">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control">Gender</label>
                                                        <div class="col-md-9 mx-auto">
                                                            <select name="user_type" class="form-control border-primary" id="user_type">
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
                                                            <textarea rows="6" class="form-control border-primary" name="address" placeholder="Address" id="address"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="form-actions text-center">
                                                <button class="btn btn-primary float-md-right" type="submit">
                                                    <i class="fa fa-dot-circle-o"></i>Save</button>&nbsp;&nbsp;
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div> <!--end col-->
        </div><!--end row-->
    </div>

</x-app-layout>