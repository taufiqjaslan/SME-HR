<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Apply Claim') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Claim</a></div>
            <div class="breadcrumb-item"><a href="{{ route('ApplyClaim') }}">Apply Claim</a></div>
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
                                <h1 class="card-title"><i class="fas fa-user">&nbsp;&nbsp;&nbsp;</i>Claim Information</h1>
                            </div>
                            <div class="card-content collpase show">
                                <div class="card-body">
                                    <form method="POST" class="form form-horizontal" action="{{route('StoreClaim')}}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-body">
                                            <div class="row">
                                                @if(Auth::user()->user_type_id == 1)
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
                                                @endif
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control">Date</label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input type="date" class="form-control border-primary" placeholder="" name="date" id="date">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control">Claim Type</label>
                                                        <div class="col-md-9 mx-auto">
                                                            <select name="claim_type_id" class="form-control border-primary" id="claim_type">
                                                                <option disabled value="" selected hidden>Select</option>
                                                                @foreach($listData['claimType'] as $claimTypes)
                                                                <option value="{{ $claimTypes->id }}">{{ $claimTypes->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control">Claim Details</label>
                                                        <div class="col-md-9 mx-auto">
                                                            <textarea rows="6" class="form-control border-primary" name="detail" placeholder="Claim Details" id="detail"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6" id="amount" hidden>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control">Amount</label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input class="form-control border-primary" type="text" placeholder="Amount" name="amount" id="amount">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6" id="attachment" hidden>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control">Attachment File</label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input type="file" id="attachment_file" name="attachment">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" id="overtime" hidden>
                                                <div class="card-header">
                                                    <h1 class="card-title"><i class="fas fa-clock">&nbsp;&nbsp;&nbsp;</i>Overtime Details</h1>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control">Start Time</label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input class="form-control border-primary" type="time" name="start_time" id="start_time">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control">End Time</label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input class="form-control border-primary" type="time" name="end_time" id="end_time">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control">From Date</label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input class="form-control border-primary" type="date" name="start_date" id="start_date">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control">To Date</label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input class="form-control border-primary" type="date" name="end_date" id="end_date">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <br>
                                        <div class="form-actions text-center">
                                            <button class="btn btn-primary float-md-right" id="generate_button">Apply</button>
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
    //utk show date dgn time
    $('document').ready(function() {
        $('#claim_type').change(function() {
            var select_status = $('#claim_type').val();

            if (select_status == "2") {
                $('#overtime').removeAttr('hidden');
                $('#overtime input').attr('required', true);
                document.getElementById("attachment").setAttribute("hidden", "");
                document.getElementById("amount").setAttribute("hidden", "");
            } else {
                $('#overtime').attr('hidden', true);
                $('#overtime input').removeAttr('required');
                document.getElementById("attachment").removeAttribute("hidden");
                document.getElementById("amount").removeAttribute("hidden");
            }
        })
    })
</script>