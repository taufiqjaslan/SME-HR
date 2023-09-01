<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('List of Employee') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Employee</a></div>
            <div class="breadcrumb-item"><a href="{{ route('ListEmployee') }}">List Employee</a></div>
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
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Position</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $no = 1;
                                    ?>
                                    @foreach($listEmployee as $list)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{$list->name}}</td>
                                        <td>{{$list->email}}</td>
                                        <td>{{$list->position->position_name}}</td>
                                        @if($list->status == 0)
                                        <?php
                                        $labelstatus = "Inactive";
                                        $labelcolor = "badge badge-danger";
                                        ?>
                                        @elseif ($list->status == 1)
                                        <?php
                                        $labelstatus = "Active";
                                        $labelcolor = "badge badge-success";
                                        ?>
                                        @endif
                                        <td><span class="{{ $labelcolor }}">{{ $labelstatus }}</span></td>
                                        <td>
                                            <form action="{{ route('deleteEmployee', $list->id)  }}" method="POST" class="dltForm">
                                                @method('DELETE')
                                                @csrf
                                                <a href="{{route('viewEmployee', ['id' => $list->id])}}" class="mr-2"><i class="fas fa-eye font-16"></i></a>
                                                @if(Auth::user()->user_type_id == 1)
                                                <a href="{{route('editEmployee', ['id' => $list->id])}}" class="mr-2"><i class="fas fa-edit text-primary font-16"></i></a>
                                                <button type="submit" name="submit" class="dltData"><i class="fas fa-trash-alt text-danger font-16"></i></button>
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
    });
</script>