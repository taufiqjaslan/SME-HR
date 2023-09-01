<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('View Payroll') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Payroll</a></div>
            <div class="breadcrumb-item"><a href="{{ route('listGenerated') }}">View Payslip</a></div>
        </div>
    </x-slot>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="form-section"><i class="fas fa-calendar-alt">&nbsp;&nbsp;&nbsp;</i>Payslip Filter</h4>
                    <br>
                    <hr>
                    <br>
                    @if(Auth::user()->user_type_id == 1)
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label class="col-md-3 label-control">Year</label>
                                <div class="col-md-9 mx-auto">
                                    @php
                                    $currentYear = date('Y');
                                    $years = range($currentYear - 3, $currentYear);
                                    $years = array_reverse($years);
                                    @endphp
                                    <select name="year" class="form-control filter border-primary" id="year_filter">
                                        <option disabled value="" selected hidden>Select Year</option>
                                        @foreach ($years as $year)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label class="col-md-3 label-control">Month</label>
                                <div class="col-md-9 mx-auto">
                                    <select name="month" class="form-control filter border-primary" id="month_filter">
                                        <option disabled value="" selected hidden>Select Month</option>
                                        <option value="1 JAN - 31 JAN">1 JAN - 31 JAN</option>
                                        <option value="1 FEB - 28 FEB">1 FEB - 28 FEB</option>
                                        <option value="1 MAC - 31 MAC">1 MAC - 31 MAC</option>
                                        <option value="1 APR - 30 APR">1 APR - 30 APR</option>
                                        <option value="1 MAY - 31 MAY">1 MAY - 31 MAY</option>
                                        <option value="1 JUNE - 30 JUNE">1 JUNE - 30 JUNE</option>
                                        <option value="1 JULY - 31 JULY">1 JULY - 31 JULY</option>
                                        <option value="1 AUG - 31 AUG">1 AUG - 31 AUG</option>
                                        <option value="1 SEPT - 30 SEPT">1 SEPT - 30 SEPT</option>
                                        <option value="1 OCT - 31 OCT">1 OCT - 31 OCT</option>
                                        <option value="1 NOV - 30 NOV">1 NOV - 30 NOV</option>
                                        <option value="1 DEC - 31 DEC">1 DEC - 31 DEC</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label class="col-md-3 label-control">Name</label>
                                <div class="col-md-9 mx-auto">
                                    <select name="user_id" class="form-control filter border-primary" id="name_filter">
                                        <option disabled value="" selected hidden>Select Name</option>
                                        @foreach($employeeInfo as $employees)
                                        <option value="{{ $employees->name }}">{{ $employees->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if(Auth::user()->user_type_id != 1)
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-md-3 label-control">Year</label>
                                <div class="col-md-9 mx-auto">
                                    @php
                                    $currentYear = date('Y');
                                    $years = range($currentYear - 3, $currentYear);
                                    $years = array_reverse($years);
                                    @endphp
                                    <select name="year" class="form-control filter border-primary" id="year_filter">
                                        <option disabled value="" selected hidden>Select Year</option>
                                        @foreach ($years as $year)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-md-3 label-control">Month</label>
                                <div class="col-md-9 mx-auto">
                                    <select name="month" class="form-control filter border-primary" id="month_filter">
                                        <option disabled value="" selected hidden>Select Month</option>
                                        <option value="1 JAN - 31 JAN">1 JAN - 31 JAN</option>
                                        <option value="1 FEB - 28 FEB">1 FEB - 28 FEB</option>
                                        <option value="1 MAC - 31 MAC">1 MAC - 31 MAC</option>
                                        <option value="1 APR - 30 APR">1 APR - 30 APR</option>
                                        <option value="1 MAY - 31 MAY">1 MAY - 31 MAY</option>
                                        <option value="1 JUNE - 30 JUNE">1 JUNE - 30 JUNE</option>
                                        <option value="1 JULY - 31 JULY">1 JULY - 31 JULY</option>
                                        <option value="1 AUG - 31 AUG">1 AUG - 31 AUG</option>
                                        <option value="1 SEPT - 30 SEPT">1 SEPT - 30 SEPT</option>
                                        <option value="1 OCT - 31 OCT">1 OCT - 31 OCT</option>
                                        <option value="1 NOV - 30 NOV">1 NOV - 30 NOV</option>
                                        <option value="1 DEC - 31 DEC">1 DEC - 31 DEC</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <br>
                    <hr>
                    <br>
                    <div class="form-actions text-center">
                        <button class="btn btn-primary float-md-right" id="kt_reset">
                            <i class="fa fa-close"></i>&nbsp;&nbsp;Reset</button>
                    </div>
                </div><!--end card-body-->
            </div><!--end card-->
        </div> <!--end col-->
    </div><!--end row-->

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
                                    <th>Identification ID</th>
                                    <th>Basic Salary</th>
                                    <th>Year</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $no = 1;
                                ?>
                                @foreach($payslipInfo as $viewPayslips)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $viewPayslips->employee->name }}</td>
                                    <td>{{ $viewPayslips->employee->ic }}</td>
                                    <td>{{$viewPayslips->basic_salary}}</td>
                                    <td>{{$viewPayslips->year}}</td>
                                    <td>
                                        <?php
                                        $month = $viewPayslips->month;
                                        $monthRanges = [
                                            '1' => '1 JAN - 31 JAN',
                                            '2' => '1 FEB - 28 FEB',
                                            '3' => '1 MAC - 31 MAC',
                                            '4' => '1 APR - 30 APR',
                                            '5' => '1 MAY - 31 MAY',
                                            '6' => '1 JUNE - 30 JUN',
                                            '7' => '1 JULY - 31 JULY',
                                            '8' => '1 AUG - 31 AUG',
                                            '9' => '1 SEPT - 30 SEPT',
                                            '10' => '1 OCT - 31 OCT',
                                            '11' => '1 NOV - 30 NOV',
                                            '12' => '1 DEC - 31 DEC',
                                        ];
                                        ?>
                                        {{ $monthRanges[$month] }}
                                    </td>
                                    <td>
                                        <a href="{{route('payslipReceipt', ['id' => $viewPayslips->id])}}" class="mr-2"><i class="fas fa-eye font-16"></i></a>
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

