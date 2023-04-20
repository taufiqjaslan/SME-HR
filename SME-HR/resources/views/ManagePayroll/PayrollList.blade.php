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
                                        <th>BASIC SALARY</th>
                                        <th>KWSP</th>
                                        <th>SOCSO</th>
                                        <th>Zakat</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $no = 1;
                                    ?>
                                    @foreach($payrollRecords as $list)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{$list->employee->name}}</td>
                                        <td>@if ($list->salaryType)
                                            {{$list->salaryType->amount}}
                                            @else
                                            N/A
                                            @endif
                                        </td>
                                        <td>{{$list->kwsp_staff}}</td>
                                        <td>{{$list->socso_staff}}</td>
                                        <td>{{$list->zakat}}</td>
                                        <td>
                                            <form action="{{ route('deleteEmployee', $list->id) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <a href="{{route('viewEmployee', ['id' => $list->id])}}" class="mr-2"><i class="fas fa-eye font-16"></i></a>
                                                <a href="{{route('editEmployee', ['id' => $list->id])}}" class="mr-2"><i class="fas fa-edit text-primary font-16"></i></a>
                                                <button type="submit" name="deleteEmployee"><i class="fas fa-trash-alt text-danger font-16"></i></button>
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