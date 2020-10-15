@extends('layouts.user')
@section('styles')
    <!-- third party css -->
    <link href="{{ asset('user_assets/libs/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('user_assets/libs/datatables/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('user_assets/libs/datatables/buttons.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('user_assets/libs/datatables/select.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <!-- third party css end -->
@endsection
@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">@lang(trans('cruds.team.title_singular'))</li>
                </ol>
            </div>
            <h4 class="page-title">@lang(trans('cruds.team.title_singular'))</h4>
        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <a class="btn btn-success mb-3" href="{{ route('user.teams.create') }}">
                    @lang(trans('global.add')) @lang(trans('cruds.team.title_singular'))
                </a>
                <table id="tblteam" class="table dt-responsive nowrap">
                    <thead>
                        <tr>
                            <th>@lang(trans('cruds.team.fields.id'))</th>
                            <th>@lang(trans('cruds.team.fields.title'))</th>
                            <th>@lang(trans('cruds.league.title_singular'))</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($teams as $key => $team)
                            <tr data-entry-id="{{ $team->id }}">
                                <td>
                                    {{ $team->id ?? '' }}
                                </td>
                                <td>
                                    {{ $team->name ?? '' }}
                                </td>
                                <td>
                                    {{ $team->league->name ?? '' }}
                                </td>
                                <td>
                                    <a class="btn btn-xs btn-info" href="{{ route('user.teams.edit', $team->id) }}">
                                        @lang(trans('global.edit'))
                                    </a>
                                    <form action="{{ route('user.teams.destroy', $team->id) }}" method="POST" onsubmit="return confirm('@lang(trans('global.areYouSure'))');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="@lang(trans('global.delete'))">
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
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
    <!-- third party js ends -->
    <!-- Datatables init -->
    <script src="{{ asset('user_assets/js/pages/datatables.init.js') }}"></script>
    <script>
        $(document).ready(function () {
            var table = $("#tblteam").DataTable({
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