<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Leave Reports') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Leave</a></div>
            <div class="breadcrumb-item"><a href="">Report</a></div>
        </div>
    </x-slot>

    @if(Auth::user()->user_type_id == 1)
    <div class="row" id="viewLeaveForm">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!--begin::Row-->
                    <div class="card-header">
                        <h1 class="card-title"><i class="fas fa-hospital">&nbsp;&nbsp;&nbsp;</i>Leave Entitlements and Usage Report</h1>
                    </div>
                    <div class="card-content collpase show">
                        <div class="card-body">
                            <form method="GET" class="form form-horizontal" action="" enctype="multipart/form-data">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control">Staff Name</label>
                                                <div class="col-md-9 mx-auto">
                                                    <select name="user_id" class="form-control border-primary" id="user_id">
                                                        <option disabled value="" selected hidden>Select</option>
                                                        @foreach($employeeInfo as $employeeInfos)
                                                        <option value="{{ $employeeInfos->id }}">{{ $employeeInfos->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control">Leave Period</label>
                                                <div class="col-md-9 mx-auto">
                                                    <select name="leave_period" class="form-control border-primary" id="leave_period">
                                                        <option disabled value="" selected hidden>Select</option>
                                                        @php
                                                        $year = date('Y');
                                                        $firstDateOfYear = date('d/m/Y', strtotime("{$year}-01-01"));
                                                        $lastDateOfYear = date('d/m/Y', strtotime("{$year}-12-31"));
                                                        @endphp
                                                        <option>{{ $firstDateOfYear }} - {{ $lastDateOfYear }}</option>
                                                    </select>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <br>
                                <div class="form-actions text-center">
                                    <button class="btn btn-primary float-md-right" id="viewReportBtn" name="search">View</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div><!--end card-body-->
        </div><!--end card-->
    </div> <!--end col-->

    <div class="row" id="reportTableContainer" style="display: none;">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!--begin::Row-->
                    <div class="card-content collpase show">
                        <div class="card-body">
                            <div class="table-responsive dash-social">
                                <table id="datatable" class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Leave Type</th>
                                            <th>Total Days</th>
                                            <th>Leave Balance</th>
                                            <th>Leave Pending</th>
                                            <th>Leave Taken</th>
                                        </tr>
                                    </thead>

                                    <tbody id="reportTableBody">
                                        {{-- Table body content will be dynamically generated --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--end card-body-->
        </div><!--end card-->
    </div> <!--end col-->
    @endif


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!--begin::Row-->
                    <div class="card-content collpase show">
                        <div class="card-body">
                            <div class="table-responsive dash-social">
                                <table id="datatable" class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Leave Type</th>
                                            <th>Total Days</th>
                                            <th>Leave Balance</th>
                                            <th>Leave Pending</th>
                                            <th>Leave Taken</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($reportInfo as $index => $report)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $report->leaveType->leave_name }}</td>
                                            <td>{{ $report->leaveType->leave_days }}</td>
                                            <td>{{ $report->days_remaining }}</td>
                                            <td>{{ $report->leave_pending }}</td>
                                            <td>{{ $report->leave_taken }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--end card-body-->
        </div><!--end card-->
    </div> <!--end col-->

</x-app-layout>

<script>
    $(document).ready(function() {
        $('#viewReportBtn').click(function(e) {
            e.preventDefault(); // Prevent form submission

            var selectedStaff = $('#user_id').val(); // Get the selected staff name

            // If a staff name is selected, show the table container and populate the table
            if (selectedStaff) {
                $('#reportTableContainer').show();

                // AJAX request to fetch data for the selected staff name
                $.ajax({
                    url: '{{ route("viewReport") }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}', // Add the CSRF token
                        user_id: selectedStaff,
                        leave_period: $('#leave_period').val()
                    },
                    success: function(response) {
                        // Assuming the response is a JSON object containing the leave data
                        var reportData = response.reportData;

                        // Iterate over the reportData and populate the table rows
                        var tableBody = $('#reportTableBody');
                        tableBody.empty(); // Clear existing rows

                        $.each(reportData, function(index, report) {
                            var row = '<tr>' +
                                '<td>' + (index + 1) + '</td>' +
                                '<td>' + report.leave_name + '</td>' +
                                '<td>' + report.leave_days + '</td>' +
                                '<td>' + report.dayRemaining + '</td>' +
                                '<td>' + report.leavePending + '</td>' +
                                '<td>' + report.leaveTaken + '</td>' +
                                '</tr>';

                            tableBody.append(row); // Add row to the table
                        });

                    },
                    error: function() {
                        // Handle error case
                    }
                });
            }
        });
    });
</script>