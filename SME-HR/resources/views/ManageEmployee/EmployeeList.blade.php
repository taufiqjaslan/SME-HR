<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('List of Employee') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- @if(Auth::user()->user_type == "Petakom Committee") -->
                            <button class="btn btn-gradient-primary px-4 float-right mt-0 mb-3"><i class="mdi mdi-plus-circle-outline mr-2" class="card hidden"></i><a href="{{route('report.AddProposal')}}">Add Proposal</a></button>
                            <!-- @endif -->
                            <h4 class="header-title mt-0">Proposal Details</h4>
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
                                        @foreach($lists as $list)
                                        <tr>
                                            <td></td>
                                            <td>{{$list->name}}</td>
                                            <td>{{$list->ic}}</td>
                                            <td>{{$list->position_id}}</td>
                                            <td></td>
                                            @if($list->status == 0)
                                            <?php
                                            $labelstatus = "Pending";
                                            $labelcolor = "badge badge-warning";
                                            ?>
                                            @elseif ($list->status == 1)
                                            <?php
                                            $labelstatus = "Approve";
                                            $labelcolor = "badge badge-success";
                                            ?>
                                            @elseif ($list->status == 2)
                                            <?php
                                            $labelstatus = "Reject";
                                            $labelcolor = "badge badge-danger";
                                            ?>
                                            @endif
                                            <td>
                                                <span class="{{ $labelcolor }}">{{ $labelstatus }}</span>
                                            </td>
                                            <td>
                                                <form action="{{ route('destroy', $report->id) }}" method="POST" id="delete-form">
                                                    @method('DELETE')
                                                    @csrf
                                                    <a href="{{route('report.ViewReport',[$report->id])}}" class="mr-2"><i class="fas fa-eye text-info font-16"></i></a>
                                                    @if(Auth::user()->user_type != "Dean" && Auth::user()->user_type != "Coordinator" && Auth::user()->user_type != "Head of Program")
                                                    <a href="{{route('edit', ['id' => $report->id])}}" class="mr-2"><i class="fas fa-edit text-info font-16"></i></a>
                                                    <button id="delbutton" type="submit"><i class="fas fa-trash-alt text-danger font-16"></i></button>
                                                    @endif
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                        <!--end tr-->
                                    </tbody>
                                </table>
                            </div>
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div> <!--end col-->
            </div><!--end row-->
        </div>
    </div>
</x-app-layout>