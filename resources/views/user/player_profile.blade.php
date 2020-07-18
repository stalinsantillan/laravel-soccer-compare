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
            margin-top: 14px !important;
            margin-left: 6px !important;
            border : none !important;
            background : white; /*linear-gradient(to left, #00c6ff, #000000) !important;*/
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
        .progress-lg {
            height: 18px !important;
        }
        .progress>span
        {
            color: white;
        }
        tr
        {
            line-height: 1;
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
            <h4 class="page-title">{{ $data->name }}</h4>
        </div>
    </div>
</div>
<!-- end page title --> 
<div class="row">
    <div class="col-md-12">
        <div class="card mb-0">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-5">
                        <div class="row">
                            <div class="col-md-6 text-center">
                            @if(isset($data->photo))
                                <img src="{{ asset('storage').'/'.$data->photo }}" class="user-photo" height="180px" width="180px" alt="">
                            @else
                                <img src="{{ asset('user_assets/images/users/standard.png') }}" class="user-photo" height="180px" width="180px" alt="">
                            @endif
                            </div>
                            {{--                            <div class="card text-white text-center bg-primary text-xs-center mt-1 mb-0 ml-5" style="width: 130px">--}}
                            {{--                                <p class="mb-0 mt-1" style="line-height: 15px">General</p>--}}
                            {{--                                <p class="mb-0" style="line-height: 15px">average</p>--}}
                            {{--                                <p class="mb-0 font-18 font-weight-bold" id="general_average"></p>--}}
                            {{--                            </div>--}}
                            <div class="col-md-6">
                                <div class="mt-2 chartjs-chart"  style="height: 200px !important; width: 200px !important;">
                                    <canvas id="general-radar"  style="height: 180px !important; width: 180px !important;"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-centered mb-0">
                                    <tbody>
                                        @php
                                            $year = date("Y", strtotime($data->birth_date));
                                            $age = (date('Y') - $year);
                                        @endphp
                                        <tr>
                                            <td>Nation</td><td>{{ $data->nationality }}</td>
                                        </tr>
                                        <tr>
                                        <td>League</td><td>Flamengo-Brazil(BR)</td>
                                        </tr>
                                        <tr>
                                        <td>Current Team</td><td>{{ $data->current_team }}</td>
                                        </tr>
                                        <tr>
                                        <td>Age</td><td>{{ $data->birth_date }} ({{ $age }} years old)</td>
                                        </tr>
                                        <tr>
                                        <td>Height</td><td>{{ $data->height }}</td>
                                        </tr>
                                        <tr>
                                        <td>Weight</td><td>{{ $data->weight }}</td>
                                        </tr>
                                        <tr>
                                        <td>Prefered foot</td><td>{{ $data->foot }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 row">
                        <div class="col-md-4 text-center">
                            <a href="{{ route('user.edit_player', $data->id) }}" class="btn btn-outline-info waves-effect waves-light mb-2" style="margin: auto">Edit</a>
                            <div id="soccerfield"></div>
                        </div>
                        <div class="col-md-8">

                            <table class="table table-centered mb-0 mt-0">
                                <thead>
                                <tr>
                                    <th colspan="2" class="text-center">Best Attributes</th>
                                </tr>
                                </thead>
                                <tbody id="tbody_best">
                                <tr>
                                    <td>Agility</td>
                                    <td>16</td>
                                </tr>
                                <tr>
                                    <td>Agility</td>
                                    <td>16</td>
                                </tr>
                                <tr>
                                    <td>Agility</td>
                                    <td>16</td>
                                </tr>
                                <tr>
                                    <td>Agility</td>
                                    <td>16</td>
                                </tr>
                                <tr>
                                    <td>Agility</td>
                                    <td>16</td>
                                </tr>
                                </tbody>
                            </table>
                            <table class="table table-centered mb-0 mt-0">
                                <thead>
                                <tr>
                                    <th colspan="2" class="text-center">Worst Attributes</th>
                                </tr>
                                </thead>
                                <tbody id="tbody_worst">
                                <tr>
                                    <td>Agility</td>
                                    <td>16</td>
                                </tr>
                                <tr>
                                    <td>Agility</td>
                                    <td>16</td>
                                </tr>
                                <tr>
                                    <td>Agility</td>
                                    <td>16</td>
                                </tr>
                                <tr>
                                    <td>Agility</td>
                                    <td>16</td>
                                </tr>
                                <tr>
                                    <td>Agility</td>
                                    <td>16</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
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
                                <span style="position: absolute; left: 45%">{{ $data->latestParam->corners }} / {{ $paramsetting->corners }}</span>
                                <div class="progress-bar bg-info" role="progressbar" bartype="technical" style="width: {{ $data->latestParam->corners * 10 }}%" aria-valuenow="{{ $data->latestParam->corners }}" aria-valuemin="0" aria-valuemax="{{ $paramsetting->corners }}"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="crossing">Crossing</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->latestParam->crossing }} / {{ $paramsetting->crossing }}</span>
                                <div class="progress-bar bg-info" role="progressbar" bartype="technical" style="width: {{ $data->latestParam->crossing * 10 }}%"  aria-valuenow="{{ $data->latestParam->crossing }}" aria-valuemin="0" aria-valuemax="{{ $paramsetting->crossing }}"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="dribbling">Dribbling</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->latestParam->dribbling }} / {{ $paramsetting->dribbling }}</span>
                                <div class="progress-bar bg-info" role="progressbar" bartype="technical" style="width: {{ $data->latestParam->dribbling * 10 }}%"  aria-valuenow="{{ $data->latestParam->dribbling }}" aria-valuemin="0" aria-valuemax="{{ $paramsetting->dribbling }}"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="finishing">Finishing</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->latestParam->finishing }} / {{ $paramsetting->finishing }}</span>
                                <div class="progress-bar bg-info" role="progressbar" bartype="technical" style="width: {{ $data->latestParam->finishing * 10 }}%"  aria-valuenow="{{ $data->latestParam->finishing }}" aria-valuemin="0" aria-valuemax="{{ $paramsetting->finishing }}"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="areial_reach">Aerial Reach</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->latestParam->areial_reach }} / {{ $paramsetting->areial_reach }}</span>
                                <div class="progress-bar bg-info" role="progressbar" bartype="technical" style="width: {{ $data->latestParam->areial_reach * 10 }}%"  aria-valuenow="{{ $data->latestParam->areial_reach }}" aria-valuemin="0" aria-valuemax="{{ $paramsetting->areial_reach }}"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="command_of_area">Command Of Area</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->latestParam->command_of_area }} / {{ $paramsetting->command_of_area }}</span>
                                <div class="progress-bar bg-info" role="progressbar" bartype="technical" style="width: {{ $data->latestParam->command_of_area * 10 }}%"  aria-valuenow="{{ $data->latestParam->command_of_area }}" aria-valuemin="0" aria-valuemax="{{ $paramsetting->command_of_area }}"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="communication">Communication</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->latestParam->communication }} / {{ $paramsetting->communication }}</span>
                                <div class="progress-bar bg-info" role="progressbar" bartype="technical" style="width: {{ $data->latestParam->communication * 10 }}%"  aria-valuenow="{{ $data->latestParam->communication }}" aria-valuemin="0" aria-valuemax="{{ $paramsetting->communication }}"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="eccentricity">Eccentricity</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->latestParam->eccentricity }} / {{ $paramsetting->eccentricity }}</span>
                                <div class="progress-bar bg-info" role="progressbar" bartype="technical" style="width: {{ $data->latestParam->eccentricity * 10 }}%"  aria-valuenow="{{ $data->latestParam->eccentricity }}" aria-valuemin="0" aria-valuemax="{{ $paramsetting->eccentricity }}"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="first_touch">First Touch</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->latestParam->first_touch }} / {{ $paramsetting->first_touch }}</span>
                                <div class="progress-bar bg-info" role="progressbar" bartype="technical" style="width: {{ $data->latestParam->first_touch * 10 }}%"  aria-valuenow="{{ $data->latestParam->first_touch }}" aria-valuemin="0" aria-valuemax="{{ $paramsetting->first_touch }}"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="handling">Handling</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->latestParam->handling }} / {{ $paramsetting->handling }}</span>
                                <div class="progress-bar bg-info" role="progressbar" bartype="technical" style="width: {{ $data->latestParam->handling * 10 }}%"  aria-valuenow="{{ $data->latestParam->handling }}" aria-valuemin="0" aria-valuemax="{{ $paramsetting->handling }}"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="kicking">Kicking</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->latestParam->kicking }} / {{ $paramsetting->kicking }}</span>
                                <div class="progress-bar bg-info" role="progressbar" bartype="technical" style="width: {{ $data->latestParam->kicking * 10 }}%"  aria-valuenow="{{ $data->latestParam->kicking }}" aria-valuemin="0" aria-valuemax="{{ $paramsetting->kicking }}"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="one_on_ones">One On Ones</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->latestParam->one_on_ones }} / {{ $paramsetting->one_on_ones }}</span>
                                <div class="progress-bar bg-info" role="progressbar" bartype="technical" style="width: {{ $data->latestParam->one_on_ones * 10 }}%"  aria-valuenow="{{ $data->latestParam->one_on_ones }}" aria-valuemin="0" aria-valuemax="{{ $paramsetting->one_on_ones }}"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="feet_playing">Feet playing</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->latestParam->feet_playing }} / {{ $paramsetting->feet_playing }}</span>
                                <div class="progress-bar bg-info" role="progressbar" bartype="technical" style="width: {{ $data->latestParam->feet_playing * 10 }}%"  aria-valuenow="{{ $data->latestParam->feet_playing }}" aria-valuemin="0" aria-valuemax="{{ $paramsetting->feet_playing }}"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="free_kick">Free Kick Taking</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->latestParam->free_kick }} / {{ $paramsetting->free_kick }}</span>
                                <div class="progress-bar bg-info" role="progressbar" bartype="technical" style="width: {{ $data->latestParam->free_kick * 10 }}%"  aria-valuenow="{{ $data->latestParam->free_kick }}" aria-valuemin="0" aria-valuemax="{{ $paramsetting->free_kick }}"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="heading">Heading</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->latestParam->heading }} / {{ $paramsetting->heading }}</span>
                                <div class="progress-bar bg-info" role="progressbar" bartype="technical" style="width: {{ $data->latestParam->heading * 10 }}%"  aria-valuenow="{{ $data->latestParam->heading }}" aria-valuemin="0" aria-valuemax="{{ $paramsetting->heading }}"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="shots">Shots</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->latestParam->shots }} / {{ $paramsetting->shots }}</span>
                                <div class="progress-bar bg-info" role="progressbar" bartype="technical" style="width: {{ $data->latestParam->shots * 10 }}%"  aria-valuenow="{{ $data->latestParam->shots }}" aria-valuemin="0" aria-valuemax="{{ $paramsetting->shots }}"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="long_shots">Long Shots</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->latestParam->long_shots }} / {{ $paramsetting->long_shots }}</span>
                                <div class="progress-bar bg-info" role="progressbar" bartype="technical" style="width: {{ $data->latestParam->long_shots * 10 }}%"  aria-valuenow="{{ $data->latestParam->long_shots }}" aria-valuemin="0" aria-valuemax="{{ $paramsetting->long_shots }}"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="long_throws">Long Throws</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->latestParam->long_throws }} / {{ $paramsetting->long_throws }}</span>
                                <div class="progress-bar bg-info" role="progressbar" bartype="technical" style="width: {{ $data->latestParam->long_throws * 10 }}%"  aria-valuenow="{{ $data->latestParam->long_throws }}" aria-valuemin="0" aria-valuemax="{{ $paramsetting->long_throws }}"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="marking">Marking</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->latestParam->marking }} / {{ $paramsetting->marking }}</span>
                                <div class="progress-bar bg-info" role="progressbar" bartype="technical" style="width: {{ $data->latestParam->marking * 10 }}%"  aria-valuenow="{{ $data->latestParam->marking }}" aria-valuemin="0" aria-valuemax="{{ $paramsetting->marking }}"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="passing">Passing</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->latestParam->passing }} / {{ $paramsetting->passing }}</span>
                                <div class="progress-bar bg-info" role="progressbar" bartype="technical" style="width: {{ $data->latestParam->passing * 10 }}%"  aria-valuenow="{{ $data->latestParam->passing }}" aria-valuemin="0" aria-valuemax="{{ $paramsetting->passing }}"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="punching">Punching</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->latestParam->punching }} / {{ $paramsetting->punching }}</span>
                                <div class="progress-bar bg-info" role="progressbar" bartype="technical" style="width: {{ $data->latestParam->punching * 10 }}%"  aria-valuenow="{{ $data->latestParam->punching }}" aria-valuemin="0" aria-valuemax="{{ $paramsetting->punching }}"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reflexes">Reflexes</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->latestParam->reflexes }} / {{ $paramsetting->reflexes }}</span>
                                <div class="progress-bar bg-info" role="progressbar" bartype="technical" style="width: {{ $data->latestParam->reflexes * 10 }}%"  aria-valuenow="{{ $data->latestParam->reflexes }}" aria-valuemin="0" aria-valuemax="{{ $paramsetting->reflexes }}"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="rushing_out">Rushing Out</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->latestParam->rushing_out }} / {{ $paramsetting->rushing_out }}</span>
                                <div class="progress-bar bg-info" role="progressbar" bartype="technical" style="width: {{ $data->latestParam->rushing_out * 10 }}%"  aria-valuenow="{{ $data->latestParam->rushing_out }}" aria-valuemin="0" aria-valuemax="{{ $paramsetting->rushing_out }}"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="throwing">Throwing</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->latestParam->throwing }} / {{ $paramsetting->throwing }}</span>
                                <div class="progress-bar bg-info" role="progressbar" bartype="technical" style="width: {{ $data->latestParam->throwing * 10 }}%"  aria-valuenow="{{ $data->latestParam->throwing }}" aria-valuemin="0" aria-valuemax="{{ $paramsetting->throwing }}"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="penalty_taking">Penalty Taking</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->latestParam->penalty_taking }} / {{ $paramsetting->penalty_taking }}</span>
                                <div class="progress-bar bg-info" role="progressbar" bartype="technical" style="width: {{ $data->latestParam->penalty_taking * 10 }}%"  aria-valuenow="{{ $data->latestParam->penalty_taking }}" aria-valuemin="0" aria-valuemax="{{ $paramsetting->penalty_taking }}"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tackling">Tackling</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->latestParam->tackling }} / {{ $paramsetting->tackling }}</span>
                                <div class="progress-bar bg-info" role="progressbar" bartype="technical" style="width: {{ $data->latestParam->tackling * 10 }}%"  aria-valuenow="{{ $data->latestParam->tackling }}" aria-valuemin="0" aria-valuemax="{{ $paramsetting->tackling }}"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="technique">Technique</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->latestParam->technique }} / {{ $paramsetting->technique }}</span>
                                <div class="progress-bar bg-info" role="progressbar" bartype="technical" style="width: {{ $data->latestParam->technique * 10 }}%"  aria-valuenow="{{ $data->latestParam->technique }}" aria-valuemin="0" aria-valuemax="{{ $paramsetting->technique }}"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="offensive">1 VS 1 Offensive</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->latestParam->offensive }} / {{ $paramsetting->offensive }}</span>
                                <div class="progress-bar bg-info" role="progressbar" bartype="technical" style="width: {{ $data->latestParam->offensive * 10 }}%"  aria-valuenow="{{ $data->latestParam->offensive }}" aria-valuemin="0" aria-valuemax="{{ $paramsetting->offensive }}"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="deffense">1 VS 1 Deffense</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->latestParam->deffense }} / {{ $paramsetting->deffense }}</span>
                                <div class="progress-bar bg-info" role="progressbar" bartype="technical" style="width: {{ $data->latestParam->deffense * 10 }}%"  aria-valuenow="{{ $data->latestParam->deffense }}" aria-valuemin="0" aria-valuemax="{{ $paramsetting->deffense }}"></div>
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
                                <span style="position: absolute; left: 45%">{{ $data->latestParam->aggression }} / {{ $paramsetting->aggression }}</span>
                                <div class="progress-bar bg-info" role="progressbar" bartype="mental" style="width: {{ $data->latestParam->aggression * 10 }}%"  aria-valuenow="{{ $data->latestParam->aggression }}" aria-valuemin="0" aria-valuemax="{{ $paramsetting->aggression }}"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="articipation">Anticipation</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->latestParam->articipation }} / {{ $paramsetting->articipation }}</span>
                                <div class="progress-bar bg-info" role="progressbar" bartype="mental" style="width: {{ $data->latestParam->articipation * 10 }}%"  aria-valuenow="{{ $data->latestParam->articipation }}" aria-valuemin="0" aria-valuemax="{{ $paramsetting->articipation }}"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="bravery">Bravery</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->latestParam->bravery }} / {{ $paramsetting->bravery }}</span>
                                <div class="progress-bar bg-info" role="progressbar" bartype="mental" style="width: {{ $data->latestParam->bravery * 10 }}%"  aria-valuenow="{{ $data->latestParam->bravery }}" aria-valuemin="0" aria-valuemax="{{ $paramsetting->bravery }}"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="composure">Composure</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->latestParam->composure }} / {{ $paramsetting->composure }}</span>
                                <div class="progress-bar bg-info" role="progressbar" bartype="mental" style="width: {{ $data->latestParam->composure * 10 }}%"  aria-valuenow="{{ $data->latestParam->composure }}" aria-valuemin="0" aria-valuemax="{{ $paramsetting->composure }}"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="concentration">Concentration</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->latestParam->concentration }} / {{ $paramsetting->concentration }}</span>
                                <div class="progress-bar bg-info" role="progressbar" bartype="mental" style="width: {{ $data->latestParam->concentration * 10 }}%"  aria-valuenow="{{ $data->latestParam->concentration }}" aria-valuemin="0" aria-valuemax="{{ $paramsetting->concentration }}"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="decisions">Decisions</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->latestParam->decisions }} / {{ $paramsetting->decisions }}</span>
                                <div class="progress-bar bg-info" role="progressbar" bartype="mental" style="width: {{ $data->latestParam->decisions * 10 }}%"  aria-valuenow="{{ $data->latestParam->decisions }}" aria-valuemin="0" aria-valuemax="{{ $paramsetting->decisions }}"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="determination">Determination</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->latestParam->determination }} / {{ $paramsetting->determination }}</span>
                                <div class="progress-bar bg-info" role="progressbar" bartype="mental" style="width: {{ $data->latestParam->determination * 10 }}%"  aria-valuenow="{{ $data->latestParam->determination }}" aria-valuemin="0" aria-valuemax="{{ $paramsetting->determination }}"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="flair">Flair</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->latestParam->flair }} / {{ $paramsetting->flair }}</span>
                                <div class="progress-bar bg-info" role="progressbar" bartype="mental" style="width: {{ $data->latestParam->flair * 10 }}%"  aria-valuenow="{{ $data->latestParam->flair }}" aria-valuemin="0" aria-valuemax="{{ $paramsetting->flair }}"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="leadership">Leadership</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->latestParam->leadership }} / {{ $paramsetting->leadership }}</span>
                                <div class="progress-bar bg-info" role="progressbar" bartype="mental" style="width: {{ $data->latestParam->leadership * 10 }}%"  aria-valuenow="{{ $data->latestParam->leadership }}" aria-valuemin="0" aria-valuemax="{{ $paramsetting->leadership }}"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="off_ball">Off The Ball</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->latestParam->off_ball }} / {{ $paramsetting->off_ball }}</span>
                                <div class="progress-bar bg-info" role="progressbar" bartype="mental" style="width: {{ $data->latestParam->off_ball * 10 }}%"  aria-valuenow="{{ $data->latestParam->off_ball }}" aria-valuemin="0" aria-valuemax="{{ $paramsetting->off_ball }}"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="positioning">Positioning</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->latestParam->positioning }} / {{ $paramsetting->positioning }}</span>
                                <div class="progress-bar bg-info" role="progressbar" bartype="mental" style="width: {{ $data->latestParam->positioning * 10 }}%"  aria-valuenow="{{ $data->latestParam->positioning }}" aria-valuemin="0" aria-valuemax="{{ $paramsetting->positioning }}"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="teamwork">Teamwork</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->latestParam->teamwork }} / {{ $paramsetting->teamwork }}</span>
                                <div class="progress-bar bg-info" role="progressbar" bartype="mental" style="width: {{ $data->latestParam->teamwork * 10 }}%"  aria-valuenow="{{ $data->latestParam->teamwork }}" aria-valuemin="0" aria-valuemax="{{ $paramsetting->teamwork }}"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="vision">Vision</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->latestParam->vision }} / {{ $paramsetting->vision }}</span>
                                <div class="progress-bar bg-info" role="progressbar" bartype="mental" style="width: {{ $data->latestParam->vision * 10 }}%"  aria-valuenow="{{ $data->latestParam->vision }}" aria-valuemin="0" aria-valuemax="{{ $paramsetting->vision }}"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="work_rate">Work Rate</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->latestParam->work_rate }} / {{ $paramsetting->work_rate }}</span>
                                <div class="progress-bar bg-info" role="progressbar" bartype="mental" style="width: {{ $data->latestParam->work_rate * 10 }}%"  aria-valuenow="{{ $data->latestParam->work_rate }}" aria-valuemin="0" aria-valuemax="{{ $paramsetting->work_rate }}"></div>
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
                                <span style="position: absolute; left: 45%">{{ $data->latestParam->acceleration }} / {{ $paramsetting->acceleration }}</span>
                                <div class="progress-bar bg-info" role="progressbar" bartype="physical" style="width: {{ $data->latestParam->acceleration * 10 }}%"  aria-valuenow="{{ $data->latestParam->acceleration }}" aria-valuemin="0" aria-valuemax="{{ $paramsetting->acceleration }}"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="aerial_duels">Aerial Duels</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->latestParam->aerial_duels }} / {{ $paramsetting->aerial_duels }}</span>
                                <div class="progress-bar bg-info" role="progressbar" bartype="physical" style="width: {{ $data->latestParam->aerial_duels * 10 }}%"  aria-valuenow="{{ $data->latestParam->aerial_duels }}" aria-valuemin="0" aria-valuemax="{{ $paramsetting->aerial_duels }}"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="agility">Agility</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->latestParam->agility }} / {{ $paramsetting->agility }}</span>
                                <div class="progress-bar bg-info" role="progressbar" bartype="physical" style="width: {{ $data->latestParam->agility * 10 }}%"  aria-valuenow="{{ $data->latestParam->agility }}" aria-valuemin="0" aria-valuemax="{{ $paramsetting->agility }}"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="balance">Balance</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->latestParam->balance }} / {{ $paramsetting->balance }}</span>
                                <div class="progress-bar bg-info" role="progressbar" bartype="physical" style="width: {{ $data->latestParam->balance * 10 }}%"  aria-valuenow="{{ $data->latestParam->balance }}" aria-valuemin="0" aria-valuemax="{{ $paramsetting->balance }}"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="jumping_reach">Jumping Reach</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->latestParam->jumping_reach }} / {{ $paramsetting->jumping_reach }}</span>
                                <div class="progress-bar bg-info" role="progressbar" bartype="physical" style="width: {{ $data->latestParam->jumping_reach * 10 }}%"  aria-valuenow="{{ $data->latestParam->jumping_reach }}" aria-valuemin="0" aria-valuemax="{{ $paramsetting->jumping_reach }}"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="natural_fitness">Natural Fitness</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->latestParam->natural_fitness }} / {{ $paramsetting->natural_fitness }}</span>
                                <div class="progress-bar bg-info" role="progressbar" bartype="physical" style="width: {{ $data->latestParam->natural_fitness * 10 }}%"  aria-valuenow="{{ $data->latestParam->natural_fitness }}" aria-valuemin="0" aria-valuemax="{{ $paramsetting->natural_fitness }}"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="pace">Pace</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->latestParam->pace }} / {{ $paramsetting->pace }}</span>
                                <div class="progress-bar bg-info" role="progressbar" bartype="physical" style="width: {{ $data->latestParam->pace * 10 }}%"  aria-valuenow="{{ $data->latestParam->pace }}" aria-valuemin="0" aria-valuemax="{{ $paramsetting->pace }}"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reaction">Reaction</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->latestParam->reaction }} / {{ $paramsetting->reaction }}</span>
                                <div class="progress-bar bg-info" role="progressbar" bartype="physical" style="width: {{ $data->latestParam->reaction * 10 }}%"  aria-valuenow="{{ $data->latestParam->reaction }}" aria-valuemin="0" aria-valuemax="{{ $paramsetting->reaction }}"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sprint_speed">Sprint Speed</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->latestParam->sprint_speed }} / {{ $paramsetting->sprint_speed }}</span>
                                <div class="progress-bar bg-info" role="progressbar" bartype="physical" style="width: {{ $data->latestParam->sprint_speed * 10 }}%"  aria-valuenow="{{ $data->latestParam->sprint_speed }}" aria-valuemin="0" aria-valuemax="{{ $paramsetting->sprint_speed }}"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="stamina">Stamina</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->latestParam->stamina }} / {{ $paramsetting->stamina }}</span>
                                <div class="progress-bar bg-info" role="progressbar" bartype="physical" style="width: {{ $data->latestParam->stamina * 10 }}%"  aria-valuenow="{{ $data->latestParam->stamina }}" aria-valuemin="0" aria-valuemax="{{ $paramsetting->stamina }}"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="strength">Strength</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->latestParam->strength }} / {{ $paramsetting->strength }}</span>
                                <div class="progress-bar bg-info" role="progressbar" bartype="physical" style="width: {{ $data->latestParam->strength * 10 }}%"  aria-valuenow="{{ $data->latestParam->strength }}" aria-valuemin="0" aria-valuemax="{{ $paramsetting->strength }}"></div>
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
                    width: "200px",
                    height: "320px",
                    img: "{{ asset('soccer_field/img/soccerfield_green3.png') }} ",
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
                @if ($position->specify == "Second striker") data.push({name: ' ', position: 'C_W'}); @endif
                @if ($position->specify == "Right Winger") data.push({name: ' ', position: 'R_W'}); @endif
                @if ($position->specify == "Centre forward") data.push({name: ' ', position: 'C_F'}); @endif
                @if ($position->specify == "Goalkeeper") data.push({name: ' ', position: 'C_GK'}); @endif
            @endforeach
            $("#soccerfield").soccerfield(data,options);
            console.log(data);
            Chart.defaults.global.defaultFontColor = "rgba(255,255,255,0.5)";
            Chart.defaults.scale.gridLines.color = "rgba(255,255,255,0.05)";
            let general_radar_data = ['{{ $data->latestParam->marking }}', '{{ $data->latestParam->passing }}', '{{ $data->latestParam->technique }}', '{{ $data->latestParam->vision }}', '{{ $data->latestParam->tackling }}'];
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
            let arrDefenderPos = ["Centre-back", "Sweeper", "Left Full-back", "Right Full-back", "Left Wing-back", "Right Wing-back"
                , "Defensive midfield", "Attacking midfield", "Left Wide midfield", "Right Wide midfield"];
            let arrAttackingPos = ["Centre midfield", "Centre forward", "Second striker", "Left Winger", "Right Winger"];
            let arrGoalkeeperPos = ["Goalkeeper"];
            let arrDefenderAttr = ["crossing", "dribbling", "finishing", "first_touch", "heading", "long_shots", "long_throws", "marking", "passing", "tackling"
                , "technique", "aggression", "articipation", "bravery", "composure", "concentration", "decisions", "determination", "flair", "leadership"
                , "off_ball", "positioning", "teamwork", "vision", "work_rate", "acceleration", "agility", "balance", "jumping_reach", "natural_fitness", "pace"
                , "stamina", "strength", "shots", "offensive", "deffense", "aerial_duels", "reaction", "sprint_speed"];
            let arrAttackingAttr = ["crossing", "dribbling", "finishing", "first_touch", "heading", "long_shots", "long_throws", "marking", "passing", "tackling"
                , "technique", "aggression", "articipation", "bravery", "composure", "concentration", "decisions", "determination", "flair", "leadership"
                , "off_ball", "positioning", "teamwork", "vision", "acceleration", "agility", "balance", "jumping_reach", "natural_fitness", "pace"
                , "stamina", "strength", "shots", "offensive", "aerial_duels", "reaction", "sprint_speed"];
            let arrGoalkeeperAttr = ["aggression", "articipation", "bravery", "composure", "concentration", "decisions", "determination", "flair", "leadership"
                , "off_ball", "positioning", "teamwork", "vision", "work_rate", "acceleration", "agility", "balance", "jumping_reach", "natural_fitness", "pace"
                , "stamina", "strength", "aerial_duels", "reaction", "sprint_speed", "areial_reach", "command_of_area", "communication"
                , "eccentricity", "first_touch", "handling", "kicking", "one_on_ones", "feet_playing", "passing", "punching", "reflexes", "rushing_out", "throwing"];
            $("[role=progressbar]").parent().parent().css("display", "none");
            @foreach($data->positions as $position)
                $specify = '{{ $position->specify }}';
                if (arrDefenderPos.includes($specify))
                {
                    for (let i = 0; i < arrDefenderAttr.length; i++)
                    {
                        $("[for=" + arrDefenderAttr[i] + "]").parent().css("display", "");
                    }
                } else if (arrAttackingPos.includes($specify))
                {
                    for (let i = 0; i < arrAttackingAttr.length; i++)
                    {
                        $("[for=" + arrAttackingAttr[i] + "]").parent().css("display", "");
                    }
                } else if (arrGoalkeeperPos.includes($specify))
                {
                    for (let i = 0; i < arrGoalkeeperAttr.length; i++)
                    {
                        $("[for=" + arrGoalkeeperAttr[i] + "]").parent().css("display", "");
                    }
                }
            @endforeach
            let technical_radar_label = [];
            let technical_radar_data = [];
            let ranking_data = [];
            $("[role=progressbar][bartype=technical]").each(function () {
                if ($(this).parent().parent().css("display") == "none") return;
                technical_radar_label.push($(this).parent().parent().find("label").text());
                technical_radar_data.push($(this).attr("aria-valuenow"));
                ranking_data.push({name: $(this).parent().parent().find("label").text(), value: $(this).attr("aria-valuenow")});
            })
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
                    labels: technical_radar_label,
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

            let mental_radar_label = [];
            let mental_radar_data = [];
            $("[role=progressbar][bartype=mental]").each(function () {
                if ($(this).parent().parent().css("display") == "none") return;
                mental_radar_label.push($(this).parent().parent().find("label").text());
                mental_radar_data.push($(this).attr("aria-valuenow"));
                ranking_data.push({name: $(this).parent().parent().find("label").text(), value: $(this).attr("aria-valuenow")});
            })

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
                    labels: mental_radar_label,
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
            let physical_radar_label = [];
            let physical_radar_data = [];
            $("[role=progressbar][bartype=physical]").each(function () {
                if ($(this).parent().parent().css("display") == "none") return;
                physical_radar_label.push($(this).parent().parent().find("label").text());
                physical_radar_data.push($(this).attr("aria-valuenow"));
                ranking_data.push({name: $(this).parent().parent().find("label").text(), value: $(this).attr("aria-valuenow")});
            })
            ranking_data.sort(function(a, b){return b.value - a.value});
            $("#tbody_best").empty();
            for (let i = 0; i < 5; i++)
            {
                $("#tbody_best").append($("<tr></tr>").append($("<td style='min-width: 120px;'></td>").html(ranking_data[i].name)).append($("<td></td>").html(ranking_data[i].value)));
            }
            $("#tbody_worst").empty();
            for (let i = ranking_data.length - 1; i > ranking_data.length - 6; i--)
            {
                $("#tbody_worst").append($("<tr></tr>").append($("<td style='min-width: 120px;'></td>").html(ranking_data[i].name)).append($("<td></td>").html(ranking_data[i].value)));
            }
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
                    labels: physical_radar_label,
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
            let general_sum = sum + physical_sum + mental_sum;
            let general_avg = (general_sum / (technical_radar_data.length + mental_radar_data.length + physical_radar_data.length)).toFixed(1);
            $("#general_average").text(general_avg);
        });
    </script>
@endsection