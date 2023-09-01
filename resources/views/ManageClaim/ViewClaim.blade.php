<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('View Claim') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Claim</a></div>
            <div class="breadcrumb-item"><a href="">View Claim</a></div>
        </div>
    </x-slot>

    <div class="row">
        <div class="col-md-12">
            <div class="text-md-right">
                <a href="{{route('ListClaim')}}"><button class="btn btn-primary float-md-right"><i class="fas fa-chevron-left"></i></button></a>
            </div>
        </div>
    </div>
    <br>

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
                                    <form method="POST" class="form form-horizontal" action="" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control">Staff Name</label>
                                                        <div class="col-md-9 mx-auto">
                                                            <select name="user_id" class="form-control border-primary" id="user_id" disabled>
                                                                <option disabled value="" selected hidden>Select</option>
                                                                @foreach ($employeeInfo as $employeeInfos)
                                                                <option value="{{ $employeeInfos->id }}" {{ old('user_id', $claimInfo->user_id) == $employeeInfos->id ? 'selected' : '' }}>
                                                                    {{ $employeeInfos->name }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control">Date</label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input type="date" class="form-control border-primary" name="date" id="date" value="{{ old('date', $claimInfo->date) }}" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control">Claim Type</label>
                                                        <div class="col-md-9 mx-auto">
                                                            <select name="claim_type_id" class="form-control border-primary" id="claim_type" disabled>
                                                                <option disabled value="" selected hidden>Select</option>
                                                                @foreach ($claimTypeInfo as $claimType)
                                                                <option value="{{ $claimType->id }}" {{ old('claim_type_id', $claimInfo->claim_type_id) == $claimType->id ? 'selected' : '' }}>
                                                                    {{ $claimType->name }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control">Claim Details</label>
                                                        <div class="col-md-9 mx-auto">
                                                            <textarea rows="6" class="form-control border-primary" name="detail" placeholder="Claim Details" id="detail" disabled>{{ old('detail', $claimInfo->detail) }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6" id="amount" @if ($claimInfo->claim_type_id == 3) hidden @endif>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control">Amount</label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input class="form-control border-primary" type="text" placeholder="Amount" name="amount" id="amount" value="{{ old('amount', $claimInfo->amount) }}" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6" id="attachment" @if ($claimInfo->claim_type_id == 3) hidden @endif>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control">Attachment File</label>
                                                        <div class="col-md-9 mx-auto">
                                                            <a href="{{ asset('uploads/attachment/'.$claimInfo->attachment) }}" target="_blank">
                                                                @if (pathinfo($claimInfo->attachment, PATHINFO_EXTENSION) == 'pdf')
                                                                <embed src="{{ asset('uploads/attachment/'.$claimInfo->attachment) }}" width="400px" height="400px" type="application/pdf">
                                                                @else
                                                                <img src="{{ asset('uploads/attachment/'.$claimInfo->attachment) }}" width="500px" height="500px" alt="" class="img-fluid">
                                                                @endif
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" id="overtime" @if ($claimInfo->claim_type_id != 3) hidden @endif>
                                                <div class="card-header">
                                                    <h1 class="card-title"><i class="fas fa-clock">&nbsp;&nbsp;&nbsp;</i>Overtime Details</h1>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control">Start Time</label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input class="form-control border-primary" type="time" name="start_time" id="start_time" value="{{ old('start_time', $claimInfo->start_time) }}" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control">End Time</label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input class="form-control border-primary" type="time" name="end_time" id="end_time" value="{{ old('end_time', $claimInfo->end_time) }}" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control">From Date</label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input class="form-control border-primary" type="date" name="start_date" id="start_date" value="{{ old('start_date', $claimInfo->start_date) }}" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control">To Date</label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input class="form-control border-primary" type="date" name="end_date" id="end_date" value="{{ old('end_date', $claimInfo->end_date) }}" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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