<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('List of Claim') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Payroll</a></div>
            <div class="breadcrumb-item"><a href="{{ route('ListClaim') }}">List Claim</a></div>
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
                                        <th>Date</th>
                                        <th>Claim Type</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $no = 1;
                                    ?>
                                    @foreach($claimRecords as $list)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{$list->employee->name}}</td>
                                        <td>{{$list->date}}</td>
                                        <td>Transportation</td>
                                        <td>{{$list->amount}}</td>
                                        @if($list->status == 1)
                                        <?php
                                        $labelstatus = "UNPAID";
                                        $labelcolor = "badge badge-danger";
                                        ?>
                                        @elseif ($list->status == 0)
                                        <?php
                                        $labelstatus = "PAID";
                                        $labelcolor = "badge badge-success";
                                        ?>
                                        @endif
                                        <td><span class="{{ $labelcolor }}">{{ $labelstatus }}</span></td>
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