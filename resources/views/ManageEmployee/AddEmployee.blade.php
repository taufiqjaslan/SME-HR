<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Add Employee') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Employee</a></div>
            <div class="breadcrumb-item"><a href="{{ route('CreateEmployee') }}">Add Employee</a></div>
        </div>
    </x-slot>

    <div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <!--begin::Tab-->
                        <div class="tab-pane show active px-7" id="kt_user_edit_tab_1" role="tabpanel">
                            <!--begin::Row-->
                            <div class="card-header">
                                <h1 class="card-title"><i class="fas fa-user">&nbsp;&nbsp;&nbsp;</i>Employee Information</h1>
                            </div>
                            <hr>
                            <div class="card-content collpase show">
                                <div class="card-body">
                                    <form method="POST" class="form form-horizontal" action="{{route('RegisterEmployee')}}" id="registerEmployee">
                                        @csrf
                                        <div class="form-body">
                                            <h4 class="form-section"><i class="fas fa-file-alt">&nbsp;&nbsp;&nbsp;</i>Employee Details</h4>
                                            <br>
                                            <hr>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control">Full Name</label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input type="text" class="form-control border-primary" placeholder="Full Name" id="name" name="name" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control">Username</label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input type="text" class="form-control border-primary" placeholder="Username" name="username" id="username" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control">Identification Number</label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input type="text" class="form-control border-primary" placeholder="Identification Number" name="ic" id="ic" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control">Phone Number</label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input type="text" class="form-control border-primary" placeholder="Phone Number" name="phone_number" id="phone_number" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control">Email</label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input class="form-control border-primary" type="email" placeholder="Email" name="email" id="email" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control">Password</label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input class="form-control border-primary" type="password" placeholder="Password" name="password" id="password" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <h4 class="form-section"><i class="fas fa-calendar-alt">&nbsp;&nbsp;&nbsp;</i>Employement Details</h4>
                                        <br>
                                        <hr>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">Position</label>
                                                    <div class="col-md-9 mx-auto">
                                                        <select name="position_id" class="form-control border-primary" id="position_id" required>
                                                            <option disabled value="" selected hidden>Select</option>
                                                            @foreach($userTypesAndPositions['positions'] as $position)
                                                            <option value="{{ $position->id }}">{{ $position->position_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">User Type</label>
                                                    <div class="col-md-9 mx-auto">
                                                        <select name="user_type_id" class="form-control border-primary" id="user_type_id" required>
                                                            <option disabled value="" selected hidden>Select</option>
                                                            @foreach($userTypesAndPositions['userTypes'] as $userType)
                                                            <option value="{{ $userType->id }}">{{ $userType->user_type_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">Start Date </label>
                                                    <div class="col-md-9 mx-auto">
                                                        <input type="date" class="form-control border-primary" placeholder="Start Date" id="start_date" name="start_date" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">End Date</label>
                                                    <div class="col-md-9 mx-auto">
                                                        <input type="date" class="form-control border-primary" placeholder="" name="end_date" id="end_date" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">Gender</label>
                                                    <div class="col-md-9 mx-auto">
                                                        <select name="gender" class="form-control border-primary" id="gender" required>
                                                            <option disabled value="" selected hidden>Select</option>
                                                            <option value="1">Female</option>
                                                            <option value="2">Male</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">Address</label>
                                                    <div class="col-md-9 mx-auto">
                                                        <textarea rows="6" class="form-control border-primary" name="address" placeholder="Address" id="address" required></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <h4 class="form-section"><i class="fas fa-money-bill-alt">&nbsp;&nbsp;&nbsp;</i>Account Details</h4>
                                        <br>
                                        <hr>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">Bank Name</label>
                                                    <div class="col-md-9 mx-auto">
                                                        <select name="bank_name" class="form-control border-primary" id="bank_name" required>
                                                            <option disabled value="" selected hidden>Select</option>
                                                            <option value="1">Affin Bank Berhad</option>
                                                            <option value="2">Agrobank</option>
                                                            <option value="3">Al Rajhi & Investment Corporation (Malaysia) Berhad</option>
                                                            <option value="4">Alliance Bank Malaysia Berhad</option>
                                                            <option value="5">AmBank Berhad</option>
                                                            <option value="6">Bank Kerjasama Rakyat Malaysia Berhad</option>
                                                            <option value="7">Bank Muamalat Malaysia Berhad</option>
                                                            <option value="8">Bank of America (Malaysia) Berhad</option>
                                                            <option value="9">Bank of China (Malaysia) Berhad</option>
                                                            <option value="10">Bank Simpanan Nasional</option>
                                                            <option value="11">BigPay</option>
                                                            <option value="12">BNP Paribas Malaysia Berhad</option>
                                                            <option value="13">China Construction Bank (Malaysia) Berhad</option>
                                                            <option value="14">CIMB Bank Berhad</option>
                                                            <option value="15">Citibank Berhad</option>
                                                            <option value="16">Deutsche Bank (Malaysia) Berhad</option>
                                                            <option value="17">Finexus Cards Sdn. Bhd.</option>
                                                            <option value="18">Hong Leong Bank Berhad</option>
                                                            <option value="19">HSBC Bank Malaysia Berhad</option>
                                                            <option value="20">Industrial And Commercial Bank of China</option>
                                                            <option value="21">JP Morgan Chase Bank Berhad</option>
                                                            <option value="22">Kuwait Finance House (Malaysia) Berhad</option>
                                                            <option value="23">Maybank Berhad</option>
                                                            <option value="24">MBSB Bank Berhad</option>
                                                            <option value="25">Mizuho Bank (Malaysia) Berhad</option>
                                                            <option value="26">MUFG Bank (Malaysia) Berhad</option>
                                                            <option value="27">OCBC Bank (Malaysia) Berhad</option>
                                                            <option value="28">Public Bank Berhad</option>
                                                            <option value="29">RHB Bank Berhad</option>
                                                            <option value="30">Standard Chartered Bank Malaysia Berhad</option>
                                                            <option value="31">Sumitomo Mitsui Banking Corporation</option>
                                                            <option value="32">Touch n Go eWallet</option>
                                                            <option value="33">United Overseas Bank Berhad</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">Account Number</label>
                                                    <div class="col-md-9 mx-auto">
                                                        <input type="text" class="form-control border-primary" placeholder="Account Number" name="account_number" id="account_number" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">Basic Salary</label>
                                                    <div class="col-md-9 mx-auto">
                                                        <input type="text" class="form-control border-primary" placeholder="Basic Salary" name="basic_salary" id="basic_salary" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <br>
                                        <div class="form-actions text-center">
                                            <button class="btn btn-primary float-md-right" id="addbutton">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--end card-body-->
            </div><!--end card-->
        </div> <!--end col-->
    </div>

</x-app-layout>

<script>
    $(document).ready(function() {
        $("#addbutton").click(function(event) {
            event.preventDefault(); // Prevent the default form submission

            // Manually trigger form validation
            if ($("#registerEmployee")[0].checkValidity()) {
                // Show SweetAlert dialog
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You want to add this data!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#6777ef',
                    cancelButtonColor: '$secondary',
                    confirmButtonText: 'Yes, add it!',
                    dangerMode: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Show success message
                        Swal.fire({
                            title: 'Success!',
                            text: 'Your data has been saved.',
                            icon: 'success',
                            showConfirmButton: true // Show the "OK" button
                        }).then(() => {
                            // Submit the form here
                            $("#registerEmployee").submit();
                        });
                    }
                });
            } else {
                // Handle invalid form
                Swal.fire({
                    title: 'Invalid Form',
                    text: 'Please fill in all the required fields.',
                    icon: 'error',
                    showConfirmButton: true, // Show the "OK" button
                    confirmButtonColor: '#6777ef',
                });
            }
        });
    });
</script>