</x-app-layout>



<script>
    $(document).ready(function() {
        // Check if DataTable is already initialized on the table
        if ($.fn.DataTable.isDataTable('#datatable')) {
            // If DataTable is already initialized, destroy it first
            $('#datatable').DataTable().destroy();
        }

        // DataTable initialization
        var table = $('#datatable').DataTable({
            responsive: true,
            pagingType: 'full_numbers',
        });

        // Filter function
        function filter() {
            // Clear any existing search filters
            table.search('').columns().search('').draw();

            $('#year_filter').on('change', function() {
                var year = $(this).val();
                if (year !== "") {
                    console.log("Selected Year:", year);
                    table.column(4).search(year);
                } else {
                    table.column(4).search('');
                }
                table.draw();
            });

            $('#month_filter').on('change', function() {
                var month = $(this).val();
                if (month !== "") {
                    console.log("Selected Month:", month);
                    table.column(5).search(month);
                } else {
                    table.column(5).search('');
                }
                table.draw();
            });

            $('#name_filter').on('change', function() {
                var userId = $(this).val();
                if (userId !== "") {
                    console.log("Selected User ID:", userId);
                    table.column(1).search(userId, false, false);
                } else {
                    table.column(1).search('');
                }
                table.draw();
            });
        }

        // Reset function
        $('#kt_reset').on('click', function(e) {
            e.preventDefault();
            $('.filter').val(''); // Clear the filter values

            // Clear any existing search filters
            table.search('').columns().search('').draw();
        });

        // Call the filter function initially
        filter();
    });
</script>