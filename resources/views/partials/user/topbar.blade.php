<div class="container-fluid">
    <ul class="list-unstyled topnav-menu float-right mb-0">

        <li class="dropdown notification-list">
            <!-- Mobile menu toggle-->
            <a class="navbar-toggle nav-link">
                <div class="lines">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </a>
            <!-- End mobile menu toggle-->
        </li>
        <li class="dropdown notification-list">
            <a href="#" class="nav-link dropdown-toggle d-flex align-items-center" data-toggle="dropdown">
                <img src="{{asset('/common_assets/flags')}}/{{App::getLocale()}}.png" class="mr-1" alt="img">
                <span class="text-uppercase">{{App::getLocale()}}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                <a href="{{ url('/lang/en') }}" class="dropdown-item notify-item d-flex align-items-center">
                    <img src="{{asset('/common_assets/flags/en.png')}}" class="pr-1" alt="img">
                    <span>English</span>
                </a>
                <a href="{{ url('/lang/es') }}" class="dropdown-item notify-item">
                    <img src="{{asset('/common_assets/flags/es.png')}}" class="pr-1" alt="img">
                    <span>Español</span>
                </a>
                <a href="{{ url('/lang/pt') }}" class="dropdown-item notify-item">
                    <img src="{{asset('/common_assets/flags/pt.png')}}" class="pr-1" alt="img">
                    <span>Português</span>
                </a>
            </div>
        </li>

        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <img src="{{ asset('user_assets/images/users/standard.png') }}" alt="user-image" class="rounded-circle">
                <span class="pro-user-name ml-1">
                    {{ Auth::user()->name }} <i class="mdi mdi-chevron-down"></i> 
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                <!-- item-->
                <div class="dropdown-header noti-title">
                    <h6 class="text-overflow m-0">@lang('welcome')</h6>
                </div>

                <!-- item-->
                <a href="{{ route('auth.change_password') }}" class="dropdown-item notify-item">
                    <i class="fas fa-key"></i>
                    <span>@lang('password')</span>
                </a>

                <!-- item-->
                <a href="{{ route('user.subscriptions') }}" class="dropdown-item notify-item">
                    <i class="fe-award"></i>
                    <span>@lang('subscriptions')</span>
                </a>
                <div class="dropdown-divider"></div>
                <!-- item-->
                <a href="javascript:void(0);" class="dropdown-item notify-item"  onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="fe-log-out"></i>
                    <span>@lang('logout')</span>
                </a>

            </div>
        </li>

    </ul>

    <!-- LOGO -->
    <div class="logo-box">
        <a href="/" class="logo text-center">
            <span class="logo-lg">
                <img src="{{ asset('user_assets/images/logo-light.png') }}" alt="" height="50">
                <!-- <span class="logo-lg-text-light">UBold</span> -->
            </span>
            <span class="logo-sm">
                <!-- <span class="logo-sm-text-dark">U</span> -->
                <img src="{{ asset('user_assets/images/logo-sm.png') }}" alt="" height="45">
            </span>
        </a>
    </div>

</div> <!-- end container-fluid-->