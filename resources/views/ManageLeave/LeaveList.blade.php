<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('List of Leave') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Leave</a></div>
            <div class="breadcrumb-item"><a href="{{ route('ListLeave') }}">List Leave</a></div>
        </div>
    </x-slot>

    <div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive dash-social">
                            <table id="datatable" class="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Date</th>
                                        <th>Name</th>
                                        <th>Leave Type</th>
                                        <th>Status</th>
                                        @if(Auth::user()->user_type_id == 2)
                                        <th>Approval</th>
                                        @endif
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $no = 1;
                                    ?>
                                    @foreach($leaveRecords as $list)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ \Carbon\Carbon::parse($list->start_date)->format('d/m/Y') }}</td>
                                        <td>{{$list->employee->name}}</td>
                                        <td>{{$list->leaveType->leave_name}}</td>
                                        @if($list->status == 0)
                                        <?php
                                        $labelstatus = "REJECT";
                                        $labelcolor = "badge badge-danger";
                                        ?>
                                        @elseif ($list->status == 1)
                                        <?php
                                        $labelstatus = "PENDING";
                                        $labelcolor = "badge badge-warning";
                                        ?>
                                        @else ($list->status == 2)
                                        <?php
                                        $labelstatus = "APPROVE";
                                        $labelcolor = "badge badge-success";
                                        ?>
                                        @endif
                                        <td><span class="{{ $labelcolor }}">{{ $labelstatus }}</span></td>
                                        @if(Auth::user()->user_type_id == 2)
                                        <td>
                                            <a href="#" class="mr-2 updateStatus" data-id="{{ $list->id }}"><i class="fas fa-check text-success font-16"></i></a>
                                            <a href="#" href="#" class="mr-2 updateStatusReject" data-id="{{ $list->id }}"><i class="fas fa-times text-danger font-16"></i></a>
                                        </td>
                                        @endif
                                        <td>
                                            <form action="{{ route('deleteLeave', $list->id)  }}" method="POST" class="dltForm">
                                                @method('DELETE')
                                                @csrf
                                                <a href="{{route('viewLeave', ['id' => $list->id])}}" class="mr-2"><i class="fas fa-eye font-16"></i></a>
                                                <a href="{{route('editLeave', ['id' => $list->id])}}" class="mr-2"><i class="fas fa-edit text-primary font-16"></i></a>
                                                @if ($list->status != 2)
                                                <button type="submit" name="submit" class="dltData"><i class="fas fa-trash-alt text-danger font-16"></i></button>
                                                @else
                                                <button type="submit" name="submit" class="dltData" disabled><i class="fas fa-trash-alt text-danger font-16"></i></button>
                                                @endif
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div> <!--end col-->
        </div><!--end row-->
    </div>
</x-app-layout>

<script>
    $(document).ready(function() {
        $(document).on("click", ".dltData", function(event) {
            event.preventDefault(); // Prevent the default form submission

            var form = $(this).closest('.dltForm'); // Find the closest form element

            // Show SweetAlert dialog
            Swal.fire({
                title: 'Are you sure?',
                text: 'You want to delete this data!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#fc544b',
                cancelButtonColor: '$secondary',
                confirmButtonText: 'Yes, delete it!',
                dangerMode: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Your data has been deleted.',
                        icon: 'success',
                        showConfirmButton: true // Show the "OK" button
                    }).then(() => {
                        // Submit the form using AJAX
                        $.ajax({
                            url: form.attr('action'),
                            type: 'POST',
                            data: form.serialize(),
                            success: function(response) {
                                // Handle the success response
                                console.log(response);
                                // You can perform additional actions here after the form is successfully submitted

                                // Refresh the current page
                                window.location.reload();
                            },
                            error: function(xhr) {
                                // Handle the error response
                                console.log(xhr.responseText);
                                // You can display an error message or perform other error handling here
                            }
                        });
                    });
                }
            });
        });

        $(document).on("click", ".updateStatus", function(event) {
            event.preventDefault();
            var id = $(this).data('id');
            updateStatus(id);
        });

        function updateStatus(id) {
            // Show SweetAlert dialog
            Swal.fire({
                title: 'Are you sure?',
                text: 'You want to approve this application!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#6777ef',
                cancelButtonColor: '$secondary',
                confirmButtonText: 'Yes, approve it!',
                dangerMode: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    // Send an AJAX request to update the claim status
                    $.ajax({
                        url: '/updateLeaveStatus/' + id,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            console.log(response);
                            // Perform any necessary actions after updating the status

                            // Show success message
                            Swal.fire({
                                title: 'Success!',
                                text: 'The application has been approved.',
                                icon: 'success',
                                showConfirmButton: true // Show the "OK" button
                            }).then(() => {
                                // Reload the page
                                window.location.reload();
                            });
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                        }
                    });
                }
            });
        }

        $(document).on("click", ".updateStatusReject", function(event) {
            event.preventDefault();
            var id = $(this).data('id');
            updateStatusReject(id);
        });

        function updateStatusReject(id) {
            // Show SweetAlert dialog
            Swal.fire({
                title: 'Are you sure?',
                text: 'You want to reject this application!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#6777ef',
                cancelButtonColor: '$secondary',
                confirmButtonText: 'Yes, reject it!',
                dangerMode: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    // Send an AJAX request to update the claim status
                    $.ajax({
                        url: '/updateLeaveStatusReject/' + id,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            console.log(response);
                            // Perform any necessary actions after updating the status

                            // Show success message
                            Swal.fire({
                                title: 'Success!',
                                text: 'The application has been rejected.',
                                icon: 'success',
                                showConfirmButton: true // Show the "OK" button
                            }).then(() => {
                                // Reload the page
                                window.location.reload();
                            });
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                        }
                    });
                }
            });
        }
    });
</script>