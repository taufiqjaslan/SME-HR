<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('List of Payroll') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Payroll</a></div>
            <div class="breadcrumb-item"><a href="{{ route('ListPayroll') }}">List Payroll</a></div>
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
                                        <th>Basic Salary</th>
                                        <th>KWSP</th>
                                        <th>SOCSO</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $no = 1;
                                    ?>
                                    @foreach($payrollInfo as $payroll)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $payroll->employee->name }}</td>
                                        <td>{{$payroll->employee->basic_salary}}</td>
                                        <td>{{$payroll->kwsp_staff}}</td>
                                        <td>{{$payroll->socso_staff}}</td>
                                        <td>
                                            <a href="{{route('viewPayroll', ['id' => $payroll->id])}}" class="mr-2"><i class="fas fa-eye font-16"></i></a>
                                            <a href="{{route('editPayroll', ['id' => $payroll->id])}}" class="mr-2"><i class="fas fa-edit text-primary font-16"></i></a>
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