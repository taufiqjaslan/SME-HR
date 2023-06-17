<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @isset($meta)
    {{ $meta }}
    @endisset




    <link rel="stylesheet" href="{{ asset('build/assets/plugins/datatables/buttons.bootstrap4.min.css') }}">
    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans&family=Nunito:wght@400;600;700&family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('css/tailwind.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('stisla/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('stisla/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/notyf/notyf.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
    @vite(['resources/js/app.js'])

    <link rel="stylesheet" href="https://kit-free.fontawesome.com/releases/latest/css/free-v4-shims.min.css" media="all">
    <link rel="stylesheet" href="https://kit-free.fontawesome.com/releases/latest/css/free-v4-font-face.min.css" media="all">
    <link rel="stylesheet" href="https://kit-free.fontawesome.com/releases/latest/css/free.min.css" media="all">

    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('build/assets/plugins/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('build/assets/plugins/datatables/buttons.bootstrap4.min.css') }}">
    <!-- Responsive datatable examples -->
    <link rel="stylesheet" href="{{ asset('build/assets/plugins/datatables/responsive.bootstrap4.min.css') }}">
    <link href="{{ asset('build/assets/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('build/assets/js/waves.min.js') }}">

    <link rel="shortcut icon" href="{{ asset('build') }}/assets/images/sme_logo.png">


    <livewire:styles />



    <!-- Scripts -->
    <script defer src="{{ asset('vendor/alpine.js') }}"></script>
</head>

<body class="antialiased">
    <div id="app">
        <div class="main-wrapper">
            @include('components.navbar')
            @include('components.sidebar')

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        @isset($header_content)
                        {{ $header_content }}
                        @else
                        {{ __('Page') }}
                        @endisset
                    </div>

                    <div class="section-body">
                        {{ $slot }}
                    </div>
                </section>
            </div>
        </div>
    </div>

    @stack('modals')


    <!-- Metrica template -->


    <!-- jQuery  -->
    <script>
        var $j = jQuery.noConflict();
    </script>
    <script src="{{ asset('stisla/js/modules/jquery.min.js') }}"></script>
    <script src="{{ asset('build/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('build/assets/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('build/assets/js/waves.min.js') }}"></script>
    <script src="{{ asset('build/assets/js/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('build/assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('build/assets/pages/jquery.analytics_dashboard.init.js') }}"></script>


    <!-- Required datatable js -->
    <script src="{{ asset('build/assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('build/assets/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('build/assets/plugins/peity-chart/jquery.peity.min.js') }}"></script>


    <script src="{{ asset('build/assets/pages/jquery.ana_customers.inity.js') }}"></script>

    <script src="{{ asset('build/assets/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('build/assets/pages/jquery.forms-advanced.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('build/assets/js/app.js') }}"></script>




    <!-- Stisla template -->

    <!-- General JS Scripts -->
    <script defer async src="{{ asset('stisla/js/modules/popper.js') }}"></script>
    <script defer async src="{{ asset('stisla/js/modules/tooltip.js') }}"></script>
    <script src="{{ asset('stisla/js/modules/bootstrap.min.js') }}"></script>
    <script defer src="{{ asset('stisla/js/modules/jquery.nicescroll.min.js') }}"></script>
    <script defer src="{{ asset('stisla/js/modules/moment.min.js') }}"></script>
    <script defer src="{{ asset('stisla/js/modules/marked.min.js') }}"></script>
    <script defer src="{{ asset('vendor/notyf/notyf.min.js') }}"></script>
    <script defer src="{{ asset('vendor/sweetalert/sweetalert.min.js') }}"></script>
    <script defer src="{{ asset('stisla/js/modules/chart.min.js') }}"></script>
    <script defer src="{{ asset('vendor/select2/select2.min.js') }}"></script>

    <script src="{{ asset('stisla/js/stisla.js') }}"></script>
    <script src="{{ asset('stisla/js/scripts.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('stisla/js/page/index.js') }}"></script>
    <script src="{{ asset('stisla/js/page/modules-datatables.js') }}"></script>

    <!-- JS Libraies -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.js"></script>



    <livewire:scripts />
    {{-- <script src="{{ mix('js/app.js') }}" defer></script> --}}

    @isset($script)
    {{ $script }}
    @endisset
</body>

</html>