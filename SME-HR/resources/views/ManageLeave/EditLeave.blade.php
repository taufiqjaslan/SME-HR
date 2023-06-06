<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Update Leave') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Leave</a></div>
            <div class="breadcrumb-item"><a href="">Update Leave</a></div>
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
                                    <form method="POST" class="form form-horizontal" action="{{route('updateLeave' , ['id' => $leaveInfo->id])}}" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control">Staff Name</label>
                                                        <div class="col-md-9 mx-auto">
                                                            <select name="user_id" class="form-control border-primary" id="user_id">
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
                                                            <input type="date" class="form-control border-primary" name="start_date" id="start_date" value="{{ old('start_date', $leaveInfo->start_date) }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control">To Date</label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input type="date" class="form-control border-primary" placeholder="" name="end_date" id="end_date" value="{{ old('end_date', $leaveInfo->end_date) }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control">Leave Type</label>
                                                        <div class="col-md-9 mx-auto">
                                                            <select name="leave_type_id" class="form-control border-primary" id="leave_type">
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
                                                            <textarea rows="6" class="form-control border-primary" name="detail" placeholder="Leave Details" id="detail">{{ old('detail', $leaveInfo->detail) }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
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
                                                            <input type="file" id="attachment_file" name="attachment" value="{{ old('attachment', $leaveInfo->attachment) }}">
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
                                                            <input type="file" id="attachment_file" name="attachment" value="{{ old('attachment', $leaveInfo->attachment) }}">
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
                    </div>
                </div><!--end card-body-->
            </div><!--end card-->
        </div> <!--end col-->
    </div>

</x-app-layout>

<script>
    // Get the start date and end date input fields
    var startDateInput = document.getElementById('start_date');
    var endDateInput = document.getElementById('end_date');

    // Add event listener to both input fields
    startDateInput.addEventListener('change', calculateTotalDays);
    endDateInput.addEventListener('change', calculateTotalDays);

    // Function to calculate the total number of days and display it in the "Total Day" input
    function calculateTotalDays() {
        var startDate = new Date(startDateInput.value);
        var endDate = new Date(endDateInput.value);

        // Calculate the time difference in milliseconds
        var timeDifference = endDate.getTime() - startDate.getTime();

        // Calculate the number of days
        var totalDays = Math.floor(timeDifference / (1000 * 60 * 60 * 24)) + 1; // Add 1 to include both start and end dates

        // Calculate the number of weekends between start and end dates
        var weekends = 0;
        var currentDay = startDate;

        while (currentDay <= endDate) {
            var dayOfWeek = currentDay.getDay();
            if (dayOfWeek === 0 || dayOfWeek === 6) {
                weekends++;
            }
            currentDay.setDate(currentDay.getDate() + 1);
        }

        // Subtract the weekends from the total days
        var weekdays = totalDays - weekends;

        // Set the calculated weekdays value to the "Total Day" input field
        var totalDayInput = document.getElementById('total_day');
        totalDayInput.value = weekdays;
    }
</script>