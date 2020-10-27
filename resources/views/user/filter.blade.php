@extends('layouts.user')
@section('styles')
    <link href="{{ asset('user_assets/libs/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('user_assets/libs/datatables/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('user_assets/libs/datatables/buttons.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('user_assets/libs/datatables/select.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('popover_assets/css/bootstrap-popover-x.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('erp_assets/nouislider/nouislider.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('erp_assets/select/css/select2.css') }}" rel="stylesheet" type="text/css" />
{{--    <link href="{{ asset('erp_assets/rangeslider-2.3.0/rangeslider.css') }}" rel="stylesheet" type="text/css" />--}}
    <style>
        .table td, .table th {
            vertical-align: middle !important;
        }
        .select2-container--default .select2-results__option--selected {
            background-color: #4c5a67;
            color: white;
        }
        .select2-selection__rendered {
            padding: 0 !important;
        }
        .select2-selection__choice__remove:hover{
            background-color: #3cade1 !important;
        }
        .select2-container {
            width: auto !important;
            min-width: 300px !important;
            max-width: 600px !important;
        }
    </style>
@endsection
@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="/">@lang('soccer')</a></li>
                    <li class="breadcrumb-item active">@lang(trans('cruds.filter.title'))</li>
                </ol>
            </div>
            <h4 class="page-title">@lang(trans('cruds.filter.title'))</h4>
        </div>
    </div>
