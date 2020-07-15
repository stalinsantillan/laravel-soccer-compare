@extends('layouts.user')
@section('styles')
    <link href="{{ asset('user_assets/libs/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('user_assets/libs/datatables/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('user_assets/libs/datatables/buttons.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('user_assets/libs/datatables/select.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
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
        <div class="row">
            <form role="form" method="get" action="{{ route('user.filter_player') }}">
                <div class="form-group col-md-auto">
                    <label for="name">Player name</label>
                    <div class="row">
                        <div class="col-md-auto">
                            <input type="text" class="form-control" id="name" name="name" value="{{ $filter['name'] ?? '' }}">
                        </div>
                        <div class="col-md-auto">
                            <button class="btn btn-primary" type="submit"><i class="fe-search"> Search</i></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
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
        })
    </script>
@endsection