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
                                        $labelstatus = "Reject";
                                        $labelcolor = "badge badge-danger";
                                        ?>
                                        @elseif ($list->status == 1)
                                        <?php
                                        $labelstatus = "Pending";
                                        $labelcolor = "badge badge-warning";
                                        ?>
                                        @else ($list->status == 2)
                                        <?php
                                        $labelstatus = "Approve";
                                        $labelcolor = "badge badge-success";
                                        ?>
                                        @endif
                                        <td><span class="{{ $labelcolor }}">{{ $labelstatus }}</span></td>
                                        <td>
                                            <form action="{{ route('deleteLeave', $list->id)  }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <a href="{{route('viewLeave', ['id' => $list->id])}}" class="mr-2"><i class="fas fa-eye font-16"></i></a>
                                                <a href="{{route('editLeave', ['id' => $list->id])}}" class="mr-2"><i class="fas fa-edit text-primary font-16"></i></a>
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