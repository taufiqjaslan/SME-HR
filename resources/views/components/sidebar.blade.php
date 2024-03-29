@php
$user = auth()->user();
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
["href" => "CreateEmployee", "text" => "Add Employee"],
["href" => "ListPosition", "text" => "Job Setting"]
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
["href" => "ListPayroll", "text" => "List Payslip"],
["href" => "listPayslip", "text" => "Generate Payslip"],
["href" => "listGenerated", "text" => "View Payslip"],
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
["href" => "ListClaim", "text" => "List Claim"],
["href" => "ListClaimType", "text" => "Claim Setting"]
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
"section_text" => "Leave",
"section_list" => [
["href" => "ApplyLeave", "text" => "Apply Leave"],
["href" => "ListLeave", "text" => "Leave List"],
["href" => "listEntitlement", "text" => "Entitlements"],
["href" => "listReport", "text" => "Report"],
["href" => "listLeaveType", "text" => "Leave Setting"]
]
]
],
"text" => "Leave",
"is_multi" => true,
"icon" => "fas fa-notes-medical",
],

[
"href" => [
[
"section_text" => "EA Form",
"section_list" => [
["href" => "EAFormHome", "text" => "EA Form List"],
]
]
],
"text" => "EA Form",
"is_multi" => true,
"icon" => "fas fa-clipboard-list",
],

];

// Remove the "Emplloyee" link if user_type_id is not 1
if ($user->user_type_id != 1) {
    $links[1]['href'][0]['section_list'] = array_filter($links[1]['href'][0]['section_list'], function ($item) {
        return $item['text'] !== 'Job Setting' && $item['text'] !== 'Add Employee';
    });
}

// Remove the "Payroll" link if user_type_id is not 1
if ($user->user_type_id != 1) {
    $links[2]['href'][0]['section_list'] = array_filter($links[2]['href'][0]['section_list'], function ($item) {
        return $item['text'] !== 'Generate Payslip' && $item['text'] !== 'List Payslip';
    });
}

// Remove the "Claim" link if user_type_id is not 1
if ($user->user_type_id != 1) {
    $links[3]['href'][0]['section_list'] = array_filter($links[3]['href'][0]['section_list'], function ($item) {
        return $item['text'] !== 'Claim Setting';
    });
}

// Remove the "Leave" link if user_type_id is not 1
if ($user->user_type_id != 1) {
    $links[4]['href'][0]['section_list'] = array_filter($links[4]['href'][0]['section_list'], function ($item) {
        return $item['text'] !== 'Leave Setting';
    });
}


$navigation_links = array_to_object($links);

@endphp

<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand" style="display: flex; justify-content: center;">
            <a href="{{ route('dashboard') }}">
                <img src="../build/assets/images/sme_logo2.png" class="d-inline-block" width="100px" height="50px" />
            </a>
        </div>

        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('dashboard') }}">
                <!-- logo dekat sidebar -->
                <img class="d-inline-block" width="32px" height="30.61px" src="../build/assets/images/sme_logo.png" alt="">
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