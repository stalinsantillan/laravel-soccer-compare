@extends('layouts.user')
@section('styles')
    <link href="{{ asset('user_assets/libs/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('user_assets/libs/datatables/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('user_assets/libs/datatables/buttons.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('user_assets/libs/datatables/select.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('popover_assets/css/bootstrap-popover-x.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('erp_assets/nouislider/nouislider.css') }}" rel="stylesheet" type="text/css" />
{{--    <link href="{{ asset('erp_assets/rangeslider-2.3.0/rangeslider.css') }}" rel="stylesheet" type="text/css" />--}}
    <style>
        .table td, .table th {
            vertical-align: middle !important;
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
                    <li class="breadcrumb-item"><a href="/">Soccer</a></li>
                    <li class="breadcrumb-item active">{{ trans('cruds.filter.title') }}</li>
                </ol>
            </div>
            <h4 class="page-title">{{ trans('cruds.filter.title') }}</h4>
        </div>
    </div>
</div>     
<!-- end page title -->
<div class="card">
    <div class="card-body">
        <form role="form" method="get" action="{{ route('user.filter_player') }}">
            <div class="row mb-2">
                <div class="col-md-auto">
                    <label for="name">Player name</label>
                    <div class="row">
                        <div class="col-md-auto">
                            <input type="text" class="form-control" id="name" name="name" value="{{ $filter['name'] ?? '' }}">
                        </div>
                        <div class="col-md-auto">
                            <button type="button" class="btn btn-primary" id="btn_position">Position</button>
                            <!-- PopoverX content -->
                            <div id="popover_position" class="popover popover-x popover-default" style="min-width: 550px;">
                                <div class="arrow"></div>
                                <h3 class="popover-header popover-title">Select Position</h3>
                                <div class="popover-body popover-content">
                                    @php
                                        $arrDefender = array("Centre-back", "Sweeper", "Left Full-back", "Right Full-back", "Left Wing-back", "Right Wing-back");
                                        $arrMidfielder = array("Centre midfield", "Defensive midfield", "Attacking midfield", "Left Wide midfield", "Right Wide midfield");
                                        $arrForward = array("Centre forward", "Second striker", "Left Winger", "Right Winger");
                                        $arrGoalkeeper = array("Goalkeeper");
                                    @endphp
                                    <div class="card-title font-15 font-weight-bold">
                                        Defender
                                    </div>
                                    <div class="row">
                                        <div class="col-md-10 offset-md-1 row">
                                            @foreach($arrDefender as $defender)
                                                <div class="checkbox checkbox-primary mb-2 col-md-6">
                                                    <input id="{{ $defender }}" type="checkbox">
                                                    <label for="{{ $defender }}">
                                                        {{ $defender }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="card-title font-15 font-weight-bold">
                                        Midfielder
                                    </div>
                                    <div class="row">
                                        <div class="col-md-10 offset-md-1 row">
                                            @foreach($arrMidfielder as $midfielder)
                                                <div class="checkbox checkbox-primary mb-2 col-md-6">
                                                    <input id="{{ $midfielder }}" type="checkbox">
                                                    <label for="{{ $midfielder }}">
                                                        {{ $midfielder }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="card-title font-15 font-weight-bold">
                                        Forward
                                    </div>
                                    <div class="row">
                                        <div class="col-md-10 offset-md-1 row">
                                            @foreach($arrForward as $forward)
                                                <div class="checkbox checkbox-primary mb-2 col-md-6">
                                                    <input id="{{ $forward }}" type="checkbox">
                                                    <label for="{{ $forward }}">
                                                        {{ $forward }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="card-title font-15 font-weight-bold">
                                        Goalkeeper
                                    </div>
                                    <div class="row">
                                        <div class="col-md-10 offset-md-1 row">
                                            @foreach($arrGoalkeeper as $goalkeeper)
                                                <div class="checkbox checkbox-primary mb-2 col-md-6">
                                                    <input id="{{ $goalkeeper }}" type="checkbox">
                                                    <label for="{{ $goalkeeper }}">
                                                        {{ $goalkeeper }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="popover-footer">
                                    <button type="button" class="btn btn-sm btn-primary">Set</button>
                                    <button type="reset" class="btn btn-sm btn-danger" data-dismiss="popover-x">Close</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-auto">
                            <button type="button" class="btn btn-primary" id="btn_age">Age</button>
                            <!-- PopoverX content -->
                            <div id="popover_age" class="popover popover-x popover-default" style="min-width: 550px;">
                                <div class="arrow"></div>
                                <h3 class="popover-header popover-title">Age</h3>
                                <div class="popover-body popover-content">
                                    <div class="row mb-5 mt-5">
                                        <div class="col-md-10 offset-md-1">
                                            <div id="range"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="popover-footer">
                                    <button type="button" class="btn btn-sm btn-primary">Set</button>
                                    <button type="reset" class="btn btn-sm btn-danger" data-dismiss="popover-x">Close</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-auto">
                            <button class="btn btn-primary" type="submit"><i class="fe-search"> Search</i></button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <table id="filter-table" class="table nowrap table-responsive">
            <thead>
                <tr>
                    <th>#</th>
                    <th></th>
                    <th>Name</th>
                    <th>Position</th>
                    <th style="background-color: #3f4a56">General average</th>
                    <th>Date of birth</th>
                    <th>Height</th>
                    <th>Nationality</th>
                    <th>League</th>
                    <th>Tactical average</th>
                    <th>Physical average</th>
                    <th>Technical average</th>
                    <th>Goalkeeper average</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($data))
                    @php $no = 0; @endphp
                    @foreach($data as $one)
                        <tr>
                            <td>{{ ++$no }}</td>
                            <td>
                                <a href="{{ route('user.player_profile', $one->id) }}" target="_blank">
                                    @if(isset($one->photo))
                                        <img src="{{ asset('storage').'/'.$one->photo }}" class="user-photo" height="50px" width="50px" alt="">
                                    @else
                                        <img src="{{ asset('user_assets/images/users/standard.png') }}" class="user-photo" height="50px" width="50px" alt="">
                                    @endif
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('user.player_profile', $one->id) }}" class="text-white-50" target="_blank"
                                   style="border-bottom: rgba(255,255,255,.5) dashed 1px;">
                                    {{ $one->name }}
                                </a>
                            </td>
                            <td>
                                @php $subone = 1; @endphp
                                @foreach($one->positions as $position)
                                    @if($subone > 1)
                                        <br>
                                    @endif
                                    <span class="badge badge-primary">{{ $position->specify }}</span>
                                    @php ++$subone; @endphp
                                @endforeach
                            </td>
                            <td style="background-color: #3f4a56">{{ round($one->general_average, 1) }}</td>
                            <td>{{ $one->birth_date }}</td>
                            <td>{{ $one->height }}cm</td>
                            <td>{{ $one->nationality }}</td>
                            <td></td>
                            <td>{{ round($one->mental_average, 1) }}</td>
                            <td>{{ round($one->physical_average, 1) }}</td>
                            <td>{{ round($one->technical_average, 1) }}</td>
                            <td>{{ round($one->goalkeeper_average, 1) }}</td>
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
{{--    <script src="{{ asset('erp_assets/rangeslider-2.3.0/rangeslider.js') }}"></script>--}}
    <!-- third party js ends -->
    <script>
        $(document).ready(function () {
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
                }
            });
            $('#btn_position').popoverButton({
                target: '#popover_position',
                placement: 'right'
            });
            $('#btn_age').popoverButton({
                target: '#popover_age',
                placement: 'right'
            });
            noUiSlider.create(document.getElementById('range'), {
                start: [20, 80],// ... must be at least 300 apart
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
                    'min': 0,
                    'max': 100
                }
            });
            // $('[data-rangeslider]').rangeslider({
            //     // Deactivate the feature detection
            //     polyfill: false,
            //     // Callback function
            //     onInit: function() {
            //     },
            //     // Callback function
            //     onSlide: function(position, value) {
            //     },
            //     // Callback function
            //     onSlideEnd: function(position, value) {
            //     }
            // });
        })
    </script>
@endsection