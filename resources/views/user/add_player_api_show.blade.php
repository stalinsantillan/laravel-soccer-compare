@extends('layouts.user')
@section('styles')
    <link href="{{ asset('user_assets/libs/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('user_assets/libs/datatables/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('user_assets/libs/datatables/buttons.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('user_assets/libs/datatables/select.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('popover_assets/css/bootstrap-popover-x.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('erp_assets/nouislider/nouislider.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('erp_assets/map/map.css') }}" rel="stylesheet" type="text/css" />
    {{--    <link href="{{ asset('erp_assets/rangeslider-2.3.0/rangeslider.css') }}" rel="stylesheet" type="text/css" />--}}
    <style>
        .table td, .table th {
            vertical-align: middle !important;
            padding: 0.55rem;
        }
        .flag_16 {
            font-size: 12px;
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
                <h4 class="page-title">{{ trans('global.add') }} {{ trans('cruds.player.existing') }} {{ trans('cruds.player.title') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="card">
        <div class="card-body">
            <div class="row form-group">
                <label class="col-md-auto col-form-label" for="name">Player name</label>
                <div class="col-md-auto">
                    <input type="text" class="form-control" id="name" name="name" >
                </div>
                <div class="col-md-auto">
                    <button class="btn btn-outline-info" type="button" onclick="showTable()" onkeydown=""><i class="fe-search"> Search</i></button>
                </div>
                <div class="col-md-6 text-right">
                    <button type="button" id="btnPrevious" disabled class="btn btn-secondary">Previous</button>
                    <button type="button" id="btnNext" disabled class="btn btn-secondary ml-1">Next</button>
                </div>
            </div>
            <table class="table nowrap" id="player_table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Team</th>
                    <th>Position</th>
                    <th>Age</th>
                    <th>Height</th>
                    <th>Weight</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center" colspan='6'>No data available in table
                        </td>
                    </tr>
                </tbody>
            </table>
        </div> <!-- end card body-->
    </div> <!-- end card -->
    <form role="form" id="add_player_form" method="get" action="{{ route('user.add_player_api') }}">
        <input type="hidden" name="link" />
    </form>
@endsection

@section('scripts')
    @parent
    <script src="{{ asset('popover_assets/js/bootstrap-popover-x.js') }}" type="text/javascript"></script>
    <script>
        let previous_page = 0;
        let page = 0;
        let has_previous_page = 0;
        let has_next_page = 0;
        $(document).ready(function () {
            $("#btnNext").click(function () {
                previous_page = page;
                page = parseInt(page) + 1;
                showTable();
            })
            $("#btnPrevious").click(function () {
                previous_page = page;
                page = parseInt(page) - 1;
                showTable();
            })
            $("#name").on('keypress',function(e) {
                if(e.which == 13) {
                    showTable();
                }
            });
        })
        function add_player(link) {
            if (link == "")
            {
                $.NotificationApp.send(
                    "Warning",
                    "This player already added.",
                    "top-center",
                    "#da8609",
                    "info");
                return;
            }
            $("[name=link]").val(link);
            $("#add_player_form").submit();
        }
        function showTable() {
            let name = $("#name").val();
            $("#player_table").find("tbody").html("<tr><td class='text-center' colspan='6'>Loading...</td></tr>");
            $.ajax({
                url: "{{ route('user.get_player_list_api_data') }}",
                data: {name: name, page: page, previous_page: previous_page},
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $("#player_table").find("tbody").html(res.html);
                    if(res.length == 0 || res.html == "")
                    {
                        $("#player_table").find("tbody").html("<tr><td class='text-center' colspan='6'>No data available in table\n</td></tr>");
                        previous_page = 0;
                        page = 0;
                        has_previous_page = 0;
                        has_next_page = 0;
                    } else {
                        page = parseInt(res.page);
                        has_previous_page = parseInt(res.has_previous_page);
                        has_next_page = parseInt(res.has_next_page);
                    }
                    if (has_next_page == 1)
                    {
                        $("#btnNext").prop( "disabled", false );
                    } else {
                        $("#btnNext").prop( "disabled", true );
                    }
                    if (page == 0)
                    {
                        $("#btnPrevious").prop( "disabled", true );
                    } else {
                        $("#btnPrevious").prop( "disabled", false );
                    }
                },
                error: function (jqXHR, exception) {
                    $("#player_table").find("tbody").html("<tr><td class='text-center' colspan='6'>No data available in table\n</td></tr>");
                    previous_page = 0;
                    page = 0;
                    has_previous_page = 0;
                    has_next_page = 0;
                }
            });
        }
    </script>
@endsection