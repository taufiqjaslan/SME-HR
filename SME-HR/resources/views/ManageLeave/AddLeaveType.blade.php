<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Add Leave Type') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Leave</a></div>
            <div class="breadcrumb-item"><a href="{{ route('addLeaveType') }}">Add Leave Type</a></div>
        </div>
    </x-slot>

    <div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <!--begin::Tab-->
                        <div class="tab-pane show active px-7" id="kt_user_edit_tab_1" role="tabpanel">
                            <!--begin::Row-->
                            <div class="card-header">
                                <h1 class="card-title"><i class="fas fa-hospital">&nbsp;&nbsp;&nbsp;</i>Leave Type Information</h1>
                            </div>
                            <hr>
                            <div class="card-content collpase show">
                                <div class="card-body">
                                    <form method="POST" class="form form-horizontal" action="{{route('storeLeaveType')}}" enctype="multipart/form-data" id="addForm">
                                        @csrf
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control">Leave Type Name</label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input type="text" class="form-control border-primary" placeholder="Leave Type Name" name="leave_name" id="leave_name" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control">Total Days</label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input type="number" class="form-control border-primary" placeholder="Total Days" name="leave_days" id="leave_days" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <br>
                                        <div class="form-actions text-center">
                                            <button class="btn btn-primary float-md-right" id="addbutton">Save</button>
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
    $(document).ready(function() {
        $("#addbutton").click(function(event) {
            event.preventDefault(); // Prevent the default form submission

            // Manually trigger form validation
            if ($("#addForm")[0].checkValidity()) {
                // Show SweetAlert dialog
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You want to add this data!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#6777ef',
                    cancelButtonColor: '$secondary',
                    confirmButtonText: 'Yes, add it!',
                    dangerMode: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Show success message
                        Swal.fire({
                            title: 'Success!',
                            text: 'Your data has been saved.',
                            icon: 'success',
                            showConfirmButton: true // Show the "OK" button
                        }).then(() => {
                            // Submit the form here
                            $("#addForm").submit();
                        });
                    }
                });
            } else {
                // Handle invalid form
                Swal.fire({
                    title: 'Invalid Form',
                    text: 'Please fill in all the required fields.',
                    icon: 'error',
                    showConfirmButton: true, // Show the "OK" button
                    confirmButtonColor: '#6777ef',
                });
            }
        });
        // Listen for changes in the input field
        $('#leave_days').on('input', function() {
            // Get the entered value
            var leaveDays = $(this).val();

            // Check if the value is less than 0
            if (leaveDays < 0) {
                // Set the input value to 0
                $(this).val(0);
            }
        });
    });
</script>