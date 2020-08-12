<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>{{ env('APP_NAME', 'Soccer Compare') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('admin_assets/images/logo-sm.png') }}">

    <!-- App css -->
    <link href="{{ asset('admin_assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('soccer_field/css/soccerfield.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('soccer_field/css/soccerfield.default.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <style>
        .content-page {
            margin-left: 0px;
            overflow: hidden;
            padding: 0 15px 5px 15px;
            min-height: 80vh;
            margin-top: 10px;
        }
        .soccerfield-player span {
            font-size: 8px !important;
            width: 15px !important;
            min-height: 15px !important;
            max-height: 15px !important;
            border-radius: 50%;
            margin-top: 14px !important;
            margin-left: 6px !important;
            border : none !important;
            background : #E7C675; /*linear-gradient(to left, #00c6ff, #000000) !important;*/
            color: black;
            font-weight: 1000;
        }
        .soccerfield-field {
            margin: auto !important;
        }
        .soccerfield-field-container {
            margin: auto !important;
        }
        @media (max-width: 576px) {
            .soccerfield-field
            {
                width: 280px !important;
            }
        }
    </style>
</head>
@php
    function getColor($val)
    {
        $color = "#d3d3d3";
        $val = floatval($val);
        if ($val >= 5 && $val < 6)
        {
            $color = "#fc3639";
        } else if ($val >= 6 && $val < 7)
        {
            $color = "#F8696B";
        } else if ($val >= 7 && $val < 7.5)
        {
            $color = "#FBAA77";
        } else if ($val >= 7.5 && $val < 8)
        {
            $color = "#DAE495";
        } else if ($val >= 8 && $val < 8.5)
        {
            $color = "#FFEB84";
        } else if ($val >= 8.5 && $val < 9)
        {
            $color = "#63BE7B";
        } else if ($val >= 9 && $val < 10)
        {
            $color = "#63BE7B";
        }
        return $color;
    }
