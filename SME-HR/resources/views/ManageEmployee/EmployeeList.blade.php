<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('List of Employee') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Employee</a></div>
            <div class="breadcrumb-item"><a href="{{ route('ListEmployee') }}">List Employee</a></div>
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
                                        <th>Email</th>
                                        <th>Position</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $no = 1;
                                    ?>
                                    @foreach($lists as $list)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{$list->name}}</td>
                                        <td>{{$list->email}}</td>
                                        <td>{{$list->position_id}}</td>
                                        @if($list->status == 0)
                                        <?php
                                        $labelstatus = "Inactive";
                                        $labelcolor = "badge badge-danger";
                                        ?>
                                        @elseif ($list->status == 1)
                                        <?php
                                        $labelstatus = "Active";
                                        $labelcolor = "badge badge-success";
                                        ?>
                                        @endif
                                        <td><span class="{{ $labelcolor }}">{{ $labelstatus }}</span></td>
                                        <td>
                                            <form action="" method="POST" id="delete-form">
                                                @method('DELETE')
                                                @csrf
                                                <a href="" class="mr-2"><i class="fas fa-eye text-primary font-16"></i></a>
                                                <!-- @if(Auth::user()->user_type != "Dean" && Auth::user()->user_type != "Coordinator" && Auth::user()->user_type != "Head of Program") -->
                                                <a href="" class="mr-2"><i class="fas fa-edit text-info font-16"></i></a>
                                                <button id="delbutton" type="submit"><i class="fas fa-trash-alt text-danger font-16"></i></button>
                                                @endif
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