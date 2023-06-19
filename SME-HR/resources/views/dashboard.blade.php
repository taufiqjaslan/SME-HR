<x-app-layout>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.print.min.css" media="print">
    <x-slot name="header_content">
        <h1>Dashboard</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Layout</a></div>
            <div class="breadcrumb-item">Default Layout</div>
        </div>
    </x-slot>

    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Employee</h4>
                    </div>
                    <div class="card-body" id="total-employees">
                        Loading...
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                    <i class="far fa-file-alt"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Claim Application</h4>
                    </div>
                    <div class="card-body" id="total-claims">
                        Loading...
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Leave Application</h4>
                    </div>
                    <div class="card-body" id="total-leaves">
                        Loading...
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <!--begin::Tab-->
                    <div class="tab-pane show active px-7" id="kt_user_edit_tab_1" role="tabpanel">
                        <!--begin::Row-->
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <div id='calendar1'>
                                </div>
                                <div style='clear:both'></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--end card-body-->
        </div><!--end col-->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <!--begin::Tab-->
                    <div class="tab-pane show active px-7" id="kt_user_edit_tab_1" role="tabpanel">
                        <!--begin::Row-->
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <div class="card-header">
                                    <h1 class="card-title">Leave Analytic Chart</h1>
                                </div>
                                <canvas id="myChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--end card-body-->
        </div><!--end col-->
    </div><!--end row-->


</x-app-layout>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



<script>
    $(document).ready(function() {
        // Fetch the total number of employees, claim applications, and leave applications using AJAX
        $.ajax({
            url: "{{ route('count') }}", // Replace with your route URL
            method: 'GET',
            success: function(response) {
                // Update the HTML with the respective counts
                $('#total-employees').html(response.totalEmployees);
                $('#total-claims').html(response.totalClaim);
                $('#total-leaves').html(response.totalLeave);
            },
            error: function() {
                // Handle errors if any
                $('#total-employees').html('Error retrieving employee count.');
                $('#total-claims').html('Error retrieving claim count.');
                $('#total-leaves').html('Error retrieving leave count.');
            }
        });

        $.ajax({
            url: '{{ route("chartData") }}',
            method: 'GET',
            success: function(response) {
                var chartData = response;

                // Use the chartData to render the chart
                renderChart(chartData);
            },
            error: function(xhr, status, error) {
                console.log('Error:', error);
            }
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar1');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: ['interaction', 'dayGrid', 'timeGrid'],
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            select: function(arg) {
                var title = prompt('Event Title:');
                if (title) {
                    calendar.addEvent({
                        title: title,
                        start: arg.start
                    });
                }
                calendar.unselect();
            },
            editable: true,
            eventLimit: true,
            eventSources: [{
                url: "{{ route('getEvents') }}", // Replace with your route URL
                method: 'GET',
                failure: function() {
                    console.error('Error fetching events data.');
                }
            }],
            eventSourceSuccess: function(content, xhr) {
                var data = JSON.parse(content);
                var events = data.map(eventData => ({
                    title: eventData.title,
                    start: eventData.start,
                    end: eventData.end,
                    backgroundColor: "#2596be",
                    borderColor: "#2596be",
                    textColor: "#000"
                }));
                return events;
            },
            loading: function(bool) {
                if (bool) {
                    // Show loader or do any loading indicator operations
                } else {
                    // Hide loader or perform any post-loading operations
                }
            }
        });

        calendar.render();

        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["Annual Leave", "Emergency Leave", "Marriage Leave", "Medical Leave", "Compassionate Leave"],
                datasets: [{
                    label: 'Statistics',
                    data: [14, 10, 5, 6, 30],
                    borderWidth: 2,
                    backgroundColor: '#6777ef',
                    borderColor: '#6777ef',
                    borderWidth: 2.5,
                    pointBackgroundColor: '#ffffff',
                    pointRadius: 4
                }]
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        gridLines: {
                            drawBorder: false,
                            color: '#f2f2f2',
                        },
                        ticks: {
                            beginAtZero: true,
                            stepSize: 5
                        }
                    }],
                    xAxes: [{
                        ticks: {
                            display: false
                        },
                        gridLines: {
                            display: false
                        }
                    }]
                },
            }
        });
    });

    function renderChart(chartData) {
        var ctx = document.getElementById('myChart').getContext('2d');

        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: chartData['Leave Types'],
                datasets: [{
                    label: 'Leave Days',
                    data: chartData['Leave Days'],
                    backgroundColor: 'rgba(54, 162, 235, 0.8)',
                }],
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                        },
                    },
                },
            },
        });
    }
</script>