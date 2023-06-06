<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('View Leave') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Leave</a></div>
            <div class="breadcrumb-item"><a href="">View Leave</a></div>
        </div>
    </x-slot>

    <div class="row">
        <div class="col-md-12">
            <div class="text-md-right">
                <a href="{{route('ListLeave')}}"><button class="btn btn-primary float-md-right"><i class="fas fa-chevron-left"></i></button></a>
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
                                <h1 class="card-title"><i class="fas fa-hospital">&nbsp;&nbsp;&nbsp;</i>Leave Information</h1>
                            </div>
                            <div class="card-content collpase show">
                                <div class="card-body">
                                    <form method="POST" class="form form-horizontal" action="" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control">Staff Name</label>
                                                        <div class="col-md-9 mx-auto">
                                                            <select name="user_id" class="form-control border-primary" id="user_id" readonly>
                                                                <option disabled value="" selected hidden>Select</option>
                                                                @foreach ($employeeInfo as $employeeInfos)
                                                                <option value="{{ $employeeInfos->id }}" {{ old('user_id', $leaveInfo->user_id) == $employeeInfos->id ? 'selected' : '' }}>
                                                                    {{ $employeeInfos->name }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control">Date</label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input type="date" class="form-control border-primary" name="start_date" id="start_date" value="{{ old('start_date', $leaveInfo->start_date) }}" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control">To Date</label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input type="date" class="form-control border-primary" placeholder="" name="end_date" id="end_date" value="{{ old('end_date', $leaveInfo->end_date) }}" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control">Leave Type</label>
                                                        <div class="col-md-9 mx-auto">
                                                            <select name="leave_type_id" class="form-control border-primary" id="leave_type" readonly>
                                                                <option disabled value="" selected hidden>Select Leave Type</option>
                                                                @foreach ($leaveTypeInfo as $leaveType)
                                                                <option value="{{ $leaveType->id }}" {{ old('leave_type_id', $leaveInfo->leave_type_id) == $leaveType->id ? 'selected' : '' }}>
                                                                    {{ $leaveType->leave_name }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6" id="">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control">Total Day</label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input class="form-control border-primary" type="text" id="total_day" name="total_day" value="{{ old('total_day', $leaveInfo->total_day) }}" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control">Leave Details</label>
                                                        <div class="col-md-9 mx-auto">
                                                            <textarea rows="6" class="form-control border-primary" name="detail" placeholder="Leave Details" id="detail" readonly>{{ old('detail', $leaveInfo->detail) }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6" id="attachment" @if ($leaveInfo->leave_type_id != 2) hidden @endif>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control">Attachment File</label>
                                                        <div class="col-md-9 mx-auto">
                                                            <a href="{{ asset('uploads/attachment/'.$leaveInfo->attachment) }}" target="_blank">
                                                                @if (pathinfo($leaveInfo->attachment, PATHINFO_EXTENSION) == 'pdf')
                                                                <embed src="{{ asset('uploads/attachment/'.$leaveInfo->attachment) }}" width="400px" height="400px" type="application/pdf">
                                                                @else
                                                                <img src="{{ asset('uploads/attachment/'.$leaveInfo->attachment) }}" width="300px" height="300px" alt="" class="img-fluid">
                                                                @endif
                                                            </a>
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