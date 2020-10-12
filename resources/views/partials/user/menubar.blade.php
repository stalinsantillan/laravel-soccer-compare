<div class="container-fluid">
    <div id="navigation">
        <!-- Navigation Menu-->
        <ul class="navigation-menu">
            <li class="has-submenu">
                <a href="#">
                    @lang(trans('global.add')) @lang(trans('cruds.player.title')) <div class="arrow-down"></div>
                </a>
                <ul class="submenu">
                    <li>
                        <a href="{{ route('user.add_player') }}">
                            @lang(trans('cruds.player.new'))
                        </a>
                    </li>
                        @if (Auth::user()->is_subscribed == 1)
                            @if(Auth::user()->subscribe_id == 2 || Auth::user()->subscribe_id == 4)
                                <li>
                                    <a href="{{ route('user.get_player_list_api') }}">
                                        @lang(trans('cruds.player.existing'))
                                    </a>
                                </li>
                            @endif
                        @elseif (Auth::user()->trial_end >= date('Y-m-d') && Auth::user()->trial_type == 1)
                            <li>
                                <a href="{{ route('user.get_player_list_api') }}">
                                    @lang(trans('cruds.player.existing'))
                                </a>
                            </li>
                        @endif
{{--                    <li>--}}
{{--                        <a href="{{ route('user.add_player_excel') }}">--}}
{{--                            {{ trans('cruds.player.excel') }}--}}
{{--                        </a>--}}
{{--                    </li>--}}
                </ul>
            </li>
            <li>
                <a href="{{ route('user.filter_show') }}">
                    @lang(trans('cruds.filter.title'))
                </a>
            </li>
            <li class="has-submenu">
                <a href="#">
                    @lang(trans('cruds.menuGroup.my_team')) <div class="arrow-down"></div>
                </a>
                <ul class="submenu">
                    <li>
                        <a href="{{ route('user.leagues.index') }}">
                            @lang(trans('cruds.league.title_singular'))
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('user.teams.index') }}">
                            @lang(trans('cruds.team.title_singular'))
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