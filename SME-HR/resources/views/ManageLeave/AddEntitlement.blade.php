<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Add Leave Entitlements') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Leave</a></div>
            <div class="breadcrumb-item"><a href="{{ route('addEntitlement')}}">Add Entitlements</a></div>
        </div>
    </x-slot>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!--begin::Row-->
                    <div class="card-header">
                        <h1 class="card-title"><i class="fas fa-hospital">&nbsp;&nbsp;&nbsp;</i>Leave Entitlement Information</h1>
                    </div>
                    <div class="card-content collpase show">
                        <div class="card-body">
                            <form method="POST" class="form form-horizontal" action="{{route('storeEntitlement')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control">Staff Name</label>
                                                <div class="col-md-9 mx-auto">
                                                    <select name="user_id" class="form-control border-primary" id="user_id">
                                                        <option disabled value="" selected hidden>Select Staff Name</option>
                                                        @foreach($employeeInfo as $employeeInfos)
                                                        <option value="{{ $employeeInfos->id }}">{{ $employeeInfos->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control">Leave Type</label>
                                                <div class="col-md-9 mx-auto">
                                                    <select name="leave_type_id" class="form-control border-primary" id="leave_type_id">
                                                        <option disabled value="" selected hidden>Select Leave Type</option>
                                                        @foreach($leaveType as $leaveTypeInfos)
                                                        <option value="{{ $leaveTypeInfos->id }}">{{ $leaveTypeInfos->leave_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control">Valid From</label>
                                                <div class="col-md-9 mx-auto">
                                                    <select name="valid_from" class="form-control border-primary" id="valid_from">
                                                        <option disabled value="" selected hidden>Select</option>
                                                        @php
                                                        $year = date('Y');
                                                        $firstDateOfYear = date('Y/m/d', strtotime("{$year}-01-01"));
                                                        @endphp
                                                        <option value="{{ $firstDateOfYear }}">{{ $firstDateOfYear }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control">Valid To</label>
                                                <div class="col-md-9 mx-auto">
                                                    <select name="valid_to" class="form-control border-primary" id="valid_to">
                                                        <option disabled value="" selected hidden>Select</option>
                                                        @php
                                                        $year = date('Y');
                                                        $lastDateOfYear = date('Y/m/d', strtotime("{$year}-12-31"));
                                                        @endphp
                                                        <option value="{{ $lastDateOfYear }}">{{ $lastDateOfYear }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <br>
                                <div class="form-actions text-center">
                                    <button class="btn btn-primary float-md-right" id="">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div><!--end card-body-->
        </div><!--end card-->
    </div> <!--end col-->

</x-app-layout>