<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Leave Entitlements') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Leave</a></div>
            <div class="breadcrumb-item"><a href="">Entitlements</a></div>
        </div>
    </x-slot>

    <div class="row">
        <div class="col-md-12">
            <div class="text-md-right">
                <a href="{{ route('addLeaveType')}}" class="btn btn-primary">Add Entitlements</a>
            </div>
        </div>
    </div>
    <br>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!--begin::Row-->
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
                                                <label class="col-md-3 label-control">Leave Period</label>
                                                <div class="col-md-9 mx-auto">
                                                    <select name="leave_period" class="form-control border-primary" id="leave_period">
                                                        <option disabled value="" selected hidden>Select</option>
                                                        @foreach($listData['employee'] as $employees)
                                                        <option value="{{ $employees->id }}">{{ $employees->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <br>
                                <div class="form-actions text-center">
                                    <button class="btn btn-primary float-md-right" id="">View</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div><!--end card-body-->
        </div><!--end card-->
    </div> <!--end col-->

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
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <form action="{{ route('deleteLeave', $list->id)  }}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" name="submit"><i class="fas fa-trash-alt text-danger font-16"></i></button>
                                                </form>
                                            </td>
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