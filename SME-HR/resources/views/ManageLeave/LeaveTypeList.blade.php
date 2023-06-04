<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('List of Leave Type') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Leave</a></div>
            <div class="breadcrumb-item"><a href="{{ route('listLeaveType') }}">List Leave Type</a></div>
        </div>
    </x-slot>

    <div class="row">
        <div class="col-md-12">
            <div class="text-md-right">
                <a href="{{ route('addLeaveType')}}" class="btn btn-primary">Add Leave Type</a>
            </div>
        </div>
    </div>
    <br>

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
                                        <th>Leave Type</th>
                                        <th>Total Days</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $no = 1;
                                    ?>
                                    @foreach($listLeaveType as $list)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{$list->leave_name}}</td>
                                        <td>{{$list->leave_days}}</td>
                                        <td>
                                            <form action="{{ route('deleteLeaveType', $list->id)  }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <a href="{{route('editLeaveType', ['id' => $list->id])}}" class="mr-2"><i class="fas fa-edit text-primary font-16"></i></a>
                                                <button type="submit" name="submit"><i class="fas fa-trash-alt text-danger font-16"></i></button>
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