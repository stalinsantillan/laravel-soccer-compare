@extends('layouts.user')
@section('styles')
    <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('soccer_field/css/soccerfield.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('soccer_field/css/soccerfield.default.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .soccerfield-player span {
            font-size: 8px !important;
            width: 10px !important;
            min-height: 10px !important;
            max-height: 10px !important;
            border-radius: 50%;
            margin-top: 6px !important;
            margin-left: 8px !important;
            border : none !important;
            background : linear-gradient(to left, #00c6ff, #000000) !important;
        }
        @media (max-width: 576px) {
            .soccerfield-field
            {
                width: 280px !important;
            }
        }
        .rotated {
            -webkit-transform: rotate(90deg);
            -moz-transform: rotate(90deg);
            -o-transform: rotate(90deg);
            -ms-transform: rotate(90deg);
            transform: rotate(90deg);
        }
        .progress-lg {
            height: 18px !important;
        }
        .progress>span
        {
            color: white;
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
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ trans('cruds.player.title') }}</a></li>
                    <li class="breadcrumb-item active">{{ trans('cruds.player.profile') }}</li>
                </ol>
            </div>
            <h4 class="page-title">{{ trans('cruds.player.profile') }}</h4>
        </div>
    </div>
</div>
<!-- end page title --> 
<div class="row">
    <div class="col-md-8">
        <div class="card mb-0">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-auto row">
                        <div class="col-md-auto">
                            @if(isset($data->photo))
                                <img src="{{ asset('storage').'/'.$data->photo }}" class="user-photo ml-5" height="130px" alt="">
                            @else
                                <img src="{{ asset('user_assets/images/users/standard.png') }}" class="user-photo ml-5" height="130px" alt="">
                            @endif
                            <div class="card text-white text-center bg-primary text-xs-center mt-1 mb-0 ml-5" style="width: 130px">
                                <p class="mb-0 mt-1" style="line-height: 15px">General</p>
                                <p class="mb-0" style="line-height: 15px">average</p>
                                <p class="mb-0 font-18 font-weight-bold" id="general_average"></p>
                            </div>
                        </div>
                        <div class="col-md-auto">
                            <p class="font-weight-bold font-17 mt-1 mb-1">{{ $data->name }}</p>
                            <p>
                                <i class="fas fa-calendar font-weight-bold"></i><span class="ml-1">{{ $data->birth_date }}</span>
                                <i class="fas fa-arrows-alt-v font-weight-bold ml-2"></i><span class="ml-1">{{ $data->height }}cm</span>
                                <i class="fas fa-flag font-weight-bold ml-2"></i><span class="ml-1">{{ $data->nationality }}</span>
                            </p>
                            <p class="mt-2 mb-0">
                                <span class="font-weight-bold">Current Team</span> {{ $data->current_team }}
                            </p>
                            <p class="mt-0">
                                <span class="font-weight-bold">League</span> Flamengo-Brazil(BR)
                            </p>
                            <p class="mt-2">
                                <span class="font-weight-bold">Prefered foot</span> {{ $data->foot }}
                            </p>
                        </div>
                    </div>
                    <div class="col-md-auto">
                        <div id="soccerfield"></div>
                    </div>
                </div>
            </div>
        </div> <!-- end card-box-->
        <div class="card mt-2">
            <div class="card-header font-16">
                Attribute
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card-title font-15 font-weight-bold">
                            Technical
                        </div>
                        <div class="form-group">
                            <label for="corners">Corners</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->corners * 10 }}%</span>
                                <div class="progress-bar bg-info" role="progressbar" style="width: {{ $data->corners * 10 }}%" aria-valuenow="7" aria-valuemin="0" aria-valuemax="10"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="crossing">Crossing</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->crossing * 10 }}%</span>
                                <div class="progress-bar bg-info" role="progressbar" style="width: {{ $data->crossing * 10 }}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="10"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="dribbling">Dribbling</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->dribbling * 10 }}%</span>
                                <div class="progress-bar bg-info" role="progressbar" style="width: {{ $data->dribbling * 10 }}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="10"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="finishing">Finishing</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->finishing * 10 }}%</span>
                                <div class="progress-bar bg-info" role="progressbar" style="width: {{ $data->finishing * 10 }}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="10"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="first_touch">First Touch</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->first_touch * 10 }}%</span>
                                <div class="progress-bar bg-info" role="progressbar" style="width: {{ $data->first_touch * 10 }}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="10"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="free_kick">Free Kick Taking</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->free_kick * 10 }}%</span>
                                <div class="progress-bar bg-info" role="progressbar" style="width: {{ $data->free_kick * 10 }}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="10"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="heading">Heading</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->heading * 10 }}%</span>
                                <div class="progress-bar bg-info" role="progressbar" style="width: {{ $data->heading * 10 }}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="10"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="long_shots">Long Shots</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->long_shots * 10 }}%</span>
                                <div class="progress-bar bg-info" role="progressbar" style="width: {{ $data->long_shots * 10 }}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="10"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="long_throws">Long Throws</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->long_throws * 10 }}%</span>
                                <div class="progress-bar bg-info" role="progressbar" style="width: {{ $data->long_throws * 10 }}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="10"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="marking">Marking</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->marking * 10 }}%</span>
                                <div class="progress-bar bg-info" role="progressbar" style="width: {{ $data->marking * 10 }}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="10"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="passing">Passing</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->passing * 10 }}%</span>
                                <div class="progress-bar bg-info" role="progressbar" style="width: {{ $data->passing * 10 }}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="10"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="penalty_taking">Penalty Taking</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->penalty_taking * 10 }}%</span>
                                <div class="progress-bar bg-info" role="progressbar" style="width: {{ $data->penalty_taking * 10 }}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="10"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tackling">Tackling</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->tackling * 10 }}%</span>
                                <div class="progress-bar bg-info" role="progressbar" style="width: {{ $data->tackling * 10 }}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="10"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="technique">Technique</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->technique * 10 }}%</span>
                                <div class="progress-bar bg-info" role="progressbar" style="width: {{ $data->technique * 10 }}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="10"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-title font-15 font-weight-bold">
                            Mental
                        </div>
                        <div class="form-group">
                            <label for="aggression">Aggression</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->aggression * 10 }}%</span>
                                <div class="progress-bar bg-info" role="progressbar" style="width: {{ $data->aggression * 10 }}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="10"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="articipation">Articipation</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->articipation * 10 }}%</span>
                                <div class="progress-bar bg-info" role="progressbar" style="width: {{ $data->articipation * 10 }}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="10"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="bravery">Bravery</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->bravery * 10 }}%</span>
                                <div class="progress-bar bg-info" role="progressbar" style="width: {{ $data->bravery * 10 }}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="10"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="composure">Composure</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->composure * 10 }}%</span>
                                <div class="progress-bar bg-info" role="progressbar" style="width: {{ $data->composure * 10 }}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="10"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="concentration">Concentration</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->concentration * 10 }}%</span>
                                <div class="progress-bar bg-info" role="progressbar" style="width: {{ $data->concentration * 10 }}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="10"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="decisions">Decisions</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->decisions * 10 }}%</span>
                                <div class="progress-bar bg-info" role="progressbar" style="width: {{ $data->decisions * 10 }}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="10"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="determination">Determination</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->determination * 10 }}%</span>
                                <div class="progress-bar bg-info" role="progressbar" style="width: {{ $data->determination * 10 }}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="10"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="flair">Flair</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->flair * 10 }}%</span>
                                <div class="progress-bar bg-info" role="progressbar" style="width: {{ $data->flair * 10 }}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="10"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="leadership">Leadership</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->leadership * 10 }}%</span>
                                <div class="progress-bar bg-info" role="progressbar" style="width: {{ $data->leadership * 10 }}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="10"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="off_ball">Off The Ball</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->off_ball * 10 }}%</span>
                                <div class="progress-bar bg-info" role="progressbar" style="width: {{ $data->off_ball * 10 }}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="10"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="positioning">Positioning</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->positioning * 10 }}%</span>
                                <div class="progress-bar bg-info" role="progressbar" style="width: {{ $data->positioning * 10 }}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="10"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="teamwork">Teamwork</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->teamwork * 10 }}%</span>
                                <div class="progress-bar bg-info" role="progressbar" style="width: {{ $data->teamwork * 10 }}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="10"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="vision">Vision</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->vision * 10 }}%</span>
                                <div class="progress-bar bg-info" role="progressbar" style="width: {{ $data->vision * 10 }}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="10"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="work_rate">Work Rate</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->work_rate * 10 }}%</span>
                                <div class="progress-bar bg-info" role="progressbar" style="width: {{ $data->work_rate * 10 }}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="10"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-title font-15 font-weight-bold">
                            Physical
                        </div>
                        <div class="form-group">
                            <label for="acceleration">Acceleration</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->acceleration * 10 }}%</span>
                                <div class="progress-bar bg-info" role="progressbar" style="width: {{ $data->acceleration * 10 }}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="10"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="agility">Agility</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->agility * 10 }}%</span>
                                <div class="progress-bar bg-info" role="progressbar" style="width: {{ $data->agility * 10 }}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="10"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="balance">Balance</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->balance * 10 }}%</span>
                                <div class="progress-bar bg-info" role="progressbar" style="width: {{ $data->balance * 10 }}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="10"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="jumping_reach">Jumping Reach</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->jumping_reach * 10 }}%</span>
                                <div class="progress-bar bg-info" role="progressbar" style="width: {{ $data->jumping_reach * 10 }}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="10"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="natural_fitness">Natural Fitness</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->natural_fitness * 10 }}%</span>
                                <div class="progress-bar bg-info" role="progressbar" style="width: {{ $data->natural_fitness * 10 }}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="10"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="pace">Pace</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->pace * 10 }}%</span>
                                <div class="progress-bar bg-info" role="progressbar" style="width: {{ $data->pace * 10 }}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="10"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="stamina">Stamina</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->stamina * 10 }}%</span>
                                <div class="progress-bar bg-info" role="progressbar" style="width: {{ $data->stamina * 10 }}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="10"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="strength">Strength</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->strength * 10 }}%</span>
                                <div class="progress-bar bg-info" role="progressbar" style="width: {{ $data->strength * 10 }}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="10"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="dropdown-divider"></div>
                        <div class="card-title font-15 font-weight-bold">
                            Technical average: <span id="technical_average"></span>
                        </div>
                        <div class="mt-2 chartjs-chart">
                            <canvas id="technical-radar" height="200"></canvas>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="dropdown-divider"></div>
                        <div class="card-title font-15 font-weight-bold">
                            Mental average: <span id="mental_average"></span>
                        </div>
                        <div class="mt-2 chartjs-chart">
                            <canvas id="mental-radar" height="200"></canvas>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="dropdown-divider"></div>
                        <div class="card-title font-15 font-weight-bold">
                            Physical average: <span id="physical_average"></span>
                        </div>
                        <div class="mt-2 chartjs-chart">
                            <canvas id="physical-radar" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end card-box-->
    </div>
    <div class="col-md-4">
        <div class="card mb-2">
            <div class="card-body">
                <div class="card-title font-15 font-weight-bold">
                    General average: <span id="general_avg"></span>
                </div>
                <div class="dropdown-divider"></div>
                <div class="mt-2 chartjs-chart">
                    <canvas id="general-radar" height="150"></canvas>
                </div>
            </div>
        </div>
        <div class="card-box">
            <ul class="nav nav-tabs nav-bordered">
                <li class="nav-item">
                    <a href="#report" data-toggle="tab" aria-expanded="false" class="nav-link active">
                        REPORT
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#injuries" data-toggle="tab" aria-expanded="true" class="nav-link">
                        INJURIES
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#physical-structure" data-toggle="tab" aria-expanded="false" class="nav-link">
                        PHYSICAL STRUCTURE
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#strengths-weeknesses" data-toggle="tab" aria-expanded="false" class="nav-link">
                        STRENGTHS & WEEKNESSES
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane show active" id="report">
                    <form role="form" method="post" action="">
                        <textarea class="form-control" id="report-area" rows="5"></textarea>
                        <button type="submit" class="btn btn-info waves-effect waves-light mt-1">Save</button>
                    </form>
                </div>
                <div class="tab-pane" id="injuries">
                </div>
                <div class="tab-pane" id="physical-structure">
                </div>
                <div class="tab-pane" id="strengths-weeknesses">
                </div>
            </div>
        </div> <!-- end card-box-->
    </div>
