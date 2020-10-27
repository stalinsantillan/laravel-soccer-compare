@extends('layouts.user')
@section('styles')
    <!-- third party css -->
    <link href="{{ asset('user_assets/libs/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('user_assets/libs/datatables/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('user_assets/libs/datatables/buttons.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('user_assets/libs/datatables/select.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <!-- third party css end -->
    <style>
        table thead tr th{
            text-align: center;
        }
        table tbody tr td{
            text-align: center;
            width: 20%;
        }
        .round{
            border-radius: 50%;
        }
        .details-icon{
            cursor: pointer;
        }
        .w-20{
            width: 20%;
        }
        #dt_players tbody tr td{
            padding-left: 0 !important;
            padding-right: 0 !important;
        }
        .icon-star{
            color: lime;
        }
        .text-green{
            color: #10ea15;
        }
        .text-yellow{
            color: #fcde22;
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
                    <li class="breadcrumb-item">@lang('Comare')</li>
                </ol>
            </div>
            <h4 class="page-title">@lang('Compare')</h4>
        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body table-responsive">
                <div class="text-right mb-3">
                    <div class="btn-group" role="group" aria-label="First group">
                        <button type="button" class="btn btn-outline-info" onclick="sortBy(1)">@lang('general_average')</button>
                        <button type="button" class="btn btn-outline-info" onclick="sortBy(2)">@lang('technical_average')</button>
                        <button type="button" class="btn btn-outline-info" onclick="sortBy(3)">@lang('mental_average')</button>
                        <button type="button" class="btn btn-outline-info" onclick="sortBy(4)">@lang('physical_average')</button>
                    </div>
                </div>
                <table class="table table-striped w-100" id="dt_players">
                    <thead class="d-none">

                    </thead>
                    <tbody>

                    </tbody>
                </table>
                <div class="row mt-3">
                    <div class="col-md-3 offset-md-1 d-flex flex-column align-items-baseline justify-content-center">
                        <?php
                            $color = ["text-info","text-danger","text-green","text-yellow"]
                        ?>
                        @foreach($players as $key => $player)
                            <h5 class="{{$color[$key]}}"><i class="icon-graph mr-1"></i>{{$player->name}}</h5>
                        @endforeach
                    </div>
                    <div class="col-md-6">
                        <div class="chartjs-chart">
                            <canvas id="total-radar" height="200"></canvas>
                        </div>
                    </div>
                </div>
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
    <!-- third party js ends -->
    <!-- Datatables init -->
    <script src="{{ asset('user_assets/js/pages/datatables.init.js') }}"></script>
    <!-- Chart JS -->
    <script src="{{ asset('user_assets/libs/chart-js/Chart.bundle.min.js') }}"></script>
    <script>
        let dt_players;
        let _token = '{{csrf_token()}}';
        let ids = '{!! $ids !!}';
        let sort = 0;
        let t_count = '{{$t_count}}';
        let t_columns = [];
        for(let i=0;i<=t_count;i++){
            t_columns.push({"bSortable": false});
        }
        $(document).ready(function () {
            refreshTable();

            let data_value = ['{{$chart_data[0][0]}}','{{$chart_data[0][1]}}','{{$chart_data[0][2]}}','{{$chart_data[0][3]}}','{{$chart_data[0][4]}}','{{$chart_data[0][5]}}','{{$chart_data[0][6]}}','{{$chart_data[0][7]}}'];
            let chart_data = [];
            chart_data.push({
                label: "",
                backgroundColor: "rgba(57,175,209,0.2)",
                borderColor: "#4fc6e1",
                pointBackgroundColor: "#4fc6e1",
                pointBorderColor: "#fff",
                pointHoverBackgroundColor: "#fff",
                pointHoverBorderColor: "#4fc6e1",
                data: data_value
            })
            data_value = ['{{$chart_data[1][0]}}','{{$chart_data[1][1]}}','{{$chart_data[1][2]}}','{{$chart_data[1][3]}}','{{$chart_data[1][4]}}','{{$chart_data[1][5]}}','{{$chart_data[1][6]}}','{{$chart_data[1][7]}}'];
            chart_data.push({
                label: "",
                backgroundColor: "rgba(209,57,92,0.2)",
                borderColor: "#f1556c",
                pointBackgroundColor: "#f1556c",
                pointBorderColor: "#fff",
                pointHoverBackgroundColor: "#fff",
                pointHoverBorderColor: "#f1556c",
                data: data_value
            },)
            @if(isset($chart_data[2]))
                data_value = ['{{$chart_data[2][0]}}','{{$chart_data[2][1]}}','{{$chart_data[2][2]}}','{{$chart_data[2][3]}}','{{$chart_data[2][4]}}','{{$chart_data[2][5]}}','{{$chart_data[2][6]}}','{{$chart_data[2][7]}}'];
                chart_data.push({
                    label: "",
                    backgroundColor: "rgba(116,220,70,0.2)",
                    borderColor: "#10ea15",
                    pointBackgroundColor: "#10ea15",
                    pointBorderColor: "#fff",
                    pointHoverBackgroundColor: "#fff",
                    pointHoverBorderColor: "#10ea15",
                    data: data_value
                })
            @endif
            @if(isset($chart_data[3]))
                data_value = ['{{$chart_data[3][0]}}','{{$chart_data[3][1]}}','{{$chart_data[3][2]}}','{{$chart_data[3][3]}}','{{$chart_data[3][4]}}','{{$chart_data[3][5]}}','{{$chart_data[3][6]}}','{{$chart_data[3][7]}}'];
                chart_data.push({
                    label: "",
                    backgroundColor: "rgba(226,195,91,0.2)",
                    borderColor: "#fcde22",
                    pointBackgroundColor: "#fcde22",
                    pointBorderColor: "#fff",
                    pointHoverBackgroundColor: "#fff",
                    pointHoverBorderColor: "#fcde22",
                    data: data_value
                })
            @endif
            let data_label = ['{{__('PASS')}}', '{{__('ATTACK')}}', '{{__('TACTICAL')}}', '{{__('PHYSICAL')}}', '{{__('AERIAL')}}', '{{__('MENTAL')}}', '{{__('TECHNIQUE')}}', '{{__('DEFENSE')}}'];

            new Chart(document.getElementById("total-radar").getContext("2d"), {
                type: 'radar',
                data: {
                    labels: data_label,
                    datasets: chart_data
                },
                options: {
                    legend: {
                        display: false
                    },
                    // tooltips: {
                    //     enabled: false
                    // },
                    scale: {
                        angleLines: {
                            display: false
                        }
                        ,ticks: {
                            backdropColor: '#2C3840',
                            suggestedMin: 0,
                            suggestedMax: 10
                        }
                    }
                }
            });
        })
        function sortBy(val) {
            sort = val;
            refreshTable()
        }
        function refreshTable() {
            try {
                dt_players.destroy()
            } catch (e) {
            }
            dt_players = $('#dt_players').DataTable({
                ajax:{
                    url: '{{route('user.compare_list')}}',
                    type: "POST",
                    data: {sort:sort, _token: _token,ids:ids},
                },
                "aoColumns": t_columns,
                stateSave: true,
                processing:false,
                serverSide:true,
                bPaginate:false,
                bFilter:false,
                bInfo:false
            })
        }
        $('#dt_players tbody').on('click','td>div>span.details-icon', function () {
            let tr = $(this).parent().closest('tr');
            let row = dt_players.row(tr);
            let subchild = $(this);
            let val = subchild[0].dataset.value;
            if(row.child.isShown()){
                row.child.hide();
                $('#icon_'+val).addClass('icon-plus');
                $('#icon_'+val).removeClass('icon-arrow-up');
            }
            else{
                $.ajax({
                    url:'{{route("user.compare_detail")}}',
                    data: {sort:sort, _token: _token,ids:ids},
                    type:"POST",
                    dataType:"JSON",
                    success:function (resp) {
                        let html = format(resp.players,resp.label,val);
                        row.child(html).show();
                        $('#icon_'+val).removeClass('icon-plus');
                        $('#icon_'+val).addClass('icon-arrow-up');
                    }
                })
            }
        })
        function format(data,label,val) {
            let technical = ['crossing','dribbling','finishing','first_touch','heading','shots','long_shots','marking','passing','long_pass','technique','offensive'];
            let mental = ['aggression','anticipation','composure','concentration','decisions','determination','flair','leadership','off_ball','positioning','teamwork','vision'];
            let physical = ['acceleration','aerial_duels','agility','balance','jumping_reach','natural_fitness','pace','reaction','sprint_speed','stamina','strength','injury_resistance'];
            if(data.length<=0)
                return "<label>no data</label>";
            else{
                let subhtml = "";
                let special = [];
                if(val==0)
                    special = technical;
                else if(val==1)
                    special = mental;
                else if(val==2)
                    special = physical;
                for(let i=0;i<special.length;i++){
                    subhtml += "<tr>";
                    subhtml += '<td class="w-20">'+label[val][i]+'</td>';
                    let max_index = 0;
                    let max_val = 0;
                    for(let j=0;j<data.length;j++){
                        if(data[j]['latest_param'][special[i]]>max_val){
                            max_val = data[j]['latest_param'][special[i]];
                            max_index = j;
                        }
                    }
                    for(let k=0;k<data.length;k++) {
                        if(k==max_index)
                            subhtml += "<td>"+data[k]['latest_param'][special[i]]+"<i class='icon-star ml-1'></i></td>";
                        else
                            subhtml += "<td>"+data[k]['latest_param'][special[i]]+"</td>";
                    }
                    subhtml += "</tr>";
                }
                let html = "<table class='display nowrap table table-stripe table-bordered' cellspacing=\"0\">";
                html+= "<tbody>"+subhtml+"</tbody></table>";
                return html;
            }
        }
    </script>

@endsection