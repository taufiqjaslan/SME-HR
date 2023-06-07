<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Generate Payroll') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Payroll</a></div>
            <div class="breadcrumb-item"><a href="{{ route('listPayslip') }}">Generate Payroll</a></div>
        </div>
    </x-slot>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive dash-social">
                        <table class="table table-striped" id="table-2">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center">
                                        <div class="custom-checkbox custom-control">
                                            <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad" class="custom-control-input" id="checkbox-all">
                                            <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                                        </div>
                                    </th>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Basic Salary</th>
                                    <th>KWSP</th>
                                    <th>SOCSO</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $no = 1;
                                ?>
                                @foreach($payslipInfo as $listPayslip)
                                <tr>
                                    <td>
                                        <div class="custom-checkbox custom-control">
                                            <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-{{ $no }}">
                                            <label for="checkbox-{{ $no }}" class="custom-control-label">&nbsp;</label>
                                        </div>
                                    </td>
                                    <td>{{ $no++ }}</td>
                                    <td>{{$listPayslip->employee->name}}</td>
                                    <td>{{$listPayslip->basic_salary}}</td>
                                    <td>{{$listPayslip->kwsp_staff}}</td>
                                    <td>{{$listPayslip->socso_staff}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div><!--end card-body-->
            </div><!--end card-->
        </div> <!--end col-->
    </div><!--end row-->


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="form-section"><i class="fas fa-calendar-alt">&nbsp;&nbsp;&nbsp;</i>Generate Payslip</h4>
                    <br>
                    <hr>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-md-3 label-control">Year</label>
                                <div class="col-md-9 mx-auto">
                                    @php
                                    $currentYear = date('Y');
                                    $years = range($currentYear - 2, $currentYear);
                                    $years = array_reverse($years);
                                    @endphp
                                    <select name="year" class="form-control border-primary" id="year">
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
                                    <select name="month" class="form-control border-primary" id="month">
                                        <option disabled value="" selected hidden>Select Month</option>
                                        <option value="1">1 JAN - 31 JAN</option>
                                        <option value="2">1 FEB - 28 FEB</option>
                                        <option value="3">1 MAC - 31 MAC</option>
                                        <option value="4">1 APR - 30 APR</option>
                                        <option value="5">1 MAY - 31 MAY</option>
                                        <option value="6">1 JUNE - 30 JUN</option>
                                        <option value="7">1 JULY - 31 JULY</option>
                                        <option value="8">1 AUG - 31 AUG</option>
                                        <option value="9">1 SEPT - 30 SEPT</option>
                                        <option value="10">1 OCT - 31 OCT</option>
                                        <option value="11">1 NOV - 30 NOV</option>
                                        <option value="12">1 DEC - 31 DEC</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <hr>
                    <br>
                    <div class="form-actions text-center">
                        <button class="btn btn-primary float-md-right" id="generate_button">Generate</button>
                    </div>
                </div><!--end card-body-->
            </div><!--end card-->
        </div> <!--end col-->
    </div><!--end row-->
</x-app-layout>

@push('scripts')
<script>
    $(document).ready(function() {
        // Add event listener to the Generate button
        $('#generate_button').click(function() {
            // Retrieve selected checkboxes
            var selectedCheckboxes = $('input[type="checkbox"]:checked');

            // Retrieve year and month values
            var year = $('#year').val();
            var month = $('#month').val();

            // Prepare data for sending to the server
            var data = {
                checkboxes: [],
                year: year,
                month: month
            };

            // Loop through selected checkboxes and add their values to the data array
            selectedCheckboxes.each(function() {
                data.checkboxes.push($(this).attr('id'));
            });

            // Make AJAX request to the server
            $.ajax({
                url: '/save-payslip',
                type: 'POST',
                data: data,
                success: function(response) {
                    // Handle the server response here
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    // Handle errors here
                    console.log(error);
                }
            });
        });
    });
</script>
@endpush