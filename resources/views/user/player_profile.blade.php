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
        }
        .rotated { 
            -webkit-transform: rotate(90deg);
            -moz-transform: rotate(90deg);
            -o-transform: rotate(90deg);
            -ms-transform: rotate(90deg);
            transform: rotate(90deg);
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
                    <div class="col-md-6 row">
                        <div class="col-md-auto">
                            <img src="{{ asset('user_assets/images/users/standard.png') }}" class="user-photo ml-5" height="130px" alt="">
                            <div class="card text-white text-center bg-primary text-xs-center mt-1 mb-0 ml-5" style="width: 130px">
                                <p class="mb-0 mt-1" style="line-height: 15px">General</p>
                                <p class="mb-0" style="line-height: 15px">average</p>
                                <p class="mb-0 font-18 font-weight-bold">7.6</p>
                            </div>
                        </div>
                        <div class="col-md-auto">
                            <p class="font-weight-bold font-17 mt-1 mb-1">Gabriel Barbosa</p>
                            <p>
                                <i class="fas fa-calendar font-weight-bold"></i><span class="ml-1">1996</span>
                                <i class="fas fa-arrows-alt-v font-weight-bold ml-2"></i><span class="ml-1">178cm</span>
                                <i class="fas fa-flag font-weight-bold ml-2"></i><span class="ml-1">Brazil</span>
                            </p>
                            <p class="mt-2 mb-0">
                                <span class="font-weight-bold">Current Team</span> Flamengo
                            </p>
                            <p class="mt-0">
                                <span class="font-weight-bold">League</span> Flamengo-Brazil(BR)
                            </p>
                            <p class="mt-2">
                                <span class="font-weight-bold">Prefered foot</span> left
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
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
                                <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="crossing">Crossing</label>
                            <div class="progress mb-2 progress-lg">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="dribbling">Dribbling</label>
                            <div class="progress mb-2 progress-lg">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="finishing">Finishing</label>
                            <div class="progress mb-2 progress-lg">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="first_touch">First Touch</label>
                            <div class="progress mb-2 progress-lg">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="free_kick">Free Kick Taking</label>
                            <div class="progress mb-2 progress-lg">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="heading">Heading</label>
                            <div class="progress mb-2 progress-lg">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="long_shots">Long Shots</label>
                            <div class="progress mb-2 progress-lg">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="long_throws">Long Throws</label>
                            <div class="progress mb-2 progress-lg">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="marking">Marking</label>
                            <div class="progress mb-2 progress-lg">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="passing">Passing</label>
                            <div class="progress mb-2 progress-lg">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="penalty_taking">Penalty Taking</label>
                            <div class="progress mb-2 progress-lg">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tacking">Tacking</label>
                            <div class="progress mb-2 progress-lg">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="technique">Technique</label>
                            <div class="progress mb-2 progress-lg">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
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
                                <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="articipation">Articipation</label>
                            <div class="progress mb-2 progress-lg">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="bravery">Bravery</label>
                            <div class="progress mb-2 progress-lg">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="composure">Composure</label>
                            <div class="progress mb-2 progress-lg">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="concentration">Concentration</label>
                            <div class="progress mb-2 progress-lg">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="decisions">Decisions</label>
                            <div class="progress mb-2 progress-lg">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="determination">Determination</label>
                            <div class="progress mb-2 progress-lg">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="flair">Flair</label>
                            <div class="progress mb-2 progress-lg">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="leadership">Leadership</label>
                            <div class="progress mb-2 progress-lg">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="off_ball">Off The Ball</label>
                            <div class="progress mb-2 progress-lg">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="positioning">Positioning</label>
                            <div class="progress mb-2 progress-lg">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="teamwork">Teamwork</label>
                            <div class="progress mb-2 progress-lg">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="vision">Vision</label>
                            <div class="progress mb-2 progress-lg">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="work_rate">Work Rate</label>
                            <div class="progress mb-2 progress-lg">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
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
                                <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="agility">Agility</label>
                            <div class="progress mb-2 progress-lg">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="balance">Balance</label>
                            <div class="progress mb-2 progress-lg">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="jumping_reach">Jumping Reach</label>
                            <div class="progress mb-2 progress-lg">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="natural_fitness">Natural Fitness</label>
                            <div class="progress mb-2 progress-lg">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="pace">Pace</label>
                            <div class="progress mb-2 progress-lg">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="stamina">Stamina</label>
                            <div class="progress mb-2 progress-lg">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="strength">Strength</label>
                            <div class="progress mb-2 progress-lg">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="dropdown-divider"></div>
                        <div class="card-title font-15 font-weight-bold">
                            Technical average
                        </div>
                        <div class="mt-2 chartjs-chart">
                            <canvas id="technical-radar" height="150"></canvas>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="dropdown-divider"></div>
                        <div class="card-title font-15 font-weight-bold">
                            Mental average
                        </div>
                        <div class="mt-2 chartjs-chart">
                            <canvas id="mental-radar" height="150"></canvas>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="dropdown-divider"></div>
                        <div class="card-title font-15 font-weight-bold">
                            Physical average
                        </div>
                        <div class="mt-2 chartjs-chart">
                            <canvas id="physical-radar" height="150"></canvas>
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
                    General average
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
                        <button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
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
        var data = [
            {name: '1', position: 'C_GK'},
            {name: '2', position: 'LC_B'},
            {name: '3', position: 'C_B'},
            {name: '4', position: 'RC_B'},
            {name: '5', position: 'C_DM'},
            {name: '6', position: 'L_M'},
            {name: '7', position: 'LC_M'},
            {name: '8', position: 'RC_M'},
            {name: '9', position: 'R_M'},
            {name: '10', position: 'LC_F'},
            {name: '11', position: 'RC_F'},
        ];
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
            $("#soccerfield").soccerfield(data,options);
            Chart.defaults.global.defaultFontColor = "rgba(255,255,255,0.5)";
            Chart.defaults.scale.gridLines.color = "rgba(255,255,255,0.05)";
            new Chart(document.getElementById("general-radar").getContext("2d"), {
                type: 'radar',
                data: {
                    labels: ['Corners', 'Crossing', 'Dribbling', 'Finishing', 'First Touch', 'Free Kick Taking', 'Heading', 'Long Shots'],
                    datasets: [{
                        label: "Desktops",
                        backgroundColor: "rgba(57,175,209,0.2)",
                        borderColor: "#39afd1",
                        pointBackgroundColor: "#39afd1",
                        pointBorderColor: "#fff",
                        pointHoverBackgroundColor: "#fff",
                        pointHoverBorderColor: "#39afd1",
                        data: [8, 8, 8, 8.5, 7.5, 7.5, 7, 7 ]
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
            new Chart(document.getElementById("technical-radar").getContext("2d"), {
                type: 'radar',
                data: {
                    labels: ['Corners', 'Crossing', 'Dribbling', 'Finishing', 'First Touch', 'Free Kick Taking', 'Heading', 'Long Shots'],
                    datasets: [{
                        label: "Desktops",
                        backgroundColor: "rgba(57,175,209,0.2)",
                        borderColor: "#39afd1",
                        pointBackgroundColor: "#39afd1",
                        pointBorderColor: "#fff",
                        pointHoverBackgroundColor: "#fff",
                        pointHoverBorderColor: "#39afd1",
                        data: [8, 8, 8, 8.5, 7.5, 7.5, 7, 7 ]
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
            new Chart(document.getElementById("mental-radar").getContext("2d"), {
                type: 'radar',
                data: {
                    labels: ['Corners', 'Crossing', 'Dribbling', 'Finishing', 'First Touch', 'Free Kick Taking', 'Heading', 'Long Shots'],
                    datasets: [{
                        label: "Desktops",
                        backgroundColor: "rgba(57,175,209,0.2)",
                        borderColor: "#39afd1",
                        pointBackgroundColor: "#39afd1",
                        pointBorderColor: "#fff",
                        pointHoverBackgroundColor: "#fff",
                        pointHoverBorderColor: "#39afd1",
                        data: [8, 8, 8, 8.5, 7.5, 7.5, 7, 7 ]
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
            new Chart(document.getElementById("physical-radar").getContext("2d"), {
                type: 'radar',
                data: {
                    labels: ['Corners', 'Crossing', 'Dribbling', 'Finishing', 'First Touch', 'Free Kick Taking', 'Heading', 'Long Shots'],
                    datasets: [{
                        label: "Desktops",
                        backgroundColor: "rgba(57,175,209,0.2)",
                        borderColor: "#39afd1",
                        pointBackgroundColor: "#39afd1",
                        pointBorderColor: "#fff",
                        pointHoverBackgroundColor: "#fff",
                        pointHoverBorderColor: "#39afd1",
                        data: [8, 8, 8, 8.5, 7.5, 7.5, 7, 7 ]
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