@endphp
<body>
    <div id="wrapper">
        <div class="content-page">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-5 offset-1">
                            <a class="btn btn-primary mb-2" href="{{ route('user.player_profile', $data->id) }}"><- Go to profile</a>
                        </div>
                        <div class="col-md-5 text-right">
                            <button class="btn btn-success mb-2" onclick="download()">Download PDF</button>
                        </div>
                    </div>
                    <div class="row" id="content" style="background: #F2F5F7">
                        <div style="margin: auto;width: 1378px;" id="page1">
                            <div class="row" style="height: 70px; background: #FF4040">
                                <div class="bg-white ml-5">
                                    <img src="{{ asset('storage').'/'.$team_url }}" style="width: 120px; height: 120px;" />
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-12 text-center">
                                    <h1>Scout Report</h1>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-4 text-center">
                                    <p class="font-weight-bold font-24">{{ $data->name }}</p>
                                    @if(isset($data->photo))
                                        <div style="width: 250px; height: 250px; margin: auto;
                                                background-repeat: no-repeat;background-size: 250px 250px; background-image:
                                                url({{ asset('storage').'/'.$data->photo }});"></div>
                                    @else
                                        <div style="width: 250px; height: 250px; margin: auto;
                                                background-repeat: no-repeat;background-size: 250px 250px; background-image:
                                                url({{ asset('admin_assets/images/users/standard.png') }});"></div>
                                    @endif
                                    <p class="font-19 mt-3 mb-0">Actual Club</p>
                                    <p class="font-weight-bold font-22">{{ $data->current_team }}</p>
                                </div>
                                <div class="col-md-3">
                                    <p class="font-17 mt-4 mb-0">Date of birth</p>
                                    @php
                                        $year = date("Y", strtotime($data->birth_date));
                                        $age = (date('Y') - $year);
                                    @endphp
                                    <p class="font-17 font-weight-bold mb-0">{{ $data->birth_date }} <span class="ml-3">{{ $age }} years</span></p>
                                    <p class="font-17 mt-1 mb-0">Nationality</p>
                                    <p class="font-17 font-weight-bold mb-0">{{ $data->nationality }}</p>
                                    <p class="font-17 mt-1 mb-0">Height</p>
                                    <p class="font-17 font-weight-bold mb-0">{{ $data->height }} cm</p>
                                    <p class="font-17 mt-1 mb-0">Weight</p>
                                    <p class="font-17 font-weight-bold mb-0">{{ $data->weight }} kg</p>
                                    <p class="font-17 mt-1 mb-0">Foot</p>
                                    <p class="font-17 font-weight-bold mb-0">{{ $data->foot }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p class="font-17 mt-4 mb-0">Languages</p>
                                    <p class="font-17 font-weight-bold mb-0">{{$data->additional->languages ?? ''}}</p>
                                    <p class="font-17 mt-1 mb-0">National Team</p>
                                    <p class="font-17 font-weight-bold mb-0">{{ isset($data->additional->first_appearance_team) ? $data->additional->getNationalTeamName() : '' }}</p>
                                    <p class="font-17 mt-1 mb-0">First appearance</p>
                                    <p class="font-17 font-weight-bold mb-0">{{ $data->additional->first_appearance_date ?? '' }}</p>
                                    <p class="font-17 mt-1 mb-0">First appearance in first division</p>
                                    <p class="font-17 font-weight-bold mb-0">{{ isset($data->additional->first_appearance_team) ? $data->additional->getFirstAppearanceTeamName() : '' }}
                                        <span class="ml-3">{{ $data->additional->first_appearance_division ?? '' }}</span>
                                    </p>
                                    <p class="font-17 mt-1 mb-0">Contract Expires</p>
                                    <p class="font-17 font-weight-bold mb-0">{{ $data->additional->contact_expires ?? '' }}</p>
                                    <p class="font-17 mt-1 mb-0">Market Value</p>
                                    <p class="font-17 font-weight-bold mb-0">{{ $data->additional->market_value ?? '' }} EUR</p>
                                </div>
                                <div class="col-md-1">
                                    <div class="text-center font-20"
                                         style="position: absolute; width: 200px; height: 50px;
                                            border: 2px solid #00AF80; padding-top: 10px; cursor: pointer;
                                            right: 50px; top: -50px;">
                                        <a href="{{ $data->video->main_video ?? '' }}" style="color: #00AF80;">
                                            Watch Video
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-4">
                                    <div id="soccerfield"></div>
                                </div>
                                <div class="col-md-3">
                                    @php $i = 0; @endphp
                                    @foreach($data->positions as $position)
                                        @if ($i == 0)
                                            <p class="font-17 mb-0">Main Position : </p>
                                        @elseif ($i == 1)
                                            <p class="font-17 mt-2 mb-0">Other Position : </p>
                                        @endif
                                        <p class="font-17 font-weight-bold mb-0">{{ $position->specify }}</p>
                                        @php ++$i; @endphp
                                    @endforeach
                                </div>
                                <div class="col-md-4">
                                    <p class="font-17 mb-0">General Information</p>
                                    <p class="font-17 font-weight-bold mb-0">{{ $data->scout_report->general_info ?? '' }}</p>
                                    <p class="font-17 mt-4 mb-0">Strengths</p>
                                    <p class="font-17 font-weight-bold mb-0">{{ $data->scout_report->strengths ?? '' }}</p>
                                    <p class="font-17 mt-4 mb-0">Weaknesses</p>
                                    <p class="font-17 font-weight-bold mb-0">{{ $data->scout_report->weaknesses ?? '' }}</p>
                                </div>
                                <div class="col-md-1"></div>
                            </div>
                        </div>
                        <div style="margin: auto; width: 1378px;" id="page2">
                            <div class="row" style="min-height: 70px;height: 70px; background: #FF4040">
                                <div class="ml-5" style="width: 120px; height: 120px;">
                                    <a href="#" style="color: #FF4040">Header Bar</a>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-5 mt-4 offset-1">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="card-title font-15 font-weight-bold mb-0">
                                                Technical
                                            </div>
                                            <table type="technical" width="100%">
                                                <tr>
                                                    <td class="font-16" for="corners">Corners</td>
                                                    <td class="font-16" width="50" align="center" style="background: {{ getColor($data->latestParam->corners) }}; color: black;">{{ $data->latestParam->corners }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-16" for="crossing">Crossing</td>
                                                    <td class="font-16" width="50" align="center" style="background: {{ getColor($data->latestParam->crossing) }}; color: black;">{{ $data->latestParam->crossing }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-16" for="dribbling">Dribbling</td>
                                                    <td class="font-16" width="50" align="center" style="background: {{ getColor($data->latestParam->dribbling) }}; color: black;">{{ $data->latestParam->dribbling }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-16" for="finishing">Finishing</td>
                                                    <td class="font-16" style="background: {{ getColor($data->latestParam->finishing) }}; color: black;"
                                                        width="50" align="center">{{ $data->latestParam->finishing }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-16" for="aerial_reach">Aerial Reach</td>
                                                    <td class="font-16" style="background: {{ getColor($data->latestParam->aerial_reach) }}; color: black;"
                                                        width="50" align="center">{{ $data->latestParam->aerial_reach }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-16" for="command_of_area">Command Of Area</td>
                                                    <td class="font-16" style="background: {{ getColor($data->latestParam->command_of_area) }}; color: black;"
                                                        width="50" align="center">{{ $data->latestParam->command_of_area }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-16" for="communication">Communication</td>
                                                    <td class="font-16" style="background: {{ getColor($data->latestParam->communication) }}; color: black;"
                                                        width="50" align="center">{{ $data->latestParam->communication }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-16" for="eccentricity">Eccentricity</td>
                                                    <td class="font-16" style="background: {{ getColor($data->latestParam->eccentricity) }}; color: black;"
                                                        width="50" align="center">{{ $data->latestParam->eccentricity }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-16" for="first_touch">First Touch</td>
                                                    <td class="font-16" style="background: {{ getColor($data->latestParam->first_touch) }}; color: black;"
                                                        width="50" align="center">{{ $data->latestParam->first_touch }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-16" for="handling">Handling</td>
                                                    <td class="font-16" style="background: {{ getColor($data->latestParam->handling) }}; color: black;"
                                                        width="50" align="center">{{ $data->latestParam->handling }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-16" for="kicking">Kicking</td>
                                                    <td class="font-16" style="background: {{ getColor($data->latestParam->kicking) }}; color: black;"
                                                        width="50" align="center">{{ $data->latestParam->kicking }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-16" for="one_on_ones">One On Ones</td>
                                                    <td class="font-16" style="background: {{ getColor($data->latestParam->one_on_ones) }}; color: black;"
                                                        width="50" align="center">{{ $data->latestParam->one_on_ones }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-16" for="feet_playing">Feet playing</td>
                                                    <td class="font-16" style="background: {{ getColor($data->latestParam->feet_playing) }}; color: black;"
                                                        width="50" align="center">{{ $data->latestParam->feet_playing }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-16" for="free_kick">Free Kick Taking</td>
                                                    <td class="font-16" style="background: {{ getColor($data->latestParam->free_kick) }}; color: black;"
                                                        width="50" align="center">{{ $data->latestParam->free_kick }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-16" for="heading">Heading</td>
                                                    <td class="font-16" style="background: {{ getColor($data->latestParam->heading) }}; color: black;"
                                                        width="50" align="center">{{ $data->latestParam->heading }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-16" for="shots">Shots</td>
                                                    <td class="font-16" style="background: {{ getColor($data->latestParam->shots) }}; color: black;"
                                                        width="50" align="center">{{ $data->latestParam->shots }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-16" for="long_shots">Long Shots</td>
                                                    <td class="font-16" style="background: {{ getColor($data->latestParam->long_shots) }}; color: black;"
                                                        width="50" align="center">{{ $data->latestParam->long_shots }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-16" for="long_throws">Long Throws</td>
                                                    <td class="font-16" style="background: {{ getColor($data->latestParam->long_throws) }}; color: black;"
                                                        width="50" align="center">{{ $data->latestParam->long_throws }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-16" for="marking">Marking</td>
                                                    <td class="font-16" style="background: {{ getColor($data->latestParam->marking) }}; color: black;"
                                                        width="50" align="center">{{ $data->latestParam->marking }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-16" for="passing">Passing</td>
                                                    <td class="font-16" style="background: {{ getColor($data->latestParam->passing) }}; color: black;"
                                                        width="50" align="center">{{ $data->latestParam->passing }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-16" for="long_pass">Long Pass</td>
                                                    <td class="font-16" style="background: {{ getColor($data->latestParam->long_pass) }}; color: black;"
                                                        width="50" align="center">{{ $data->latestParam->long_pass }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-16" for="punching">Punching</td>
                                                    <td class="font-16" style="background: {{ getColor($data->latestParam->punching) }}; color: black;"
                                                        width="50" align="center">{{ $data->latestParam->punching }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-16" for="reflexes">Reflexes</td>
                                                    <td class="font-16" style="background: {{ getColor($data->latestParam->reflexes) }}; color: black;"
                                                        width="50" align="center">{{ $data->latestParam->reflexes }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-16" for="rushing_out">Rushing Out</td>
                                                    <td class="font-16" style="background: {{ getColor($data->latestParam->rushing_out) }}; color: black;"
                                                        width="50" align="center">{{ $data->latestParam->rushing_out }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-16" for="throwing">Throwing</td>
                                                    <td class="font-16" style="background: {{ getColor($data->latestParam->throwing) }}; color: black;"
                                                        width="50" align="center">{{ $data->latestParam->throwing }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-16" for="penalty_taking">Penalty Taking</td>
                                                    <td class="font-16" style="background: {{ getColor($data->latestParam->penalty_taking) }}; color: black;"
                                                        width="50" align="center">{{ $data->latestParam->penalty_taking }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-16" for="tackling">Tackling</td>
                                                    <td class="font-16" style="background: {{ getColor($data->latestParam->tackling) }}; color: black;"
                                                        width="50" align="center">{{ $data->latestParam->tackling }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-16" for="technique">Technique</td>
                                                    <td class="font-16" style="background: {{ getColor($data->latestParam->technique) }}; color: black;"
                                                        width="50" align="center">{{ $data->latestParam->technique }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-16" for="offensive">1 VS 1 Offensive</td>
                                                    <td class="font-16" style="background: {{ getColor($data->latestParam->offensive) }}; color: black;"
                                                        width="50" align="center">{{ $data->latestParam->offensive }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-16" for="deffense">1 VS 1 Deffense</td>
                                                    <td class="font-16" style="background: {{ getColor($data->latestParam->deffense) }}; color: black;"
                                                        width="50" align="center">{{ $data->latestParam->deffense }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-md-7">
                                            <canvas id="technical-radar" height="200"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5 mt-4">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <canvas id="mental-radar" height="200"></canvas>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="card-title font-15 font-weight-bold mb-0">
                                                Mental
                                            </div>
                                            <table type="mental" width="100%">
                                        <tr>
                                            <td class="font-16" for="aggression">Aggression</td>
                                            <td class="font-16" width="50" align="center" style="
                                                    background: {{ getColor($data->latestParam->aggression) }}; color: black;">
                                                {{ $data->latestParam->aggression }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-16" for="anticipation">Anticipation</td>
                                            <td class="font-16" width="50" align="center" style="
                                                    background: {{ getColor($data->latestParam->anticipation) }}; color: black;">
                                                {{ $data->latestParam->anticipation }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-16" for="bravery">Bravery</td>
                                            <td class="font-16" width="50" align="center" style="
                                                    background: {{ getColor($data->latestParam->bravery) }}; color: black;">
                                                {{ $data->latestParam->bravery }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-16" for="composure">Composure</td>
                                            <td class="font-16" width="50" align="center" style="
                                                    background: {{ getColor($data->latestParam->composure) }}; color: black;">
                                                {{ $data->latestParam->composure }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-16" for="concentration">Concentration</td>
                                            <td class="font-16" width="50" align="center" style="
                                                    background: {{ getColor($data->latestParam->concentration) }}; color: black;">
                                                {{ $data->latestParam->concentration }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-16" for="decisions">Decisions</td>
                                            <td class="font-16" width="50" align="center" style="
                                                    background: {{ getColor($data->latestParam->decisions) }}; color: black;">
                                                {{ $data->latestParam->decisions }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-16" for="determination">Determination</td>
                                            <td class="font-16" width="50" align="center" style="
                                                    background: {{ getColor($data->latestParam->determination) }}; color: black;">
                                                {{ $data->latestParam->determination }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-16" for="flair">Flair</td>
                                            <td class="font-16" width="50" align="center" style="
                                                    background: {{ getColor($data->latestParam->flair) }}; color: black;">
                                                {{ $data->latestParam->flair }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-16" for="leadership">Leadership</td>
                                            <td class="font-16" width="50" align="center" style="
                                                    background: {{ getColor($data->latestParam->leadership) }}; color: black;">
                                                {{ $data->latestParam->leadership }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-16" for="off_ball">Off The Ball</td>
                                            <td class="font-16" width="50" align="center" style="
                                                    background: {{ getColor($data->latestParam->off_ball) }}; color: black;">
                                                {{ $data->latestParam->off_ball }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-16" for="positioning">Positioning</td>
                                            <td class="font-16" width="50" align="center" style="
                                                    background: {{ getColor($data->latestParam->positioning) }}; color: black;">
                                                {{ $data->latestParam->positioning }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-16" for="teamwork">Teamwork</td>
                                            <td class="font-16" width="50" align="center" style="
                                                    background: {{ getColor($data->latestParam->teamwork) }}; color: black;">
                                                {{ $data->latestParam->teamwork }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-16" for="vision">Vision</td>
                                            <td class="font-16" width="50" align="center" style="
                                                    background: {{ getColor($data->latestParam->vision) }}; color: black;">
                                                {{ $data->latestParam->vision }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-16" for="work_rate">Work Rate</td>
                                            <td class="font-16" width="50" align="center" style="
                                                    background: {{ getColor($data->latestParam->work_rate) }}; color: black;">
                                                {{ $data->latestParam->work_rate }}
                                            </td>
                                        </tr>
                                    </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5 mt-4 offset-1">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="card-title font-15 font-weight-bold mb-0">
                                                Physical
                                            </div>
                                            <table type="physical" width="100%">
                                                <tr>
                                                    <td class="font-16" for="acceleration">Acceleration</td>
                                                    <td class="font-16" width="50" align="center" style="
                                                            background: {{ getColor($data->latestParam->acceleration) }}; color: black;">
                                                        {{ $data->latestParam->acceleration }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="font-16" for="aerial_duels">Aerial Duels</td>
                                                    <td class="font-16" width="50" align="center" style="
                                                            background: {{ getColor($data->latestParam->aerial_duels) }}; color: black;">
                                                        {{ $data->latestParam->aerial_duels }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="font-16" for="agility">Agility</td>
                                                    <td class="font-16" width="50" align="center" style="
                                                            background: {{ getColor($data->latestParam->agility) }}; color: black;">
                                                        {{ $data->latestParam->agility }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="font-16" for="balance">Balance</td>
                                                    <td class="font-16" width="50" align="center" style="
                                                            background: {{ getColor($data->latestParam->balance) }}; color: black;">
                                                        {{ $data->latestParam->balance }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="font-16" for="jumping_reach">Jumping Reach</td>
                                                    <td class="font-16" width="50" align="center" style="
                                                            background: {{ getColor($data->latestParam->jumping_reach) }}; color: black;">
                                                        {{ $data->latestParam->jumping_reach }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="font-16" for="natural_fitness">Natural Fitness</td>
                                                    <td class="font-16" width="50" align="center" style="
                                                            background: {{ getColor($data->latestParam->natural_fitness) }}; color: black;">
                                                        {{ $data->latestParam->natural_fitness }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="font-16" for="pace">Pace</td>
                                                    <td class="font-16" width="50" align="center" style="
                                                            background: {{ getColor($data->latestParam->pace) }}; color: black;">
                                                        {{ $data->latestParam->pace }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="font-16" for="reaction">Reaction</td>
                                                    <td class="font-16" width="50" align="center" style="
                                                            background: {{ getColor($data->latestParam->reaction) }}; color: black;">
                                                        {{ $data->latestParam->reaction }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="font-16" for="sprint_speed">Sprint Speed</td>
                                                    <td class="font-16" width="50" align="center" style="
                                                            background: {{ getColor($data->latestParam->sprint_speed) }}; color: black;">
                                                        {{ $data->latestParam->sprint_speed }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="font-16" for="stamina">Stamina</td>
                                                    <td class="font-16" width="50" align="center" style="
                                                            background: {{ getColor($data->latestParam->stamina) }}; color: black;">
                                                        {{ $data->latestParam->stamina }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="font-16" for="strength">Strength</td>
                                                    <td class="font-16" width="50" align="center" style="
                                                            background: {{ getColor($data->latestParam->strength) }}; color: black;">
                                                        {{ $data->latestParam->strength }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="font-16" for="injury_resistance">Injury resistance</td>
                                                    <td class="font-16" width="50" align="center" style="
                                                            background: {{ getColor($data->latestParam->injury_resistance) }}; color: black;">
                                                        {{ $data->latestParam->injury_resistance }}
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-md-7">
                                            <canvas id="physical-radar" height="200"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5 mt-4">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <canvas id="general-radar" height="200"></canvas>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="card-title font-15 font-weight-bold mb-0">
                                                Average
                                            </div>
                                            <table type="average" width="100%">
                                                <tr>
                                                    <td class="font-16" for="acceleration">Acceleration</td>
                                                    <td class="font-16" width="50" align="center" style="color: black;">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="font-16" for="aerial_duels">Aerial Duels</td>
                                                    <td class="font-16" width="50" align="center" style="color: black;">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="font-16" for="agility">Agility</td>
                                                    <td class="font-16" width="50" align="center" style="color: black;">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="font-16" for="balance">Balance</td>
                                                    <td class="font-16" width="50" align="center" style="color: black;">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="font-16" for="jumping_reach">Jumping Reach</td>
                                                    <td class="font-16" width="50" align="center" style="color: black;">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="font-16" for="natural_fitness">Natural Fitness</td>
                                                    <td class="font-16" width="50" align="center" style="color: black;">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="font-16" for="pace">Pace</td>
                                                    <td class="font-16" width="50" align="center" style="color: black;">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="font-16" for="reaction">Reaction</td>
                                                    <td class="font-16" width="50" align="center" style="color: black;">
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div style="margin: auto; width: 1378px;" id="page3">
                            <div class="row" style="min-height: 70px;height: 70px; background: #FF4040">
                                <div class="ml-5" style="width: 120px; height: 120px;">
                                    <a href="#" style="color: #FF4040">Header Bar</a>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <p class="font-24 font-weight-bold text-center col-md-12">Injuires</p>
                                @php $i = 0; @endphp
                                @foreach($data->injury as $injury)
                                    <div class="col-md-12 text-center">
                                        <span class="font-19 text-center">{{ $injury->injury }}</span>
                                        <span class="font-13 text-center ml-3">{{ $injury->injury_date }}</span>
                                    </div>
                                    <p class="font-19 font-weight-bold col-md-4 offset-4">{{ $injury->description }}</p>
                                    @php ++$i; @endphp
                                @endforeach
                                @if ($i == 0)
                                    <p class="font-19 font-weight-bold col-md-4 offset-4">The Player doesn't show injuries</p>
                                @endif
                                <p class="font-24 font-weight-bold text-center col-md-12 mt-3">Report</p>
                                <p class="font-19 col-md-6 bg-success text-dark offset-3 mb-0">Pros</p>
                                <p class="font-17 col-md-6 text-dark offset-3 pl-3 pr-3 pt-1">{{ $data->scout_report->pros ?? '' }}</p>
                                <p class="font-19 col-md-6 bg-danger text-dark offset-3 mb-0 mt-3">Cons</p>
                                <p class="font-17 col-md-6 text-dark offset-3 pl-3 pr-3 pt-1">{{ $data->scout_report->cons ?? '' }}</p>
                                <p class="font-19 col-md-6 bg-success text-dark offset-3 mb-0 mt-3 text-center">
                                    Conclusion :
                                    @if (intval($data->scout_report->conclusion) == 1)
                                    Discard player
                                    @elseif (intval($data->scout_report->conclusion) == 2)
                                    Continue watching
                                    @elseif (intval($data->scout_report->conclusion) == 3)
                                    Sign the player
                                    @else
                                    No selected
                                    @endif
                                </p>
                                <p class="font-17 col-md-6 text-dark offset-3 pl-3 pr-3 pt-1">{{ $data->scout_report->other ?? '' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>
    <!-- Vendor js -->
    <script src="{{ asset('admin_assets/js/vendor.min.js') }}"></script>
    <!-- App js -->
    <script src="{{ asset('admin_assets/js/app.min.js') }}"></script>
    <script src="{{ asset('soccer_field/js/jquery.soccerfield.min.js') }}"></script>
    <script src="https://kendo.cdn.telerik.com/2017.2.621/js/jszip.min.js"></script>
    <script src="https://kendo.cdn.telerik.com/2017.2.621/js/kendo.all.min.js"></script>
    <!-- Moment JS -->
    <script src="{{ asset('user_assets/libs/moment/moment.min.js') }}"></script>
    <!-- Chart JS -->
    <script src="{{ asset('user_assets/libs/chart-js/Chart.bundle.min.js') }}"></script>
    <script>

        function download() {
            let width = 0.0264583333 * $("#page1").width();
            let height = 0.0264583333 * $("#page1").height();
            kendo.drawing
                .drawDOM("#content",
                    {
                        paperSize: [width + 'cm', height + 'cm'],
                        margin: { top: 0, bottom: 0, left: 0, right: 0 },
                        scale: 0.75
                        // width: 1000,
                        // height: 400
                    })
                .then(function(group){
                    kendo.drawing.pdf.saveAs(group, "Exported.pdf")
                });
        }
        let isGoalkeeper = 0;
        $(document).ready(function (){
            var options =  {
                field: {
                    width: "250px",
                    height: "400px",
                    img: "{{ asset('soccer_field/img/soccerfield_green4.png') }} ",
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
            @foreach($data->positions as $position)
            @if ($position->specify == "Sweeper") data.push({name: ' ', position: 'C_SW'}); @endif
            @if ($position->specify == "Left Full-back") data.push({name: ' ', position: 'L_B'}); @endif
            @if ($position->specify == "Centre-back") data.push({name: ' ', position: 'C_B'}); @endif
            @if ($position->specify == "Right Full-back") data.push({name: ' ', position: 'R_B'}); @endif
            @if ($position->specify == "Left Wing-back") data.push({name: ' ', position: 'L_WB'}); @endif
            @if ($position->specify == "Right Wing-back") data.push({name: ' ', position: 'R_WB'}); @endif
            @if ($position->specify == "Defensive midfield") data.push({name: ' ', position: 'C_DM'}); @endif
            @if ($position->specify == "Left Wide midfield") data.push({name: ' ', position: 'L_M'}); @endif
            @if ($position->specify == "Centre midfield") data.push({name: ' ', position: 'C_M'}); @endif
            @if ($position->specify == "Right Wide midfield") data.push({name: ' ', position: 'R_M'}); @endif
            @if ($position->specify == "Attacking midfield") data.push({name: ' ', position: 'C_AM'}); @endif
            @if ($position->specify == "Left Winger") data.push({name: ' ', position: 'L_W'}); @endif
            @if ($position->specify == "Second striker") data.push({name: ' ', position: 'C_S'}); @endif
            @if ($position->specify == "Right Winger") data.push({name: ' ', position: 'R_W'}); @endif
            @if ($position->specify == "Centre forward") data.push({name: ' ', position: 'C_F'}); @endif
            @if ($position->specify == "Goalkeeper") data.push({name: ' ', position: 'C_GK'}); @endif
            @if ($position->specify == "Left Centre-back") data.push({name: ' ', position: 'LC_B'}); @endif
            @if ($position->specify == "Right Centre-back") data.push({name: ' ', position: 'RC_B'}); @endif
            @if ($position->specify == "Left Defensive midfield") data.push({name: ' ', position: 'LC_DM'}); @endif
            @if ($position->specify == "Right Defensive midfield") data.push({name: ' ', position: 'RC_DM'}); @endif
            @if ($position->specify == "Left Centre midfield") data.push({name: ' ', position: 'LC_M'}); @endif
            @if ($position->specify == "Right Centre midfield") data.push({name: ' ', position: 'RC_M'}); @endif
            @if ($position->specify == "Left Attacking midfield") data.push({name: ' ', position: 'LC_AM'}); @endif
            @if ($position->specify == "Right Attacking midfield") data.push({name: ' ', position: 'RC_AM'}); @endif
            @if ($position->specify == "Left striker") data.push({name: ' ', position: 'LC_S'}); @endif
            @if ($position->specify == "Right striker") data.push({name: ' ', position: 'RC_S'}); @endif
            @if ($position->specify == "Left Centre forward") data.push({name: ' ', position: 'LC_F'}); @endif
            @if ($position->specify == "Right Centre forward") data.push({name: ' ', position: 'RC_F'}); @endif
            @endforeach
            $("#soccerfield").soccerfield(data,options);
            let posIndex = 0;
            for (const r in data) {
                let before = data[r].position.split("_")[0];
                let after = data[r].position.split("_")[1];
                let obj = $(".posY-" + before + '.posX-' + after).find(".soccerfield-player-name");
                if (posIndex == 0) {
                    $(obj).attr("style", "background: #039870; width: 20px !important; min-height: 20px !important; margin-top: 11px !important; margin-left: 2px !important;");
                }
                if (data[r].position == 'C_GK')
                {
                    isGoalkeeper = 1;
                }
                ++posIndex;
            }
            $("#page2").css("height", $("#page1").css("height"));
            $("#page3").css("height", $("#page1").css("height"));
            initAttributes();
        });
        function initAttributes(){
            let arrGoalkeeperPos = ["Goalkeeper"];
            let arrDefenderPos = ["Sweeper", "Centre-back", "Left Centre-back", "Right Centre-back"];
            let arrDefender_MidfielderPos = ["Left Full-back", "Right Full-back", "Left Wing-back", "Right Wing-back"
                , "Defensive midfield", "Left Defensive midfield", "Right Defensive midfield"
                , "Centre midfield", "Left Centre midfield", "Right Centre midfield"];
            let arrMidfielderPos = ["Left Wide midfield", "Right Wide midfield", "Attacking midfield", "Left Attacking midfield", "Right Attacking midfield"];
            let arrForwardPos = ["Centre forward", "Second striker", "Left Winger", "Right Winger", "Left striker", "Right striker"
                , "Left Centre forward", "Right Centre forward"];

            let arrGoalkeeperAttr = ["aggression", "anticipation", "composure", "concentration", "decisions", "determination", "flair", "leadership"
                , "off_ball", "positioning", "teamwork", "vision", "acceleration", "agility", "balance", "jumping_reach", "natural_fitness", "pace"
                , "stamina", "strength", "aerial_duels", "reaction", "sprint_speed", "aerial_reach", "command_of_area", "communication"
                , "first_touch", "handling", "kicking", "one_on_ones", "feet_playing", "passing", "punching", "reflexes", "rushing_out", "injury_resistance"];

            let arrDefenderAttr = ["crossing", "dribbling", "first_touch", "heading", "shots", "long_shots", "passing", "long_pass", "marking", "tackling", "technique", "deffense"
                , "aggression", "anticipation", "composure", "concentration", "decisions", "determination", "flair", "leadership", "off_ball", "positioning", "teamwork", "vision"
                , "acceleration", "aerial_duels", "agility", "balance", "jumping_reach", "natural_fitness", "pace", "reaction", "sprint_speed", "stamina", "strength", "injury_resistance"];

            let arrDefender_MidfielderAttr = ["crossing", "dribbling", "first_touch", "shots", "long_shots", "passing", "long_pass", "marking", "tackling", "technique", "offensive", "deffense"
                , "aggression", "anticipation", "composure", "concentration", "decisions", "determination", "flair", "leadership", "off_ball", "positioning", "teamwork", "vision"
                , "acceleration", "aerial_duels", "agility", "balance", "jumping_reach", "natural_fitness", "pace", "reaction", "sprint_speed", "stamina", "strength", "injury_resistance"];

            let arrMidfielderAttr = ["crossing", "dribbling", "first_touch", "shots", "long_shots", "passing", "long_pass", "finishing", "marking", "technique", "offensive", "deffense"
                , "aggression", "anticipation", "composure", "concentration", "decisions", "determination", "flair", "leadership", "off_ball", "positioning", "teamwork", "vision"
                , "acceleration", "aerial_duels", "agility", "balance", "jumping_reach", "natural_fitness", "pace", "reaction", "sprint_speed", "stamina", "strength", "injury_resistance"];

            let arrForwardAttr = ["crossing", "dribbling", "first_touch", "shots", "long_shots", "passing", "long_pass", "finishing", "marking", "technique", "offensive", "heading"
                , "aggression", "anticipation", "composure", "concentration", "decisions", "determination", "flair", "leadership", "off_ball", "positioning", "teamwork", "vision"
                , "acceleration", "aerial_duels", "agility", "balance", "jumping_reach", "natural_fitness", "pace", "reaction", "sprint_speed", "stamina", "strength", "injury_resistance"];
            $("tr").css("display", "none");
            @foreach($data->positions as $position)
                $specify = '{{ $position->specify }}';
                if (arrGoalkeeperPos.includes($specify))
                {
                    for (let i = 0; i < arrGoalkeeperAttr.length; i++)
                    {
                        $("[for=" + arrGoalkeeperAttr[i] + "]").parent().css("display", "");
                    }
                } else if (arrDefenderPos.includes($specify))
                {
                    for (let i = 0; i < arrDefenderAttr.length; i++)
                    {
                        $("[for=" + arrDefenderAttr[i] + "]").parent().css("display", "");
                    }
                } else if (arrDefender_MidfielderPos.includes($specify))
                {
                    for (let i = 0; i < arrDefender_MidfielderAttr.length; i++)
                    {
                        $("[for=" + arrDefender_MidfielderAttr[i] + "]").parent().css("display", "");
                    }
                } else if (arrMidfielderPos.includes($specify))
                {
                    for (let i = 0; i < arrMidfielderAttr.length; i++)
                    {
                        $("[for=" + arrMidfielderAttr[i] + "]").parent().css("display", "");
                    }
                } else if (arrForwardPos.includes($specify))
                {
                    for (let i = 0; i < arrForwardAttr.length; i++)
                    {
                        $("[for=" + arrForwardAttr[i] + "]").parent().css("display", "");
                    }
                }
            @endforeach
            let technical_radar_label = [];
            let technical_radar_data = [];
            let ranking_data = [];
            $("[type=technical]").find("tr").each(function () {
                if ($(this).css("display") == "none") return;
                technical_radar_label.push($(this).find("td:eq(0)").text());
                technical_radar_data.push($(this).find("td:eq(1)").text());
            })
            new Chart(document.getElementById("technical-radar").getContext("2d"), {
                type: 'radar',
                data: {
                    labels: technical_radar_label,
                    datasets: [{
                        label: "",
                        backgroundColor: "rgba(57,175,209,0.2)",
                        borderColor: "#FFC61B",
                        pointBackgroundColor: "#FFC61B",
                        pointBorderColor: "#fff",
                        pointHoverBackgroundColor: "#fff",
                        pointHoverBorderColor: "#FFC61B",
                        data: technical_radar_data
                    },]
                },
                options: {
                    legend: {
                        display: false
                    },
                    scale: {
                        angleLines: {
                            display: false
                        }
                        ,ticks: {
                            // backdropColor: '#2C3840',
                            suggestedMin: 0,
                            suggestedMax: 10
                        }
                    }
                }
            });

            let mental_radar_label = [];
            let mental_radar_data = [];
            $("[type=mental]").find("tr").each(function () {
                if ($(this).css("display") == "none") return;
                mental_radar_label.push($(this).find("td:eq(0)").text());
                mental_radar_data.push($(this).find("td:eq(1)").text());
            })
            new Chart(document.getElementById("mental-radar").getContext("2d"), {
                type: 'radar',
                data: {
                    labels: mental_radar_label,
                    datasets: [{
                        label: "",
                        backgroundColor: "rgba(57,175,209,0.2)",
                        borderColor: "#FFC61B",
                        pointBackgroundColor: "#FFC61B",
                        pointBorderColor: "#fff",
                        pointHoverBackgroundColor: "#fff",
                        pointHoverBorderColor: "#FFC61B",
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
                            // backdropColor: '#2C3840',
                            suggestedMin: 0,
                            suggestedMax: 10
                        }
                    }
                }
            });
            let physical_radar_label = [];
            let physical_radar_data = [];
            $("[type=physical]").find("tr").each(function () {
                if ($(this).css("display") == "none") return;
                physical_radar_label.push($(this).find("td:eq(0)").text());
                physical_radar_data.push($(this).find("td:eq(1)").text());
            })
            new Chart(document.getElementById("physical-radar").getContext("2d"), {
                type: 'radar',
                data: {
                    labels: physical_radar_label,
                    datasets: [{
                        label: "",
                        backgroundColor: "rgba(57,175,209,0.2)",
                        borderColor: "#FFC61B",
                        pointBackgroundColor: "#FFC61B",
                        pointBorderColor: "#fff",
                        pointHoverBackgroundColor: "#fff",
                        pointHoverBorderColor: "#FFC61B",
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
                            // backdropColor: '#2C3840',
                            suggestedMin: 0,
                            suggestedMax: 10
                        }
                    }
                }
            });

            //Goalkeeper
            let general_radar_label = ['PASS', 'FEET PLAYING', 'TACTICAL', 'PHYSICAL', 'AERIAL', 'MENTAL', 'GK REFLEXES', 'GOAL KEEPING'];
            let pass = {{ $data->latestParam->passing }};
            let feet_playing =  ({{ $data->latestParam->first_touch }} + {{ $data->latestParam->feet_playing }}) /2;
            let tactical = ({{ $data->latestParam->anticipation }} + {{ $data->latestParam->off_ball }} + {{ $data->latestParam->positioning }}
                + {{ $data->latestParam->vision }}) /4;
            let physical = ({{ $data->latestParam->acceleration }} + {{ $data->latestParam->agility }} + {{ $data->latestParam->balance }}
                + {{ $data->latestParam->natural_fitness }} + {{ $data->latestParam->pace }} + {{ $data->latestParam->reaction }} + {{ $data->latestParam->sprint_speed }}
                + {{ $data->latestParam->stamina }} + {{ $data->latestParam->strength }} + {{ $data->latestParam->injury_resistance }}) / 10;
            let aerial = ({{ $data->latestParam->aerial_reach }} + {{ $data->latestParam->aerial_duels }} + {{ $data->latestParam->jumping_reach }}) /3;
            let mental = ({{ $data->latestParam->aggression }} + {{ $data->latestParam->composure }} + {{ $data->latestParam->concentration }}
                + {{ $data->latestParam->decisions }} + {{ $data->latestParam->determination }} + {{ $data->latestParam->flair }} + {{ $data->latestParam->leadership }}
                + {{ $data->latestParam->teamwork }}) / 8;
            let gk_reflexes = ({{ $data->latestParam->reaction }} + {{ $data->latestParam->reflexes }}) /2;
            let goal_keeping = ({{ $data->latestParam->command_of_area }} + {{ $data->latestParam->communication }} + {{ $data->latestParam->handling }}
                + {{ $data->latestParam->one_on_ones }} + {{ $data->latestParam->rushing_out }}) /5;
            let general_radar_data = [pass, feet_playing, tactical, physical, aerial, mental, gk_reflexes, goal_keeping];
            for (var i = 0; i < general_radar_label.length; i++)
            {
                $("[type=average]").find("tr:eq(" + i + ")").each(function () {
                    $(this).find("td:eq(0)").text(general_radar_label[i]);
                    $(this).find("td:eq(1)").text(general_radar_data[i]);
                })
            }
            if (isGoalkeeper == 0)
            {
                //not Goalkeeper
                general_radar_label = ['PASS', 'ATTACK', 'TACTICAL', 'PHYSICAL', 'AERIAL', 'MENTAL', 'TECHNIQUE', 'DEFENSE'];
                pass = ({{ $data->latestParam->crossing }} + {{ $data->latestParam->passing }} + {{ $data->latestParam->long_pass }}) /3;
                let attack = ({{ $data->latestParam->shots }} + {{ $data->latestParam->long_shots }}) /2;
                aerial = ({{ $data->latestParam->heading }} + {{ $data->latestParam->aerial_duels }} + {{ $data->latestParam->jumping_reach }}) /3;
                let technique = ({{ $data->latestParam->first_touch }} + {{ $data->latestParam->technique }} + {{ $data->latestParam->dribbling }}) /3;
                let defense = ({{ $data->latestParam->marking }} + {{ $data->latestParam->tackling }} + {{ $data->latestParam->deffense }}) /3;
                general_radar_data = [pass, attack, tactical, physical, aerial, mental, technique, defense];
                for (var i = 0; i < general_radar_label.length; i++)
                {
                    $("[type=average]").find("tr:eq(" + i + ")").each(function () {
                        $(this).find("td:eq(0)").text(general_radar_label[i]);
                        let color = getColor(general_radar_data[i]);
                        $(this).find("td:eq(1)").text(general_radar_data[i].toFixed(1).replace(".0", "")).css("background", color);
                    })
                }
            }
            new Chart(document.getElementById("general-radar").getContext("2d"), {
                type: 'radar',
                data: {
                    labels: general_radar_label,
                    datasets: [{
                        label: "",
                        backgroundColor: "rgba(57,175,209,0.2)",
                        borderColor: "#FFC61B",
                        pointBackgroundColor: "#FFC61B",
                        pointBorderColor: "#fff",
                        pointHoverBackgroundColor: "#fff",
                        pointHoverBorderColor: "#FFC61B",
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
                            // backdropColor: '#2C3840',
                            suggestedMin: 0,
                            suggestedMax: 10
                        }
                    }
                }
            });
        }
        function getColor($val)
        {
            $color = "#d3d3d3";
            $val = parseFloat($val);
            if ($val >= 5 && $val < 6)
            {
                $color = "#fc3639";
            } else if ($val >= 6 && $val < 7)
            {
                $color = "#F8696B";
            } else if ($val >= 7 && $val < 7.5)
            {
                $color = "#FBAA77";
            } else if ($val >= 7.5 && $val < 8)
            {
                $color = "#DAE495";
            } else if ($val >= 8 && $val < 8.5)
            {
                $color = "#FFEB84";
            } else if ($val >= 8.5 && $val < 9)
            {
                $color = "#63BE7B";
            } else if ($val >= 9 && $val < 10)
            {
                $color = "#63BE7B";
            }
            return $color;
        }
    </script>
</body>
</html>