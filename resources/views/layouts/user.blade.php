<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>{{ env('APP_NAME', 'Soccer Compare') }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('user_assets/images/logo-sm.png') }}">
        <link href="{{ asset('user_assets/libs/jquery-toast/jquery.toast.min.css') }}" rel="stylesheet" type="text/css" />
        @yield('styles')
        <!-- App css -->
        <link href="{{ asset('user_assets/css/bootstrap.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('user_assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('user_assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
        <style>
          .user-photo {
            border-radius: 8px;
          }
          .page-item.active .page-link {
              background-color: #3cade1 !important;
              border-color: #3cade1 !important;
          }
          .flatpickr-day.endRange, .flatpickr-day.endRange.inRange, .flatpickr-day.endRange.nextMonthDay, .flatpickr-day.endRange.prevMonthDay, .flatpickr-day.endRange:focus, .flatpickr-day.endRange:hover, .flatpickr-day.selected, .flatpickr-day.selected.inRange, .flatpickr-day.selected.nextMonthDay, .flatpickr-day.selected.prevMonthDay, .flatpickr-day.selected:focus, .flatpickr-day.selected:hover, .flatpickr-day.startRange, .flatpickr-day.startRange.inRange, .flatpickr-day.startRange.nextMonthDay, .flatpickr-day.startRange.prevMonthDay, .flatpickr-day.startRange:focus, .flatpickr-day.startRange:hover
          {
              background-color: #3cade1 !important;
              border-color: #3cade1 !important;
          }
          .select2-container--default .select2-results__option[aria-selected=true]:hover
          {
              background-color: #3cade1 !important;
              border-color: #3cade1 !important;
          }
          .select2-container .select2-selection--multiple .select2-selection__choice
          {
              background-color: #3cade1 !important;
          }
        </style>
    </head>
    <body>
        <!-- Navigation Bar-->
        <header id="topnav">
            <!-- Topbar Start -->
            <div class="navbar-custom">
              @include('partials.user.topbar')
            </div>
            <!-- end Topbar -->

            <!-- Menubar Start -->
            <div class="topbar-menu">
              @include('partials.user.menubar')
            </div>            
            <!-- end Topbar -->
        </header>
        <!-- End Navigation Bar-->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->
        <div class="wrapper">
            <div class="container-fluid">
              @yield('content')
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

        <!-- Footer Start -->
{{--        <footer class="footer">--}}
          {{-- @include('partials.user.footerbar') --}}
{{--        </footer>--}}
        <!-- end Footer -->

        <!-- Right Sidebar -->
        <div class="right-bar">
          @include('partials.user.rightbar')
        </div>
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>

        <!-- Vendor js -->
        <script src="{{ asset('user_assets/js/vendor.min.js') }}"></script>
        <script src="{{ asset('user_assets/libs/jquery-toast/jquery.toast.min.js') }}"></script>
        <script src="{{ asset('user_assets/js/pages/toastr.init.js') }}"></script>
        @yield('scripts')
        <!-- App js-->
        <script src="{{ asset('user_assets/js/app.min.js') }}"></script>
    </body>
</html>