</div>     
<!-- end page title -->
<div class="card">
    <div class="card-body">
        <form role="form" id="search_form" method="get" action="{{ route('user.filter_player') }}">
            <input type="hidden" name="s_name" />
            <input type="hidden" name="s_position" />
            <input type="hidden" name="s_age" />
            <input type="hidden" name="s_height" />
            <input type="hidden" name="s_nationality" />
        </form>
        <div class="row mb-2">
            <div class="col-md-auto">
                <div class="row">
                    <div class="col-md-auto">
                        <label for="name" class="col-form-label">@lang('player_name')</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $filter['name'] ?? '' }}">
                    </div>
                    <div class="col-md-auto">
                        <label for="btn_position" class="col-form-label">&nbsp;</label><br />
                        <button type="button" class="btn btn-outline-info" id="btn_position">@lang('position')</button>
                        <!-- PopoverX content -->
                        <div id="popover_position" class="popover popover-x popover-default" style="min-width: 550px;">
                            <div class="arrow"></div>
                            <h3 class="popover-header popover-title">@lang('select_position')</h3>
                            <div class="popover-body popover-content">
                                @php
                                    $arrDefender = array("Centre-back", "Sweeper", "Left Full-back", "Right Full-back", "Left Wing-back", "Right Wing-back");
                                    $arrMidfielder = array("Centre midfield", "Defensive midfield", "Attacking midfield", "Left Wide midfield", "Right Wide midfield");
                                    $arrForward = array("Centre forward", "Second striker", "Left Winger", "Right Winger");
                                    $arrGoalkeeper = array("Goalkeeper");
                                @endphp
                                <div class="card-title font-15 font-weight-bold">
                                    @lang('defender')
                                </div>
                                <div class="row">
                                    <div class="col-md-10 offset-md-1 row">
                                        @foreach($arrDefender as $defender)
                                            <div class="checkbox checkbox-primary mb-2 col-md-6">
                                                <input id="{{ $defender }}" name="position[]" type="checkbox" {{ in_array($defender, $filter['position'] ?? array())==true?"checked":"" }}>
                                                <label for="{{ $defender }}">
                                                    @lang($defender)
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="card-title font-15 font-weight-bold">
                                    @lang('midfielder')
                                </div>
                                <div class="row">
                                    <div class="col-md-10 offset-md-1 row">
                                        @foreach($arrMidfielder as $midfielder)
                                            <div class="checkbox checkbox-primary mb-2 col-md-6">
                                                <input id="{{ $midfielder }}" name="position[]" type="checkbox" {{ in_array($midfielder, $filter['position'] ?? array())==true?"checked":"" }}>
                                                <label for="{{ $midfielder }}">
                                                    @lang($midfielder)
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="card-title font-15 font-weight-bold">
                                    @lang('forward')
                                </div>
                                <div class="row">
                                    <div class="col-md-10 offset-md-1 row">
                                        @foreach($arrForward as $forward)
                                            <div class="checkbox checkbox-primary mb-2 col-md-6">
                                                <input id="{{ $forward }}" name="position[]" type="checkbox" {{ in_array($forward, $filter['position'] ?? array())==true?"checked":"" }}>
                                                <label for="{{ $forward }}">
                                                    @lang($forward)
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="card-title font-15 font-weight-bold">
                                    @lang('Goalkeeper')
                                </div>
                                <div class="row">
                                    <div class="col-md-10 offset-md-1 row">
                                        @foreach($arrGoalkeeper as $goalkeeper)
                                            <div class="checkbox checkbox-primary mb-2 col-md-6">
                                                <input id="{{ $goalkeeper }}" name="position[]" type="checkbox" {{ in_array($goalkeeper, $filter['position'] ?? array())==true?"checked":"" }}>
                                                <label for="{{ $goalkeeper }}">
                                                    @lang($goalkeeper)
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="popover-footer text-center">
                                <button type="button" class="btn btn-sm btn-info" style="min-width: 150px" onclick="setPosition()">@lang('set')</button>
{{--                                    <button type="reset" class="btn btn-sm btn-danger" data-dismiss="popover-x">Close</button>--}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-auto">
                        <label for="btn_age" class="col-form-label">&nbsp;</label><br />
                        <button type="button" class="btn btn-outline-info" id="btn_age">@lang('age')</button>
                        <!-- PopoverX content -->
                        <div id="popover_age" class="popover popover-x popover-default" style="min-width: 550px;">
                            <div class="arrow"></div>
                            <h3 class="popover-header popover-title">@lang('age')</h3>
                            <div class="popover-body popover-content">
                                <div class="row mb-5 mt-5">
                                    <div class="col-md-10 offset-md-1">
                                        <div id="range_age"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="popover-footer text-center">
                                <button type="button" class="btn btn-sm btn-info" style="min-width: 150px" onclick="setAge()">@lang('set')</button>
{{--                                    <button type="reset" class="btn btn-sm btn-danger" data-dismiss="popover-x">Close</button>--}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-auto">
                        <label for="btn_height" class="col-form-label">&nbsp;</label><br />
                        <button type="button" class="btn btn-outline-info" id="btn_height">@lang('height')</button>
                        <!-- PopoverX content -->
                        <div id="popover_height" class="popover popover-x popover-default" style="min-width: 550px;">
                            <div class="arrow"></div>
                            <h3 class="popover-header popover-title">@lang('height')</h3>
                            <div class="popover-body popover-content">
                                <div class="row mb-5 mt-5">
                                    <div class="col-md-10 offset-md-1">
                                        <div id="range_height"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="popover-footer">
                                <div class="popover-footer text-center">
                                    <button type="button" class="btn btn-sm btn-info" style="min-width: 150px" onclick="setHeight()">@lang('set')</button>
                                    {{--                                    <button type="reset" class="btn btn-sm btn-danger" data-dismiss="popover-x">Close</button>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-auto">
                        <label for="nationality" class="col-form-label">@lang('nationality')</label><br />
                        <select class="js-states form-control" id="nationality" style="min-width: 300px;" multiple="multiple"></select>
                    </div>
                    <div class="col-md-auto">
                        <label for="" class="col-form-label">&nbsp;</label><br />
                        <button class="btn btn-outline-info" type="button" onclick="search()"><i class="fe-search"> @lang('search')</i></button>
                    </div>
                </div>
            </div>
        </div>
        <table id="filter-table" class="table nowrap table-responsive">
            <thead>
                <tr>
                    <th>#</th>
                    <th></th>
                    <th>@lang('Name')</th>
                    <th>@lang('position')</th>
                    <th style="background-color: #3f4a56">@lang('general_average')</th>
                    <th>@lang('age')</th>
                    <th>@lang('height')</th>
                    <th>@lang('nationality')</th>
                    <th>@lang('league')</th>
                    <th>@lang('technical_average')</th>
                    <th>@lang('mental_average')</th>
                    <th>@lang('physical_average')</th>
                    <th>@lang('goalkeeper_average')</th>
                    <th>@lang('action')</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($data))
                    @php
                        $no = 0;
                        $ok = 0;
                    @endphp
                    @foreach($data as $one)

                        @foreach($one->positions as $position_one)
                            @if(!isset($filter['position']) || in_array($position_one->specify, $filter['position'] ?? array()))
                                @php
                                    $ok = 1;
                                @endphp
                            @else
                                @php
                                    $ok = 0;
                                @endphp
                            @endif
                        @endforeach
                        @if($ok == 0)
                            @continue
                        @endif
                        <tr>
                            <td>{{ ++$no }}</td>
                            <td>
                                <a href="{{ route('user.player_profile', $one->id) }}">
                                    @if(isset($one->photo))
                                        <img src="{{ asset('storage').'/'.$one->photo }}" class="user-photo" height="50px" width="50px" alt="">
                                    @else
                                        <img src="{{ asset('user_assets/images/users/standard.png') }}" class="user-photo" height="50px" width="50px" alt="">
                                    @endif
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('user.player_profile', $one->id) }}" class="text-white-50"
                                   style="border-bottom: rgba(255,255,255,.5) dashed 1px;">
                                    @if($one->player_link == "")
                                        {{ $one->name }} {{ $one->surename }}
                                    @else
                                        {{ $one->short_name }}
                                    @endif
                                </a>
                            </td>
                            <td>
                                @php $subone = 1; @endphp
                                @foreach($one->positions as $position)
                                    @if($subone > 1)
                                        <br>
                                    @endif
                                    <span class="badge badge-info text-dark">{{ $position->specify }}</span>
                                    @php ++$subone; @endphp
                                @endforeach
                            </td>
                            <td style="background-color: #3f4a56">{{ round($one->general_average, 1) }}</td>
                            <td>{{ date('Y') - date('Y', strtotime($one->birth_date)) }}</td>
                            <td>{{ $one->height }}cm</td>
                            <td>{{ __($one->nationality) }}</td>
                            @php
                                $league = '';
                                if ($one->current_team_link == "")
                                {
                                    $team_model = App\Models\User\Team::find($one->current_team_id) ?? null;
                                    if ($team_model)
                                        $league = $team_model->league->name;
                                }
                                else
                                {
                                    $leagues = App\Models\User\ApiTeam::find($one->current_team_id);
                                    $league = $leagues->competition_name ?? '';
                                }
                            @endphp
                            <td>{{ $league }}</td>
                            <td>{{ round($one->technical_average, 1) }}</td>
                            <td>{{ round($one->mental_average, 1) }}</td>
                            <td>{{ round($one->physical_average, 1) }}</td>
                            <td>{{ round($one->goalkeeper_average, 1) }}</td>
                            <td>
                                <form action="{{ route('user.delete_player', $one->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div> <!-- end card body-->
</div> <!-- end card -->
@endsection

@section('scripts')
    @parent
    <!-- third party js -->
    <script src="{{ asset('user_assets/libs/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('user_assets/libs/datatables/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('user_assets/libs/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('user_assets/libs/datatables/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('user_assets/libs/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('user_assets/libs/datatables/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('user_assets/libs/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('user_assets/libs/datatables/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('user_assets/libs/datatables/buttons.print.min.js') }}"></script>
    <script src="{{ asset('user_assets/libs/datatables/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('user_assets/libs/datatables/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('user_assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('user_assets/libs/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('user_assets/js/pages/datatables.init.js') }}"></script>

    <script src="{{ asset('popover_assets/js/bootstrap-popover-x.js') }}" type="text/javascript"></script>
    <script src="{{ asset('erp_assets/nouislider/nouislider.js') }}"></script>


    <script src="{{ asset('erp_assets/select/js/select2.js') }}"></script>
{{--    <script src="{{ asset('erp_assets/rangeslider-2.3.0/rangeslider.js') }}"></script>--}}
    <!-- third party js ends -->
    <script>
        let range_age;
        let range_height;
        $(document).ready(function () {
            var settings = {
                "async": true,
                "crossDomain": true,
                "url": "https://ajayakv-rest-countries-v1.p.rapidapi.com/rest/v1/all",
                "method": "GET",
                "headers": {
                    "x-rapidapi-host": "ajayakv-rest-countries-v1.p.rapidapi.com",
                    "x-rapidapi-key": "596585807fmsh94116d249e0cd64p1d139cjsn6b7b5407af9b"
                }
            }
            $.ajax(settings).done(function (response) {
                let nationality_selected = @php echo json_encode($filter['nationality'] ?? array()); @endphp;
                for(ind in response)
                {
                    if (nationality_selected.includes(response[ind].name))
                        $('#nationality').append($("<option selected></option>").text(response[ind].name).attr("value", response[ind].name));
                    else
                        $('#nationality').append($("<option></option>").text(response[ind].name).attr("value", response[ind].name));
                }
                $('#nationality').select2({
                    allowClear: false,
                    dropdownAutoWidth: true,
                    width: 'element',
                    minimumResultsForSearch: 20, //prevent filter input
                    maximumSelectionSize: 20 // prevent scrollbar
                });
            });
            $("#nationality").select2();
            var table = $("#filter-table").DataTable({
                language: {
                    paginate: {
                        previous: "<i class='mdi mdi-chevron-left'>",
                        next: "<i class='mdi mdi-chevron-right'>"
                    }
                },
                buttons: ["copy", "print", "pdf"],
                drawCallback: function() {
                    $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
                },
                "order": [[ 4, "desc" ]],
                'columnDefs': [ {
                    'targets': [0,1,2,3,7,8,13], // column index (start from 0)
                    'orderable': false, // set orderable false for selected columns
                }]
            });
            table.on( 'order.dt search.dt', function () {
                table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                } );
            } ).draw();
            $('#btn_position').popoverButton({
                target: '#popover_position',
                placement: 'right'
            });
            $('#btn_age').popoverButton({
                target: '#popover_age',
                placement: 'right'
            });
            range_age = document.getElementById('range_age');
            let scope_age = [5, 45];
            @if(isset($filter['age']))
                scope_age = [{{ $filter['age'][0] }}, {{ $filter['age'][1] }}]
            @endif
            noUiSlider.create(range_age, {
                start: scope_age,// ... must be at least 300 apart
                // margin: 300,
                step: 1,
                // ... but no more than 600
                // limit: 600,

                // Display colored bars between handles
                connect: true,

                // Put '0' at the bottom of the slider
                // direction: 'rtl',
                // orientation: 'vertical',

                // Move handle on tap, bars are draggable
                behaviour: 'tap-drag',
                tooltips: true,
                format: {
                    // 'to' the formatted value. Receives a number.
                    to: function (value) {
                        return value;
                    },
                    // 'from' the formatted value.
                    // Receives a string, should return a number.
                    from: function (value) {
                        return Number(value.replace(',-', ''));
                    }
                },

                // Show a scale with the slider
                // pips: {
                //     mode: 'steps',
                //     stepped: true,
                //     density: 20
                // },
                range: {
                    'min': 5,
                    'max': 45
                }
            });
            $('#btn_height').popoverButton({
                target: '#popover_height',
                placement: 'right'
            });
            range_height = document.getElementById('range_height');
            let scope_height = [130, 210];
            @if(isset($filter['height']))
                scope_height = [{{ $filter['height'][0] }}, {{ $filter['height'][1] }}]
            @endif
            noUiSlider.create(range_height, {
                start: scope_height,// ... must be at least 300 apart
                // margin: 300,
                step: 1,
                // ... but no more than 600
                // limit: 600,

                // Display colored bars between handles
                connect: true,

                // Put '0' at the bottom of the slider
                // direction: 'rtl',
                // orientation: 'vertical',

                // Move handle on tap, bars are draggable
                behaviour: 'tap-drag',
                tooltips: true,
                format: {
                    // 'to' the formatted value. Receives a number.
                    to: function (value) {
                        return value;
                    },
                    // 'from' the formatted value.
                    // Receives a string, should return a number.
                    from: function (value) {
                        return Number(value.replace(',-', ''));
                    }
                },

                // Show a scale with the slider
                // pips: {
                //     mode: 'steps',
                //     stepped: true,
                //     density: 20
                // },
                range: {
                    'min': 130,
                    'max': 210
                }
            });
        })
        function search() {
            let nationality = $("#nationality").val();
            let positions = $("[name='position[]']").map(function(){
                if($(this).prop("checked") == true) {
                    return $(this).attr("id");
                }
            }).get();
            let age = range_age.noUiSlider.get();
            let height = range_height.noUiSlider.get();
            $("input[name=s_name]").val($("#name").val());
            $("input[name=s_nationality]").val(nationality);
            $("input[name=s_position]").val(positions);
            $("input[name=s_age]").val(age);
            $("input[name=s_height]").val(height);
            $("#search_form").submit();
        }
        function setPosition() {
            $('#popover_position').popoverX('hide');
        }
        function setAge() {
            $('#popover_age').popoverX('hide');
        }
        function setHeight() {
            $('#popover_height').popoverX('hide');
        }
    </script>
@endsection