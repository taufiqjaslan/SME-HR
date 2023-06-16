<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Leave Entitlements') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Leave</a></div>
            <div class="breadcrumb-item"><a href="">Entitlements</a></div>
        </div>
    </x-slot>

    @if(Auth::user()->user_type_id == 1)
    <div class="row">
        <div class="col-md-12">
            <div class="text-md-right">
                <a href="{{ route('addEntitlement')}}" class="btn btn-primary">Add Entitlements</a>
            </div>
        </div>
    </div>
    <br>

    <div class="row" id="viewLeaveForm">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!--begin::Row-->
                    <div class="card-header">
                        <h1 class="card-title"><i class="fas fa-hospital">&nbsp;&nbsp;&nbsp;</i>Leave Entitlement</h1>
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
                                    <button class="btn btn-primary float-md-right" id="viewLeaveBtn" name="search">View</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div><!--end card-body-->
        </div><!--end card-->
    </div> <!--end col-->

    <div class="row" id="leaveTableContainer" style="display: none;">
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
                                            <th>Valid From</th>
                                            <th>Valid To</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody id="leaveTableBody">
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
                                            <th>Valid From</th>
                                            <th>Valid To</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($entitlementInfo as $index => $entitlement)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $entitlement->leaveType->leave_name }}</td>
                                            <td>{{ $entitlement->leaveType->leave_days }}</td>
                                            <td>{{ date('d/m/Y', strtotime($entitlement->valid_from)) }}</td>
                                            <td>{{ date('d/m/Y', strtotime($entitlement->valid_to)) }}</td>
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
        $('#viewLeaveBtn').click(function(e) {
            e.preventDefault(); // Prevent form submission

            var selectedStaff = $('#user_id').val(); // Get the selected staff name

            // If a staff name is selected, show the table container and populate the table
            if (selectedStaff) {
                $('#leaveTableContainer').show();

                // AJAX request to fetch data for the selected staff name
                $.ajax({
                    url: '{{ route("viewEntitlement") }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}', // Add the CSRF token
                        user_id: selectedStaff,
                        leave_period: $('#leave_period').val()
                    },
                    success: function(response) {
                        // Assuming the response is a JSON object containing the leave data
                        var leaveData = response.leaveData;

                        // Iterate over the leaveData and populate the table rows
                        var tableBody = $('#leaveTableBody');
                        tableBody.empty(); // Clear existing rows

                        $.each(leaveData, function(index, leave) {
                            var row = '<tr>' +
                                '<td>' + (index + 1) + '</td>' +
                                '<td>' + leave.leave_name + '</td>' +
                                '<td>' + leave.leave_days + '</td>' +
                                '<td>' + formatDate(leave.validFrom) + '</td>' +
                                '<td>' + formatDate(leave.validTo) + '</td>' +
                                '<td>' +
                                '<form class="delete-form">' +
                                '@method("DELETE")' +
                                '@csrf' +
                                '<button type="button" data-id="' + leave.id + '"><i class="fas fa-trash-alt text-danger font-16"></i></button>' +
                                '</form>' +
                                '</td>' +
                                '</tr>';

                            tableBody.append(row); // Add row to the table
                        });

                        // Attach click event to the delete button
                        $('.delete-form button').click(function(e) {
                            e.preventDefault();
                            var id = $(this).data('id');
                            deleteEntitlement(id);
                        });
                    },
                    error: function() {
                        // Handle error case
                    }
                });
            }
        });

        // Function to handle delete action through AJAX
        function deleteEntitlement(id) {
            $.ajax({
                url: '{{ route("deleteEntitlement", ":id") }}'.replace(':id', id),
                type: 'POST',
                data: {
                    _method: 'DELETE',
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    // Handle success case
                    console.log(response);
                    // Refresh the table or update it accordingly
                    refreshTable();
                },
                error: function() {
                    // Handle error case
                }
            });
        }
        // Function to refresh the table
        function refreshTable() {
            var selectedStaff = $('#user_id').val(); // Get the selected staff name

            $.ajax({
                url: '{{ route("viewEntitlement") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}', // Add the CSRF token
                    user_id: selectedStaff,
                    leave_period: $('#leave_period').val()
                },
                success: function(response) {
                    // Assuming the response is a JSON object containing the leave data
                    var leaveData = response.leaveData;

                    var tableBody = $('#leaveTableBody');
                    tableBody.empty(); // Clear existing rows

                    $.each(leaveData, function(index, leave) {
                        var row = '<tr>' +
                            '<td>' + (index + 1) + '</td>' +
                            '<td>' + leave.leave_name + '</td>' +
                            '<td>' + leave.leave_days + '</td>' +
                            '<td>' + leave.validFrom + '</td>' +
                            '<td>' + leave.validTo + '</td>' +
                            '<td>' +
                            '<form class="delete-form">' +
                            '@method("DELETE")' +
                            '@csrf' +
                            '<button type="button" data-id="' + leave.id + '"><i class="fas fa-trash-alt text-danger font-16"></i></button>' +
                            '</form>' +
                            '</td>' +
                            '</tr>';

                        tableBody.append(row); // Add row to the table
                    });

                    // Attach click event to the delete button
                    $('.delete-form button').click(function(e) {
                        e.preventDefault();
                        var id = $(this).data('id');
                        deleteEntitlement(id);
                    });
                },
                error: function() {
                    // Handle error case
                }
            });
        }

        //format date
        function formatDate(dateString) {
            var dateObj = new Date(dateString);
            var day = dateObj.getDate();
            var month = dateObj.getMonth() + 1;
            var year = dateObj.getFullYear();

            return day + '/' + month + '/' + year;
        }
    });
</script>