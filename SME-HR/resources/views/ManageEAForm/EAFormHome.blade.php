<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('EA Form') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">EA Form</a></div>
            <div class="breadcrumb-item"><a href="{{ route('ListEmployee') }}">EA Form</a></div>
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
                                        <th>Identity Card</th>
                                        <th>Position</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $no = 1;
                                    ?>
                                    @foreach($EAFormRecords as $EAList)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{$EAList->name}}</td>
                                        <td>{{$EAList->ic}}</td>
                                        <td>{{$EAList->position->position_name}}</td>
                                        <td>
                                            <a href="{{route('ListEAForm', ['id' => $EAList->id])}}" class="mr-2"><i class="fas fa-eye font-16"></i></a>
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