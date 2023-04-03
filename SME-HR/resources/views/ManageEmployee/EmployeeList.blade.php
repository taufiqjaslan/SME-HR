<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('List of Employee') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Employee</a></div>
            <div class="breadcrumb-item"><a href="{{ route('user') }}">List Employee</a></div>
        </div>
    </x-slot>

    <div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <!-- @if(Auth::user()->user_type == "Petakom Committee") -->
                        <button class="btn btn-gradient-primary px-4 float-right mt-0 mb-3"><i class="mdi mdi-plus-circle-outline mr-2" class="card hidden"></i><a href="{{route('report.AddProposal')}}">Add Proposal</a></button>
                        <!-- @endif -->
                        <div class="table-responsive dash-social">
                            <table id="datatable" class="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Identification ID</th>
                                        <th>Position</th>
                                        <th>Status</th>
                                    </tr><!--end tr-->
                                </thead>

                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div> <!--end col-->
        </div><!--end row-->
    </div>
</x-app-layout>