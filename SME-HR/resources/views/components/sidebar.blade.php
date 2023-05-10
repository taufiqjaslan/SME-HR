@php
$links = [
    [
        "href" => "dashboard",
        "text" => "Dashboard",
        "is_multi" => false,
    ],

    [
        "href" => [
            [
                "section_text" => "Employee",
                "section_list" => [
                    ["href" => "ListEmployee", "text" => "List Employee"],
                    ["href" => "CreateEmployee", "text" => "Add Employee"]
                ]
            ]
        ],
        "text" => "Employee",
        "is_multi" => true,
        "icon" => "fas fa-user-tie",
    ],

    [
        "href" => [
            [
                "section_text" => "Payroll",
                "section_list" => [
                    ["href" => "ListPayroll", "text" => "Payslip Setting"],
                    ["href" => "GeneratePayslip", "text" => "Generate Payslip"],
                    ["href" => "ViewPayslip", "text" => "View Payslip"]
                ]
            ]
        ],
        "text" => "Payroll",
        "is_multi" => true,
        "icon" => "fas fa-money-bill-wave",
    ],

    [
        "href" => [
            [
                "section_text" => "Claim",
                "section_list" => [
                    ["href" => "ApplyClaim", "text" => "Apply Claim"],
                    ["href" => "ListClaim", "text" => "View Claim"]
                ]
            ]
        ],
        "text" => "Claim",
        "is_multi" => true,
        "icon" => "far fa-file-alt",
    ],

    [
        "href" => [
            [
                "section_text" => "EA Form",
                "section_list" => [
                    ["href" => "RegisterEmployee", "text" => "Apply Claim"],
                    ["href" => "RegisterEmployee", "text" => "View Claim"]
                ]
            ]
        ],
        "text" => "EA Form",
        "is_multi" => true,
        "icon" => "fas fa-clipboard-list",
    ],

    [
        "href" => [
            [
                "section_text" => "Leave",
                "section_list" => [
                    ["href" => "RegisterEmployee", "text" => "Entitlements"],
                    ["href" => "ApplyLeave", "text" => "Apply Leave"],
                    ["href" => "RegisterEmployee", "text" => "Leave List"],
                    ["href" => "RegisterEmployee", "text" => "Holidays"],
                    ["href" => "RegisterEmployee", "text" => "Report"]
                ]
            ]
        ],
        "text" => "Leave",
        "is_multi" => true,
        "icon" => "fas fa-notes-medical",
    ],
];
$navigation_links = array_to_object($links);
@endphp

<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('dashboard') }}">SME-HR</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('dashboard') }}">
                <!-- logo dekat sidebar -->
                <img class="d-inline-block" width="32px" height="30.61px" src="" alt=""> 
            </a>
        </div>
        @foreach ($navigation_links as $link)
        <ul class="sidebar-menu">
            <li class="menu-header">{{ $link->text }}</li>
            @if (!$link->is_multi)
            <li class="{{ Request::routeIs($link->href) ? 'active' : '' }}">
                <a class="nav-link" href="{{ route($link->href) }}"><i class="fas fa-chart-bar"></i><span>Dashboard</span></a>
            </li>
            @else
                @foreach ($link->href as $section)
                    @php
                    $routes = collect($section->section_list)->map(function ($child) {
                        return Request::routeIs($child->href);
                    })->toArray();

                    $is_active = in_array(true, $routes);
                    $icon = isset($link->icon) ? $link->icon : 'fas fa-chart-bar';
                    @endphp

                    <li class="dropdown {{ ($is_active) ? 'active' : '' }}">
                        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="{{ $icon }}"></i> <span>{{ $section->section_text }}</span></a>
                        <ul class="dropdown-menu">
                            @foreach ($section->section_list as $child)
                                <li class="{{ Request::routeIs($child->href) ? 'active' : '' }}"><a class="nav-link" href="{{ route($child->href) }}">{{ $child->text }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            @endif
            
        </ul>
        @endforeach
    </aside>
</div>