</div>

@endsection
@section('scripts')
@parent
    <!-- Soccer Field Diagram -->
    <script src="{{ asset('soccer_field/js/jquery.soccerfield.min.js') }}"></script>
    <!-- Moment JS -->
    <script src="{{ asset('user_assets/libs/moment/moment.min.js') }}"></script>
    <!-- Chart JS -->
    <script src="{{ asset('user_assets/libs/chart-js/Chart.bundle.min.js') }}"></script>
    <!-- Init js -->
    {{-- <script src="{{ asset('user_assets/js/pages/chartjs.init.js') }}"></script> --}}
    <script>
        $(document).ready(function () {
            var options =  {
                field: {
                    width: "320px",
                    height: "200px",
                    img: "{{ asset('soccer_field/img/soccerfield_green.png') }} ",
                    startHidden: true,
                    animate: true,
                    fadeTime: 400,
                    autoReveal:true,
                    onReveal: function () {

                    }
                },
                players: {
                    font_size: 12,
                    reveal: true,
                    sim: false,
                    timeout: 1000,
                    fadeTime: 400,
                    // img: 'img/soccer-player.png',
                    onReveal: function () {
                        // alert("players revealed!");
                    }
                }
            };
            var data = [];
            var mainposition = "{{ $data->main_pos }}";
            if (mainposition == "Goalkeeper")
            {
                data.push({name: ' ', position: 'C_GK'});
            } else {
                var subpositions = @php echo $data->subpositions; @endphp;
                for (one in subpositions)
                {
                    var position = subpositions[one].position;
                    if (position == "Sweeper") data.push({name: ' ', position: 'C_SW'});
                    if (position == "Left Full-back") data.push({name: ' ', position: 'L_B'});
                    if (position == "Centre-back") data.push({name: ' ', position: 'C_B'});
                    if (position == "Right Full-back") data.push({name: ' ', position: 'R_B'});
                    if (position == "Left Wing-back") data.push({name: ' ', position: 'L_WB'});
                    if (position == "Right Wing-back") data.push({name: ' ', position: 'R_WB'});
                    if (position == "Defensive midfield") data.push({name: ' ', position: 'C_DM'});
                    if (position == "Left Wide midfield") data.push({name: ' ', position: 'L_M'});
                    if (position == "Centre midfield") data.push({name: ' ', position: 'C_M'});
                    if (position == "Right Wide midfield") data.push({name: ' ', position: 'R_M'});
                    if (position == "Attacking midfield") data.push({name: ' ', position: 'C_AM'});
                    if (position == "Left Winger") data.push({name: ' ', position: 'L_W'});
                    if (position == "Second striker") data.push({name: ' ', position: 'C_W'});
                    if (position == "Right Winger") data.push({name: ' ', position: 'R_W'});
                    if (position == "Centre forward") data.push({name: ' ', position: 'C_F'});
                }
            }
            console.log(data);
            $("#soccerfield").soccerfield(data,options);
            Chart.defaults.global.defaultFontColor = "rgba(255,255,255,0.5)";
            Chart.defaults.scale.gridLines.color = "rgba(255,255,255,0.05)";
            let general_radar_data = ['{{ $data->marking }}', '{{ $data->passing }}', '{{ $data->technique }}', '{{ $data->vision }}', '{{ $data->tackling }}'];
            let general_sum = 0;
            for (let i = 0; i < general_radar_data.length; i++)
            {
                general_sum += parseFloat(general_radar_data[i]==''?0:general_radar_data[i]);
            }
            let general_avg = (general_sum / general_radar_data.length).toFixed(1);
            $("#general_average").text(general_avg);
            $("#general_avg").text(general_avg);
            new Chart(document.getElementById("general-radar").getContext("2d"), {
                type: 'radar',
                data: {
                    labels: ['Marking', 'Passing', 'Technique', 'Vision', 'Tackling'],
                    datasets: [{
                        label: "",
                        backgroundColor: "rgba(57,175,209,0.2)",
                        borderColor: "#39afd1",
                        pointBackgroundColor: "#39afd1",
                        pointBorderColor: "#fff",
                        pointHoverBackgroundColor: "#fff",
                        pointHoverBorderColor: "#39afd1",
                        data: general_radar_data
                    },]
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
            let technical_radar_data = ['{{ $data->corners }}', '{{ $data->crossing }}', '{{ $data->dribbling }}', '{{ $data->finishing }}', '{{ $data->first_touch }}', '{{ $data->free_kick }}'
                , '{{ $data->heading }}', '{{ $data->long_shots }}', '{{ $data->long_throws }}', '{{ $data->marking }}', '{{ $data->passing }}', '{{ $data->penalty_taking }}'
                , '{{ $data->tackling }}', '{{ $data->technique }}'];
            let sum = 0;
            for (let i = 0; i < technical_radar_data.length; i++)
            {
                sum += parseFloat(technical_radar_data[i]==''?0:technical_radar_data[i]);
            }
            let avg = (sum / technical_radar_data.length).toFixed(1);
            $("#technical_average").text(avg);
            new Chart(document.getElementById("technical-radar").getContext("2d"), {
                type: 'radar',
                data: {
                    labels: ['Corners', 'Crossing', 'Dribbling', 'Finishing', 'First Touch', 'Free Kick Taking', 'Heading', 'Long Shots'
                        , 'Long Throws', 'Marking', 'Passing', 'Penalty Taking', 'Tackling', 'Technique'],
                    datasets: [{
                        label: "",
                        backgroundColor: "rgba(57,175,209,0.2)",
                        borderColor: "#39afd1",
                        pointBackgroundColor: "#39afd1",
                        pointBorderColor: "#fff",
                        pointHoverBackgroundColor: "#fff",
                        pointHoverBorderColor: "#39afd1",
                        data: technical_radar_data
                    },]
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

            let mental_radar_data = ['{{ $data->aggression }}', '{{ $data->articipation }}', '{{ $data->bravery }}', '{{ $data->composure }}', '{{ $data->concentration }}', '{{ $data->decisions }}'
                , '{{ $data->determination }}', '{{ $data->flair }}', '{{ $data->leadership }}', '{{ $data->off_ball }}', '{{ $data->positioning }}', '{{ $data->teamwork }}'
                , '{{ $data->vision }}', '{{ $data->work_rate }}'];
            let mental_sum = 0;
            for (let i = 0; i < mental_radar_data.length; i++)
            {
                mental_sum += parseFloat(mental_radar_data[i]==''?0:mental_radar_data[i]);
            }
            let mental_avg = (mental_sum / mental_radar_data.length).toFixed(1);
            $("#mental_average").text(mental_avg);
            new Chart(document.getElementById("mental-radar").getContext("2d"), {
                type: 'radar',
                data: {
                    labels: ['Aggression', 'Articipation', 'Bravery', 'Composure', 'Concentration', 'Decisions', 'Determination'
                        , 'Flair', 'Leadership', 'Off the ball', 'Positioning', 'Teamwork', 'Vision', 'Work Rate'],
                    datasets: [{
                        label: "",
                        backgroundColor: "rgba(57,175,209,0.2)",
                        borderColor: "#39afd1",
                        pointBackgroundColor: "#39afd1",
                        pointBorderColor: "#fff",
                        pointHoverBackgroundColor: "#fff",
                        pointHoverBorderColor: "#39afd1",
                        data: mental_radar_data
                    },]
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
            let physical_radar_data = ['{{ $data->acceleration }}', '{{ $data->agility }}', '{{ $data->balance }}', '{{ $data->jumping_reach }}', '{{ $data->natural_fitness }}', '{{ $data->pace }}'
                , '{{ $data->stamina }}', '{{ $data->strength }}'];
            let physical_sum = 0;
            for (let i = 0; i < physical_radar_data.length; i++)
            {
                physical_sum += parseFloat(physical_radar_data[i]==''?0:physical_radar_data[i]);
            }
            let physical_avg = (physical_sum / physical_radar_data.length).toFixed(1);
            $("#physical_average").text(physical_avg);
            new Chart(document.getElementById("physical-radar").getContext("2d"), {
                type: 'radar',
                data: {
                    labels: ['Acceleration', 'Agility', 'Balance', 'Jumping Reach', 'Natural Fitness', 'Pace', 'Stamina', 'Strength'],
                    datasets: [{
                        label: "",
                        backgroundColor: "rgba(57,175,209,0.2)",
                        borderColor: "#39afd1",
                        pointBackgroundColor: "#39afd1",
                        pointBorderColor: "#fff",
                        pointHoverBackgroundColor: "#fff",
                        pointHoverBorderColor: "#39afd1",
                        data: physical_radar_data
                    },]
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
        });
    </script>
@endsection