<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Generate Payroll') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Payroll</a></div>
            <div class="breadcrumb-item"><a href="{{ route('listPayslip') }}">Generate Payroll</a></div>
        </div>
    </x-slot>

    <form id="myForm" action="{{ route('savePayslip') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive dash-social">
                            <table id="datatable" class="table">
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
                                                <input name="check[]" type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-{{ $no }}" value="{{$listPayslip->id}}" required>
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
                                        <select name="year" class="form-control border-primary" id="year" required>
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
                                        <select name="month" class="form-control border-primary" id="month" required>
                                            <option disabled value="" selected hidden>Select Month</option>
                                            <option value="1">1 JAN - 31 JAN</option>
                                            <option value="2">1 FEB - 28 FEB</option>
                                            <option value="3">1 MAR - 31 MAR</option>
                                            <option value="4">1 APR - 30 APR</option>
                                            <option value="5">1 MAY - 31 MAY</option>
                                            <option value="6">1 JUN - 30 JUN</option>
                                            <option value="7">1 JUL - 31 JUL</option>
                                            <option value="8">1 AUG - 31 AUG</option>
                                            <option value="9">1 SEP - 30 SEP</option>
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
    </form>
</x-app-layout>


<script>
    $(document).ready(function() {
        $("#generate_button").click(function(event) {
            event.preventDefault(); // Prevent the default form submission

            // Manually trigger form validation
            if ($("#myForm")[0].checkValidity()) {
                // Make Ajax request to check if payroll has been generated
                $.ajax({
                    url: "{{ route('checkPayroll') }}",
                    type: "POST",
                    data: $("#myForm").serialize(),
                    success: function(response) {
                        if (response.generated) {
                            // Payroll already generated
                            Swal.fire({
                                title: 'Payroll Already Generated',
                                text: 'The payroll for the selected month and year has already been generated.',
                                icon: 'error',
                                showConfirmButton: true,
                                confirmButtonColor: '#6777ef',
                            });
                        } else {
                            // Show confirmation dialog
                            Swal.fire({
                                title: 'Are you sure?',
                                text: 'You want to generate this payroll!',
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#6777ef',
                                cancelButtonColor: '#999999',
                                confirmButtonText: 'Yes, generate it!',
                                dangerMode: true,
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Proceed with form submission
                                    Swal.fire({
                                        title: 'Success!',
                                        text: 'Your payroll has been generated.',
                                        icon: 'success',
                                        showConfirmButton: true // Show the "OK" button
                                    }).then(() => {
                                        // Gather the selected salaries and other form data
                                        var selectedSalaries = [];
                                        $("input:checkbox[name=check]:checked").each(function() {
                                            selectedSalaries.push($(this).val());
                                        });
                                        var year = $('#year').val();
                                        var month = $('#month').val();

                                        // Create hidden input fields and populate them with the selected data
                                        $('<input>').attr({
                                            type: 'hidden',
                                            name: 'selected_salaries',
                                            value: JSON.stringify(selectedSalaries)
                                        }).appendTo('#myForm');
                                        $('<input>').attr({
                                            type: 'hidden',
                                            name: 'year',
                                            value: year
                                        }).appendTo('#myForm');
                                        $('<input>').attr({
                                            type: 'hidden',
                                            name: 'month',
                                            value: month
                                        }).appendTo('#myForm');

                                        // Submit the form
                                        $('#myForm').submit();

                                    });
                                }
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        // Handle error case
                        console.log(error);
                    }
                });
            } else {
                // Handle invalid form
                Swal.fire({
                    title: 'Invalid Form',
                    text: 'Please fill in all the required fields.',
                    icon: 'error',
                    showConfirmButton: true,
                    confirmButtonColor: '#6777ef',
                });
            }
        });

        // ... Remaining code ...


    });
</script>