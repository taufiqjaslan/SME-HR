@php
$user = auth()->user();
@endphp

<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-turbolinks="false" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
        </ul>
        <h1 class="font-weight-bold text-2xl text-white">{{ config('app.name', 'Laravel') }}</h1>
    </form>
    <ul class="navbar-nav navbar-right">
        @if(Auth::user()->user_type_id == 2)
        <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep"><i class="far fa-bell"></i></a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
                <div class="dropdown-header">Notifications
                    <div class="float-right">
                        <a href="#">Mark All As Read</a>
                    </div>
                </div>
                <div class="dropdown-list-content dropdown-list-icons">
                    @foreach($notifications as $notification)
                    @php
                    $redirectUrl = ($notification->noti_type == 1) ? route('ListClaim') : route('ListLeave');
                    @endphp
                    <a href="{{$redirectUrl}}" class="dropdown-item{{ $notification->unread ? ' dropdown-item-unread' : '' }}">
                        <div class="dropdown-item-icon bg-primary text-white">
                            <i class="fas fa-bell"></i>
                        </div>
                        <div class="dropdown-item-desc">
                            {{ $notification->employee->username }} {{ $notification->noti_text }}
                            <div class="time text-primary">{{ $notification->employee->name }}</div>
                        </div>
                    </a>
                    @endforeach
                </div>

            </div>
        </li>
        @endif


        <!-- Settings Dropdown -->
        <li class="dropdown">
            <div class="nav-link nav-link-lg nav-link-user" data-toggle="dropdown">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                <button class="flex items-center text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                    <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                    <div class="d-sm-none d-lg-inline-block ml-2"> @if(Auth::user()->user_type_id == 1)
                        Administrator
                        @elseif(Auth::user()->user_type_id == 2)
                        Manager
                        @elseif(Auth::user()->user_type_id == 3)
                        Staff
                        @endif
                        | {{ Auth::user()->username }}
                    </div>
                </button>
                @else
                <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                    {{ Auth::user()->name }}
                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
                @endif
            </div>
            <div class="dropdown-menu dropdown-menu-right">
                <!-- Account Management -->
                <div class="block px-4 py-2 text-xs text-gray-400">
                    {{ __('Manage Account') }}
                </div>

                <a href="{{ route('profile.show') }}" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Profile
                </a>

                <div class="border-t border-gray-100"></div>
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class="dropdown-item has-icon text-danger flex items-center">
                        <i class="fas fa-sign-out-alt"></i><span class="text-sm">Logout</span>
                    </button>
                </form>
            </div>
        </li>
    </ul>
</nav>