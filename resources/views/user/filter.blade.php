@extends('layouts.user')
@section('styles')
    <link href="{{ asset('user_assets/libs/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('user_assets/libs/datatables/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('user_assets/libs/datatables/buttons.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('user_assets/libs/datatables/select.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
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
        <h4 class="header-title"></h4>
{{--        <div class="responsive-table-plugin">--}}
{{--            <div class="table-rep-plugin">--}}
{{--                <div class="table-responsive" data-pattern="priority-columns">--}}
                    <table id="filter-table" class="table nowrap table-striped table-responsive">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th></th>
                                <th>Name</th>
                                <th>Position</th>
                                <th>General average</th>
                                <th>Year</th>
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
                            <tr>
                                <td>Tiger Nixon</td>
                                <td>System Architect</td>
                                <td>Edinburgh</td>
                                <td>61</td>
                                <td>2011/04/25</td>
                                <td>$320,800</td>
                                <td>Tiger Nixon</td>
                                <td>System Architect</td>
                                <td>Edinburgh</td>
                                <td>61</td>
                                <td>2011/04/25</td>
                                <td>$320,800</td>
                                <td>$320,800</td>
                            </tr>
                        </tbody>
                    </table>
{{--                </div> <!-- end card body-->--}}
{{--            </div> <!-- end card body-->--}}
{{--        </div> <!-- end card body-->--}}
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