<div class="container-fluid">
    <div id="navigation">
        <!-- Navigation Menu-->
        <ul class="navigation-menu">
            <li class="has-submenu">
                <a href="#">
                    {{ trans('global.add') }} {{ trans('cruds.player.title') }} <div class="arrow-down"></div>
                </a>
                <ul class="submenu">
                    <li>
                        <a href="{{ route('user.add_player') }}">
                            {{ trans('cruds.player.manually') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('user.get_player_list_api') }}">
                            {{ trans('cruds.player.api') }}
                        </a>
                    </li>
{{--                    <li>--}}
{{--                        <a href="{{ route('user.add_player_excel') }}">--}}
{{--                            {{ trans('cruds.player.excel') }}--}}
{{--                        </a>--}}
{{--                    </li>--}}
                </ul>
            </li>
            <li>
                <a href="{{ route('user.filter_show') }}">
                    {{ trans('cruds.filter.title') }}
                </a>
            </li>
            <li class="has-submenu">
                <a href="#">
                    {{ trans('cruds.menuGroup.my_team') }} <div class="arrow-down"></div>
                </a>
                <ul class="submenu">
                    <li>
                        <a href="{{ route('user.leagues.index') }}">
                            {{ trans('cruds.league.title_singular') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('user.teams.index') }}">
                            {{ trans('cruds.team.title_singular') }}
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