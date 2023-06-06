<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Apply Leave') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Leave</a></div>
            <div class="breadcrumb-item"><a href="{{ route('ApplyLeave') }}">Apply Leave</a></div>
        </div>
    </x-slot>


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!--begin::Row-->
                    <div class="card-header">
                        <h1 class="card-title"><i class="fas fa-hospital">&nbsp;&nbsp;&nbsp;</i>Leave Information</h1>
                    </div>
                    <div class="card-content collpase show">
                        <div class="card-body">
                            <form method="POST" class="form form-horizontal" action="{{route('StoreLeave')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control">Staff Name</label>
                                                <div class="col-md-9 mx-auto">
                                                    <select name="user_id" class="form-control border-primary" id="user_id">
                                                        <option disabled value="" selected hidden>Select</option>
                                                        @foreach($listData['employee'] as $employees)
                                                        <option value="{{ $employees->id }}">{{ $employees->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control">Leave Type</label>
                                                <div class="col-md-9 mx-auto">
                                                    <select name="leave_type_id" class="form-control border-primary" id="leave_type">
                                                        <option disabled value="" selected hidden>Select Leave Type</option>
                                                        @foreach($listData['leaveType'] as $leaveTypes)
                                                        <option value="{{ $leaveTypes->id }}">{{ $leaveTypes->leave_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control">Start Date</label>
                                                <div class="col-md-9 mx-auto">
                                                    <input type="date" class="form-control border-primary" placeholder="" name="start_date" id="start_date">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control">To Date</label>
                                                <div class="col-md-9 mx-auto">
                                                    <input type="date" class="form-control border-primary" placeholder="" name="end_date" id="end_date">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6" id="">
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control">Total Day</label>
                                                <div class="col-md-9 mx-auto">
                                                    <input class="form-control border-primary" type="text" id="total_day" name="total_day" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control">Leave Details</label>
                                                <div class="col-md-9 mx-auto">
                                                    <textarea rows="6" class="form-control border-primary" name="detail" placeholder="Leave Details" id="detail"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6" id="attachment" hidden>
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control">Attachment File</label>
                                                <div class="col-md-9 mx-auto">
                                                    <input type="file" id="attachment" name="attachment" class="form-control border-primary" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <br>
                                <div class="form-actions text-center">
                                    <button class="btn btn-primary float-md-right" id="">Apply</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div><!--end card-body-->
        </div><!--end card-->
    </div>


</x-app-layout>

<script>
    //utk show date dgn time
    $('document').ready(function() {
        $('#leave_type').change(function() {
            var select_status = $('#leave_type').val();

            if (select_status == "2") {
                $('#attachment').removeAttr('hidden');
                $('#attachment input').attr('required', true);

            } else {
                $('#attachment').attr('hidden', true);
                $('#attachment input').removeAttr('required');
            }
        })
    })

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