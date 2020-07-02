<div class="container-fluid">
    <div id="navigation">
        <!-- Navigation Menu-->
        <ul class="navigation-menu">

            <li class="has-submenu">
                <a href="#">
                    <i class="fa-fw fas fa-users"></i>{{ trans('cruds.userManagement.title') }} <div class="arrow-down"></div></a>
                <ul class="submenu">
                    <li>
                        <a href="{{ route('admin.permissions.index') }}">
                            <i class="fa-fw fas fa-unlock-alt"></i>
                            {{ trans('cruds.permission.title') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.roles.index') }}">
                            <i class="fa-fw fas fa-briefcase"></i>
                            {{ trans('cruds.role.title') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.users.index') }}">
                            <i class="fa-fw fas fa-user"></i>
                            {{ trans('cruds.user.title') }}
                        </a>
                    </li>
                </ul>
            </li>

        </ul>
        <!-- End navigation menu -->

        <div class="clearfix"></div>
    </div>
    <!-- end #navigation -->
</div>