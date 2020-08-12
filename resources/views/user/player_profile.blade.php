@extends('layouts.user')
@section('styles')
    <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('soccer_field/css/soccerfield.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('soccer_field/css/soccerfield.default.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('user_assets/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('erp_assets/select/css/select2.css') }}" rel="stylesheet" type="text/css" />
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
        .select2-container--default .select2-results__option--selected {
            background-color: #4c5a67;
            color: white;
        }
        .select2-selection__rendered {
            /*padding: 0 !important;*/
        }
        .select2-selection__choice__remove:hover{
            background-color: #6658dd !important;
        }
        .select2-container {
            width: 100% !important;
            /*min-width: 300px !important;*/
            max-width: 428px !important;
        }
        .form-control{
            background-color: #3c4853 !important;
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
                    <li class="breadcrumb-item"><a href="{{ route('user.filter_player') }}">{{ trans('cruds.filter.title') }}</a></li>
                    <li class="breadcrumb-item active">{{ trans('cruds.player.profile') }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- end page title -->
<div class="row" id="pdf_content">
    <div class="col-md-12">
        <div class="card mb-0">
            <div class="card-header font-16 row" style="padding-top: 0; padding-bottom: 0; min-height: 56px;">
                <span style="margin-top: auto; margin-bottom: auto" class="col-md-auto">{{ $data->name }} {{ $data->surename }}</span>
                <button class="col-md-auto btn btn-link text-white waves-effect ml-5" onclick="openAdditional()">Additional Information</button>
                <button class="col-md-auto btn btn-link text-white waves-effect" onclick="openScout_Report()">Scout Report</button>
                <button class="col-md-auto btn btn-link text-white waves-effect" onclick="openInjury();">Injuries</button>
                <button class="col-md-auto btn btn-link text-white waves-effect" onclick="openVideo();">Add Video</button>
                <a href="{{ route('user.edit_player', $data->id) }}" class="btn btn-outline-info waves-effect waves-light ml-2" style="height: 38px; top: 10px">Edit Player</a>
                <a href="{{ route('user.player_pdf', $data->id) }}" class="btn btn-primary waves-effect waves-light ml-2" style="height: 38px; top: 10px">Export to PDF</a>
            </div>
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
                            <div class="col-md-6">
                                <div class="mt-2 chartjs-chart"  style="height: 200px !important; width: 280px !important;">
                                    <canvas id="general-radar"></canvas>
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
                                        @php
                                            $league = '';
                                            if ($data->current_team_link == "")
                                            {
                                                $league = App\Models\User\Team::findOrFail($data->current_team_id)->league->name;
                                            }
                                            else
                                            {
                                                $leagues = App\Models\User\ApiTeam::findOrFail($data->current_team_id);
                                                $league = $leagues->competition_name ?? '';
                                            }
                                        @endphp
                                        <td>League</td><td>{{$league}}</td>
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
                            <div id="soccerfield"></div>
                            @php $i = 0; @endphp
                            @foreach($data->positions as $position)
                                @if ($i == 0)
                                    <p class="font-14 text-white mt-3 mb-0">Main Position : </p>
                                @elseif ($i == 1)
                                    <p class="font-14 text-white mt-2 mb-0">Other Position : </p>
                                @endif
                                <p class="font-14 mb-0">{{ $position->specify }}</p>
                                @php ++$i; @endphp
                            @endforeach
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
        <div class="card">
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
                            <label for="aerial_reach">Aerial Reach</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->latestParam->aerial_reach }} / {{ $paramsetting->aerial_reach }}</span>
                                <div class="progress-bar bg-info" role="progressbar" bartype="technical" style="width: {{ $data->latestParam->aerial_reach * 10 }}%"  aria-valuenow="{{ $data->latestParam->aerial_reach }}" aria-valuemin="0" aria-valuemax="{{ $paramsetting->aerial_reach }}"></div>
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
                            <label for="long_pass">Long Pass</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->latestParam->long_pass }} / {{ $paramsetting->long_pass }}</span>
                                <div class="progress-bar bg-info" role="progressbar" bartype="technical" style="width: {{ $data->latestParam->long_pass * 10 }}%"  aria-valuenow="{{ $data->latestParam->long_pass }}" aria-valuemin="0" aria-valuemax="{{ $paramsetting->long_pass }}"></div>
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
                            <label for="anticipation">Anticipation</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->latestParam->anticipation }} / {{ $paramsetting->anticipation }}</span>
                                <div class="progress-bar bg-info" role="progressbar" bartype="mental" style="width: {{ $data->latestParam->anticipation * 10 }}%"  aria-valuenow="{{ $data->latestParam->anticipation }}" aria-valuemin="0" aria-valuemax="{{ $paramsetting->anticipation }}"></div>
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
                        <div class="form-group">
                            <label for="injury_resistance">Injury resistance</label>
                            <div class="progress mb-2 progress-lg">
                                <span style="position: absolute; left: 45%">{{ $data->latestParam->injury_resistance }} / {{ $paramsetting->injury_resistance }}</span>
                                <div class="progress-bar bg-info" role="progressbar" bartype="physical" style="width: {{ $data->latestParam->injury_resistance * 10 }}%"  aria-valuenow="{{ $data->latestParam->injury_resistance }}" aria-valuemin="0" aria-valuemax="{{ $paramsetting->injury_resistance }}"></div>
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
<div id="additional-info" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Additional Information</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body p-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="language" class="control-label">Languages<span class="text-danger">*</span></label>
                            <select class="custom-select" multiple required id="language" name="language">
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="national_team" class="control-label">National Team<span class="text-danger">*</span></label>
                            <select class="custom-select" required id="national_team" name="national_team">
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="first_appearance_date" class="control-label">First appearance in National team<span class="text-danger">*</span></label>
                            <input type="text" required class="form-control" id="first_appearance_date" value="{{ $data->additional->first_appearance_date ?? '' }}" name="first_appearance_date">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="first_appearance_team" class="control-label">First appearance in first division (Team)<span class="text-danger">*</span></label>
                            <select class="custom-select" required id="first_appearance_team" name="first_appearance_team">
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="first_appearance_division" class="control-label">First appearance in First Division<span class="text-danger">*</span></label>
                            <input type="text" required class="form-control" id="first_appearance_division" value="{{ $data->additional->first_appearance_division ?? '' }}" name="first_appearance_division">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="contact_expires" class="control-label">Contract expires<span class="text-danger">*</span></label>
                            <input type="text" required class="form-control" id="contact_expires" value="{{ $data->additional->contact_expires ?? '' }}" name="contact_expires">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="market_value" class="control-label">Market Value<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="market_value_ap" style="background-color: #3c4853">€</span>
                                </div>
                                <input type="text" data-parsley-type="number" required class="form-control" id="market_value" value="{{ $data->additional->market_value ?? '' }}" name="market_value">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-info waves-effect waves-light" onclick="saveAdditional()">Save changes</button>
            </div>
        </div>
    </div>
</div><!-- /.modal -->
<div id="scout-report" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Scout Report</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body p-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="general_info" class="control-label">General Information<span class="text-danger">*</span></label>
                            <input type="text" required class="form-control" id="general_info" value="{{ $data->scout_report->general_info ?? '' }}" name="general_info">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="strengths" class="control-label">Strengths<span class="text-danger">*</span></label>
                            <input type="text" required class="form-control" id="strengths" value="{{ $data->scout_report->strengths ?? '' }}" name="strengths">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="weaknesses" class="control-label">Weaknesses<span class="text-danger">*</span></label>
                            <input type="text" required class="form-control" id="weaknesses" value="{{ $data->scout_report->weaknesses ?? '' }}" name="weaknesses">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="pros" class="control-label">Pros<span class="text-danger">*</span></label>
                            <textarea required class="form-control" id="pros" name="pros">{{ $data->scout_report->pros ?? '' }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="cons" class="control-label">Cons<span class="text-danger">*</span></label>
                            <textarea required class="form-control" id="cons" name="cons">{{ $data->scout_report->cons ?? '' }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="conclusion" class="control-label">Conclusion<span class="text-danger">*</span></label>
                            <div class="radio radio-danger mb-2">
                                <input id="discard" type="radio" value="1" name="conclusion" {{ (isset($data->scout_report->conclusion) && $data->scout_report->conclusion==1) ? 'checked' : '' }}>
                                <label for="discard">
                                    Discard player
                                </label>
                            </div>
                            <div class="radio radio-warning mb-2">
                                <input id="continue" type="radio" value="2" name="conclusion" {{ (isset($data->scout_report->conclusion) && $data->scout_report->conclusion==2) ? 'checked' : '' }}>
                                <label for="continue">
                                    Continue watching
                                </label>
                            </div>
                            <div class="radio radio-success mb-2">
                                <input id="sign" type="radio" value="3" name="conclusion" {{ (isset($data->scout_report->conclusion) && $data->scout_report->conclusion==3) ? 'checked' : '' }}>
                                <label for="sign">
                                    Sign the player
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <textarea id="other" class="form-control">{{ $data->scout_report->other ?? '' }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-info waves-effect waves-light" onclick="saveScout()">Save changes</button>
            </div>
        </div>
    </div>
</div><!-- /.modal -->
<div id="injuries-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Injuries</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body p-4">
                <div class="row">
                    <div class="injury" style="width: 100%">
                    @php $i = 0; @endphp
                    @foreach ($data->injury as $injury)
                        <div class="form-group" style="border: 1px solid #6f7983; padding: 15px;">
                            @if ($i > 0)
                                <button class="btn btn-danger btn-xs" style="margin-left: calc(100% - 60px)" onclick="deleteInjury(this)">Delete</button>
                            @endif
                            <label for="injury" class="control-label">Injury<span class="text-danger">*</span></label>
                            <input type="text" required class="form-control" value="{{ $injury->injury ?? '' }}" name="injury">
                            <label for="injury_date" class="control-label mt-1">Date of injury<span class="text-danger">*</span></label>
                            <input type="text" required class="form-control" value="{{ $injury->injury_date ?? '' }}" name="injury_date">
                            <label for="description" class="control-label mt-1">Description and evolution<span class="text-danger">*</span></label>
                            <input type="text" required class="form-control" value="{{ $injury->description ?? '' }}" name="description">
                        </div>
                        @php ++$i; @endphp
                    @endforeach
                    @if ($i == 0)
                        <div class="form-group" style="border: 1px solid #6f7983; padding: 15px;">
                            <label for="injury" class="control-label">Injury<span class="text-danger">*</span></label>
                            <input type="text" required class="form-control" value="" name="injury">
                            <label for="injury_date" class="control-label mt-1">Date of injury<span class="text-danger">*</span></label>
                            <input type="text" required class="form-control" value="" name="injury_date">
                            <label for="description" class="control-label mt-1">Description and evolution<span class="text-danger">*</span></label>
                            <input type="text" required class="form-control" value="" name="description">
                        </div>
                    @endif
                    </div>
                    <div class="col-md-12 text-right">
                        <button class="col-md-auto btn btn-link text-white waves-effect" onclick="addInjury()">Add Injury</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-info waves-effect waves-light" onclick="saveInjury()">Save changes</button>
            </div>
        </div>
    </div>
</div><!-- /.modal -->
<div id="video-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Video</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body p-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="main_video" class="control-label">Add link to main video<span class="text-danger">*</span></label>
                            <input type="text" required class="form-control" value="{{ $data->video->main_video ?? '' }}" id="main_video">
                            <label for="another_video" class="control-label mt-1">Add another video<span class="text-danger">*</span></label>
                            <input type="text" required class="form-control" value="{{ $data->video->another_video ?? '' }}" id="another_video">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-info waves-effect waves-light" onclick="saveVideo()">Save changes</button>
            </div>
        </div>
    </div>
</div><!-- /.modal -->
@endsection
@section('scripts')
@parent
    <!-- Soccer Field Diagram -->
    <script src="{{ asset('soccer_field/js/jquery.soccerfield.min.js') }}"></script>
    <!-- Moment JS -->
    <script src="{{ asset('user_assets/libs/moment/moment.min.js') }}"></script>
    <!-- Chart JS -->
    <script src="{{ asset('user_assets/libs/chart-js/Chart.bundle.min.js') }}"></script>

    <script src="{{ asset('user_assets/libs/flatpickr/flatpickr.min.js') }}"></script>

    <script src="{{ asset('erp_assets/select/js/select2.js') }}"></script>

    <script src="https://kendo.cdn.telerik.com/2017.2.621/js/jszip.min.js"></script>
    <script src="https://kendo.cdn.telerik.com/2017.2.621/js/kendo.all.min.js"></script>
    <script>
        function download() {
            kendo.drawing
                .drawDOM("#pdf_content",
                    {
                        // paperSize: "A4",
                        margin: { top: "1cm", bottom: "1cm" },
                        scale: 1,
                        // width: 1000,
                        // height: 2000
                    })
                .then(function(group){
                    kendo.drawing.pdf.saveAs(group, "Exported.pdf")
                });
        }
        function openAdditional(){
            $("#additional-info").modal({
                backdrop:'static',keyboard:false, show:true
            });
        }
        function openScout_Report(){
            $("#scout-report").modal({
                backdrop:'static',keyboard:false, show:true
            });
        }
        function openInjury(){
            $("#injuries-modal").modal({
                backdrop:'static',keyboard:false, show:true
            });
        }
        function openVideo(){
            $("#video-modal").modal({
                backdrop:'static',keyboard:false, show:true
            });
        }
        function formatRepo (repo) {
            if (repo.loading) {
                return repo.text;
            }

            let country_asset = "(" + repo.country_name + ")";
            if (repo.country_name == "") country_asset = "";
            var $container = $(
                "<p class='title mb-0'></p>"
            ).text(repo.team_name).append($("<p class='title mb-0' style='font-size: 12px'></p>").text(country_asset));
            return $container;
        }

        function formatRepoSelection (repo) {
            return repo.team_name || repo.text;
        }
        $(document).ready(function () {
            var languages = {
                'ach': {
                    nativeName: "Lwo",
                    englishName: "Acholi"
                },
                'ady': {
                    nativeName: "Адыгэбзэ",
                    englishName: "Adyghe"
                },
                'af': {
                    nativeName: "Afrikaans",
                    englishName: "Afrikaans"
                },
                'af-NA': {
                    nativeName: "Afrikaans (Namibia)",
                    englishName: "Afrikaans (Namibia)"
                },
                'af-ZA': {
                    nativeName: "Afrikaans (South Africa)",
                    englishName: "Afrikaans (South Africa)"
                },
                'ak': {
                    nativeName: "Tɕɥi",
                    englishName: "Akan"
                },
                'ar': {
                    nativeName: "العربية",
                    englishName: "Arabic"
                },
                // 'ar-AR': {
                //     nativeName: "العربية",
                //     englishName: "Arabic"
                // },
                'ar-MA': {
                    nativeName: "العربية",
                    englishName: "Arabic (Morocco)"
                },
                'ar-SA': {
                    nativeName: "العربية (السعودية)",
                    englishName: "Arabic (Saudi Arabia)"
                },
                'ay-BO': {
                    nativeName: "Aymar aru",
                    englishName: "Aymara"
                },
                'az': {
                    nativeName: "Azərbaycan dili",
                    englishName: "Azerbaijani"
                },
                // 'az-AZ': {
                //     nativeName: "Azərbaycan dili",
                //     englishName: "Azerbaijani"
                // },
                'be-BY': {
                    nativeName: "Беларуская",
                    englishName: "Belarusian"
                },
                'bg': {
                    nativeName: "Български",
                    englishName: "Bulgarian"
                },
                // 'bg-BG': {
                //     nativeName: "Български",
                //     englishName: "Bulgarian"
                // },
                'bn': {
                    nativeName: "বাংলা",
                    englishName: "Bengali"
                },
                'bn-IN': {
                    nativeName: "বাংলা (ভারত)",
                    englishName: "Bengali (India)"
                },
                'bn-BD': {
                    nativeName: "বাংলা(বাংলাদেশ)",
                    englishName: "Bengali (Bangladesh)"
                },
                'bs-BA': {
                    nativeName: "Bosanski",
                    englishName: "Bosnian"
                },
                'ca': {
                    nativeName: "Català",
                    englishName: "Catalan"
                },
                // 'ca-ES': {
                //     nativeName: "Català",
                //     englishName: "Catalan"
                // },
                'cak': {
                    nativeName: "Maya Kaqchikel",
                    englishName: "Kaqchikel"
                },
                'ck-US': {
                    nativeName: "ᏣᎳᎩ (tsalagi)",
                    englishName: "Cherokee"
                },
                'cs': {
                    nativeName: "Čeština",
                    englishName: "Czech"
                },
                // 'cs-CZ': {
                //     nativeName: "Čeština",
                //     englishName: "Czech"
                // },
                'cy': {
                    nativeName: "Cymraeg",
                    englishName: "Welsh"
                },
                // 'cy-GB': {
                //     nativeName: "Cymraeg",
                //     englishName: "Welsh"
                // },
                'da': {
                    nativeName: "Dansk",
                    englishName: "Danish"
                },
                // 'da-DK': {
                //     nativeName: "Dansk",
                //     englishName: "Danish"
                // },
                'de': {
                    nativeName: "Deutsch",
                    englishName: "German"
                },
                'de-AT': {
                    nativeName: "Deutsch (Österreich)",
                    englishName: "German (Austria)"
                },
                'de-DE': {
                    nativeName: "Deutsch (Deutschland)",
                    englishName: "German (Germany)"
                },
                'de-CH': {
                    nativeName: "Deutsch (Schweiz)",
                    englishName: "German (Switzerland)"
                },
                'dsb': {
                    nativeName: "Dolnoserbšćina",
                    englishName: "Lower Sorbian"
                },
                'el': {
                    nativeName: "Ελληνικά",
                    englishName: "Greek"
                },
                'el-GR': {
                    nativeName: "Ελληνικά",
                    englishName: "Greek (Greece)"
                },
                'en': {
                    nativeName: "English",
                    englishName: "English"
                },
                'en-GB': {
                    nativeName: "English (UK)",
                    englishName: "English (UK)"
                },
                'en-AU': {
                    nativeName: "English (Australia)",
                    englishName: "English (Australia)"
                },
                'en-CA': {
                    nativeName: "English (Canada)",
                    englishName: "English (Canada)"
                },
                'en-IE': {
                    nativeName: "English (Ireland)",
                    englishName: "English (Ireland)"
                },
                'en-IN': {
                    nativeName: "English (India)",
                    englishName: "English (India)"
                },
                'en-PI': {
                    nativeName: "English (Pirate)",
                    englishName: "English (Pirate)"
                },
                'en-UD': {
                    nativeName: "English (Upside Down)",
                    englishName: "English (Upside Down)"
                },
                'en-US': {
                    nativeName: "English (US)",
                    englishName: "English (US)"
                },
                'en-ZA': {
                    nativeName: "English (South Africa)",
                    englishName: "English (South Africa)"
                },
                'en@pirate': {
                    nativeName: "English (Pirate)",
                    englishName: "English (Pirate)"
                },
                'eo': {
                    nativeName: "Esperanto",
                    englishName: "Esperanto"
                },
                // 'eo-EO': {
                //     nativeName: "Esperanto",
                //     englishName: "Esperanto"
                // },
                'es': {
                    nativeName: "Español",
                    englishName: "Spanish"
                },
                'es-AR': {
                    nativeName: "Español (Argentine)",
                    englishName: "Spanish (Argentina)"
                },
                'es-419': {
                    nativeName: "Español (Latinoamérica)",
                    englishName: "Spanish (Latin America)"
                },
                'es-CL': {
                    nativeName: "Español (Chile)",
                    englishName: "Spanish (Chile)"
                },
                'es-CO': {
                    nativeName: "Español (Colombia)",
                    englishName: "Spanish (Colombia)"
                },
                'es-EC': {
                    nativeName: "Español (Ecuador)",
                    englishName: "Spanish (Ecuador)"
                },
                'es-ES': {
                    nativeName: "Español (España)",
                    englishName: "Spanish (Spain)"
                },
                'es-LA': {
                    nativeName: "Español (Latinoamérica)",
                    englishName: "Spanish (Latin America)"
                },
                'es-NI': {
                    nativeName: "Español (Nicaragua)",
                    englishName: "Spanish (Nicaragua)"
                },
                'es-MX': {
                    nativeName: "Español (México)",
                    englishName: "Spanish (Mexico)"
                },
                'es-US': {
                    nativeName: "Español (Estados Unidos)",
                    englishName: "Spanish (United States)"
                },
                'es-VE': {
                    nativeName: "Español (Venezuela)",
                    englishName: "Spanish (Venezuela)"
                },
                'et': {
                    nativeName: "eesti keel",
                    englishName: "Estonian"
                },
                'et-EE': {
                    nativeName: "Eesti (Estonia)",
                    englishName: "Estonian (Estonia)"
                },
                'eu': {
                    nativeName: "Euskara",
                    englishName: "Basque"
                },
                // 'eu-ES': {
                //     nativeName: "Euskara",
                //     englishName: "Basque"
                // },
                'fa': {
                    nativeName: "فارسی",
                    englishName: "Persian"
                },
                // 'fa-IR': {
                //     nativeName: "فارسی",
                //     englishName: "Persian"
                // },
                'fb-LT': {
                    nativeName: "Leet Speak",
                    englishName: "Leet"
                },
                'ff': {
                    nativeName: "Fulah",
                    englishName: "Fulah"
                },
                'fi': {
                    nativeName: "Suomi",
                    englishName: "Finnish"
                },
                // 'fi-FI': {
                //     nativeName: "Suomi",
                //     englishName: "Finnish"
                // },
                'fo-FO': {
                    nativeName: "Føroyskt",
                    englishName: "Faroese"
                },
                'fr': {
                    nativeName: "Français",
                    englishName: "French"
                },
                'fr-CA': {
                    nativeName: "Français (Canada)",
                    englishName: "French (Canada)"
                },
                'fr-FR': {
                    nativeName: "Français (France)",
                    englishName: "French (France)"
                },
                'fr-BE': {
                    nativeName: "Français (Belgique)",
                    englishName: "French (Belgium)"
                },
                'fr-CH': {
                    nativeName: "Français (Suisse)",
                    englishName: "French (Switzerland)"
                },
                'fy-NL': {
                    nativeName: "Frysk",
                    englishName: "Frisian (West)"
                },
                'ga': {
                    nativeName: "Gaeilge",
                    englishName: "Irish"
                },
                'ga-IE': {
                    nativeName: "Gaeilge (Gaelic)",
                    englishName: "Irish (Gaelic)"
                },
                'gl': {
                    nativeName: "Galego",
                    englishName: "Galician"
                },
                // 'gl-ES': {
                //     nativeName: "Galego",
                //     englishName: "Galician"
                // },
                'gn-PY': {
                    nativeName: "Avañe'ẽ",
                    englishName: "Guarani"
                },
                'gu-IN': {
                    nativeName: "ગુજરાતી",
                    englishName: "Gujarati"
                },
                'gx-GR': {
                    nativeName: "Ἑλληνική ἀρχαία",
                    englishName: "Classical Greek"
                },
                'he': {
                    nativeName: "עברית‏",
                    englishName: "Hebrew"
                },
                // 'he-IL': {
                //     nativeName: "עברית‏",
                //     englishName: "Hebrew"
                // },
                'hi': {
                    nativeName: "हिन्दी",
                    englishName: "Hindi"
                },
                // 'hi-IN': {
                //     nativeName: "हिन्दी",
                //     englishName: "Hindi"
                // },
                'hr': {
                    nativeName: "Hrvatski",
                    englishName: "Croatian"
                },
                // 'hr-HR': {
                //     nativeName: "Hrvatski",
                //     englishName: "Croatian"
                // },
                'hsb': {
                    nativeName: "Hornjoserbšćina",
                    englishName: "Upper Sorbian"
                },
                'ht': {
                    nativeName: "Kreyòl",
                    englishName: "Haitian Creole"
                },
                'hu': {
                    nativeName: "Magyar",
                    englishName: "Hungarian"
                },
                // 'hu-HU': {
                //     nativeName: "Magyar",
                //     englishName: "Hungarian"
                // },
                'hy-AM': {
                    nativeName: "Հայերեն",
                    englishName: "Armenian"
                },
                'id': {
                    nativeName: "Bahasa Indonesia",
                    englishName: "Indonesian"
                },
                // 'id-ID': {
                //     nativeName: "Bahasa Indonesia",
                //     englishName: "Indonesian"
                // },
                'is': {
                    nativeName: "Íslenska",
                    englishName: "Icelandic"
                },
                'is-IS': {
                    nativeName: "Íslenska (Iceland)",
                    englishName: "Icelandic (Iceland)"
                },
                'it': {
                    nativeName: "Italiano",
                    englishName: "Italian"
                },
                // 'it-IT': {
                //     nativeName: "Italiano",
                //     englishName: "Italian"
                // },
                'ja': {
                    nativeName: "日本語",
                    englishName: "Japanese"
                },
                // 'ja-JP': {
                //     nativeName: "日本語",
                //     englishName: "Japanese"
                // },
                'jv-ID': {
                    nativeName: "Basa Jawa",
                    englishName: "Javanese"
                },
                'ka-GE': {
                    nativeName: "ქართული",
                    englishName: "Georgian"
                },
                'kk-KZ': {
                    nativeName: "Қазақша",
                    englishName: "Kazakh"
                },
                'km': {
                    nativeName: "ភាសាខ្មែរ",
                    englishName: "Khmer"
                },
                // 'km-KH': {
                //     nativeName: "ភាសាខ្មែរ",
                //     englishName: "Khmer"
                // },
                'kab': {
                    nativeName: "Taqbaylit",
                    englishName: "Kabyle"
                },
                'kn': {
                    nativeName: "ಕನ್ನಡ",
                    englishName: "Kannada"
                },
                'kn-IN': {
                    nativeName: "ಕನ್ನಡ (India)",
                    englishName: "Kannada (India)"
                },
                'ko': {
                    nativeName: "한국어",
                    englishName: "Korean"
                },
                'ko-KR': {
                    nativeName: "한국어 (韩国)",
                    englishName: "Korean (Korea)"
                },
                'ku-TR': {
                    nativeName: "Kurdî",
                    englishName: "Kurdish"
                },
                'la': {
                    nativeName: "Latin",
                    englishName: "Latin"
                },
                // 'la-VA': {
                //     nativeName: "Latin",
                //     englishName: "Latin"
                // },
                'lb': {
                    nativeName: "Lëtzebuergesch",
                    englishName: "Luxembourgish"
                },
                'li-NL': {
                    nativeName: "Lèmbörgs",
                    englishName: "Limburgish"
                },
                'lt': {
                    nativeName: "Lietuvių",
                    englishName: "Lithuanian"
                },
                // 'lt-LT': {
                //     nativeName: "Lietuvių",
                //     englishName: "Lithuanian"
                // },
                'lv': {
                    nativeName: "Latviešu",
                    englishName: "Latvian"
                },
                // 'lv-LV': {
                //     nativeName: "Latviešu",
                //     englishName: "Latvian"
                // },
                'mai': {
                    nativeName: "मैथिली, মৈথিলী",
                    englishName: "Maithili"
                },
                'mg-MG': {
                    nativeName: "Malagasy",
                    englishName: "Malagasy"
                },
                'mk': {
                    nativeName: "Македонски",
                    englishName: "Macedonian"
                },
                'mk-MK': {
                    nativeName: "Македонски (Македонски)",
                    englishName: "Macedonian (Macedonian)"
                },
                'ml': {
                    nativeName: "മലയാളം",
                    englishName: "Malayalam"
                },
                // 'ml-IN': {
                //     nativeName: "മലയാളം",
                //     englishName: "Malayalam"
                // },
                'mn-MN': {
                    nativeName: "Монгол",
                    englishName: "Mongolian"
                },
                'mr': {
                    nativeName: "मराठी",
                    englishName: "Marathi"
                },
                // 'mr-IN': {
                //     nativeName: "मराठी",
                //     englishName: "Marathi"
                // },
                'ms': {
                    nativeName: "Bahasa Melayu",
                    englishName: "Malay"
                },
                // 'ms-MY': {
                //     nativeName: "Bahasa Melayu",
                //     englishName: "Malay"
                // },
                'mt': {
                    nativeName: "Malti",
                    englishName: "Maltese"
                },
                // 'mt-MT': {
                //     nativeName: "Malti",
                //     englishName: "Maltese"
                // },
                'my': {
                    nativeName: "ဗမာစကာ",
                    englishName: "Burmese"
                },
                'no': {
                    nativeName: "Norsk",
                    englishName: "Norwegian"
                },
                'nb': {
                    nativeName: "Norsk (bokmål)",
                    englishName: "Norwegian (bokmal)"
                },
                // 'nb-NO': {
                //     nativeName: "Norsk (bokmål)",
                //     englishName: "Norwegian (bokmal)"
                // },
                'ne': {
                    nativeName: "नेपाली",
                    englishName: "Nepali"
                },
                // 'ne-NP': {
                //     nativeName: "नेपाली",
                //     englishName: "Nepali"
                // },
                'nl': {
                    nativeName: "Nederlands",
                    englishName: "Dutch"
                },
                'nl-BE': {
                    nativeName: "Nederlands (België)",
                    englishName: "Dutch (Belgium)"
                },
                'nl-NL': {
                    nativeName: "Nederlands (Nederland)",
                    englishName: "Dutch (Netherlands)"
                },
                'nn-NO': {
                    nativeName: "Norsk (nynorsk)",
                    englishName: "Norwegian (nynorsk)"
                },
                'oc': {
                    nativeName: "Occitan",
                    englishName: "Occitan"
                },
                'or-IN': {
                    nativeName: "ଓଡ଼ିଆ",
                    englishName: "Oriya"
                },
                'pa': {
                    nativeName: "ਪੰਜਾਬੀ",
                    englishName: "Punjabi"
                },
                'pa-IN': {
                    nativeName: "ਪੰਜਾਬੀ (ਭਾਰਤ ਨੂੰ)",
                    englishName: "Punjabi (India)"
                },
                'pl': {
                    nativeName: "Polski",
                    englishName: "Polish"
                },
                // 'pl-PL': {
                //     nativeName: "Polski",
                //     englishName: "Polish"
                // },
                'ps-AF': {
                    nativeName: "پښتو",
                    englishName: "Pashto"
                },
                'pt': {
                    nativeName: "Português",
                    englishName: "Portuguese"
                },
                'pt-BR': {
                    nativeName: "Português (Brasil)",
                    englishName: "Portuguese (Brazil)"
                },
                'pt-PT': {
                    nativeName: "Português (Portugal)",
                    englishName: "Portuguese (Portugal)"
                },
                'qu-PE': {
                    nativeName: "Qhichwa",
                    englishName: "Quechua"
                },
                'rm-CH': {
                    nativeName: "Rumantsch",
                    englishName: "Romansh"
                },
                'ro': {
                    nativeName: "Română",
                    englishName: "Romanian"
                },
                // 'ro-RO': {
                //     nativeName: "Română",
                //     englishName: "Romanian"
                // },
                'ru': {
                    nativeName: "Русский",
                    englishName: "Russian"
                },
                // 'ru-RU': {
                //     nativeName: "Русский",
                //     englishName: "Russian"
                // },
                'sa-IN': {
                    nativeName: "संस्कृतम्",
                    englishName: "Sanskrit"
                },
                'se-NO': {
                    nativeName: "Davvisámegiella",
                    englishName: "Northern Sámi"
                },
                'si-LK': {
                    nativeName: "පළාත",
                    englishName: "Sinhala (Sri Lanka)"
                },
                'sk': {
                    nativeName: "Slovenčina",
                    englishName: "Slovak"
                },
                'sk-SK': {
                    nativeName: "Slovenčina (Slovakia)",
                    englishName: "Slovak (Slovakia)"
                },
                'sl': {
                    nativeName: "Slovenščina",
                    englishName: "Slovenian"
                },
                // 'sl-SI': {
                //     nativeName: "Slovenščina",
                //     englishName: "Slovenian"
                // },
                'so-SO': {
                    nativeName: "Soomaaliga",
                    englishName: "Somali"
                },
                'sq': {
                    nativeName: "Shqip",
                    englishName: "Albanian"
                },
                // 'sq-AL': {
                //     nativeName: "Shqip",
                //     englishName: "Albanian"
                // },
                'sr': {
                    nativeName: "Српски",
                    englishName: "Serbian"
                },
                'sr-RS': {
                    nativeName: "Српски (Serbia)",
                    englishName: "Serbian (Serbia)"
                },
                'su': {
                    nativeName: "Basa Sunda",
                    englishName: "Sundanese"
                },
                'sv': {
                    nativeName: "Svenska",
                    englishName: "Swedish"
                },
                // 'sv-SE': {
                //     nativeName: "Svenska",
                //     englishName: "Swedish"
                // },
                'sw': {
                    nativeName: "Kiswahili",
                    englishName: "Swahili"
                },
                'sw-KE': {
                    nativeName: "Kiswahili",
                    englishName: "Swahili (Kenya)"
                },
                'ta': {
                    nativeName: "தமிழ்",
                    englishName: "Tamil"
                },
                // 'ta-IN': {
                //     nativeName: "தமிழ்",
                //     englishName: "Tamil"
                // },
                'te': {
                    nativeName: "తెలుగు",
                    englishName: "Telugu"
                },
                // 'te-IN': {
                //     nativeName: "తెలుగు",
                //     englishName: "Telugu"
                // },
                'tg': {
                    nativeName: "забо́ни тоҷикӣ́",
                    englishName: "Tajik"
                },
                // 'tg-TJ': {
                //     nativeName: "тоҷикӣ",
                //     englishName: "Tajik"
                // },
                'th': {
                    nativeName: "ภาษาไทย",
                    englishName: "Thai"
                },
                'th-TH': {
                    nativeName: "ภาษาไทย (ประเทศไทย)",
                    englishName: "Thai (Thailand)"
                },
                'tl': {
                    nativeName: "Filipino",
                    englishName: "Filipino"
                },
                // 'tl-PH': {
                //     nativeName: "Filipino",
                //     englishName: "Filipino"
                // },
                'tlh': {
                    nativeName: "tlhIngan-Hol",
                    englishName: "Klingon"
                },
                'tr': {
                    nativeName: "Türkçe",
                    englishName: "Turkish"
                },
                // 'tr-TR': {
                //     nativeName: "Türkçe",
                //     englishName: "Turkish"
                // },
                'tt-RU': {
                    nativeName: "татарча",
                    englishName: "Tatar"
                },
                'uk': {
                    nativeName: "Українська",
                    englishName: "Ukrainian"
                },
                // 'uk-UA': {
                //     nativeName: "Українська",
                //     englishName: "Ukrainian"
                // },
                'ur': {
                    nativeName: "اردو",
                    englishName: "Urdu"
                },
                // 'ur-PK': {
                //     nativeName: "اردو",
                //     englishName: "Urdu"
                // },
                'uz': {
                    nativeName: "O'zbek",
                    englishName: "Uzbek"
                },
                // 'uz-UZ': {
                //     nativeName: "O'zbek",
                //     englishName: "Uzbek"
                // },
                'vi': {
                    nativeName: "Tiếng Việt",
                    englishName: "Vietnamese"
                },
                // 'vi-VN': {
                //     nativeName: "Tiếng Việt",
                //     englishName: "Vietnamese"
                // },
                'xh-ZA': {
                    nativeName: "isiXhosa",
                    englishName: "Xhosa"
                },
                'yi': {
                    nativeName: "ייִדיש",
                    englishName: "Yiddish"
                },
                'yi-DE': {
                    nativeName: "ייִדיש (German)",
                    englishName: "Yiddish (German)"
                },
                'zh': {
                    nativeName: "中文",
                    englishName: "Chinese"
                },
                'zh-Hans': {
                    nativeName: "中文简体",
                    englishName: "Chinese Simplified"
                },
                'zh-Hant': {
                    nativeName: "中文繁體",
                    englishName: "Chinese Traditional"
                },
                'zh-CN': {
                    nativeName: "中文（中国）",
                    englishName: "Chinese Simplified (China)"
                },
                'zh-HK': {
                    nativeName: "中文（香港）",
                    englishName: "Chinese Traditional (Hong Kong)"
                },
                'zh-SG': {
                    nativeName: "中文（新加坡）",
                    englishName: "Chinese Simplified (Singapore)"
                },
                'zh-TW': {
                    nativeName: "中文（台灣）",
                    englishName: "Chinese Traditional (Taiwan)"
                },
                'zu-ZA': {
                    nativeName: "isiZulu",
                    englishName: "Zulu"
                }
            };
            let lang_arrays_str = "{{ $data->additional->languages ?? '' }}";
            let lang_arrays = lang_arrays_str.split(",");
            for (r in languages)
            {
                if (lang_arrays.includes(languages[r].englishName))
                {
                    $('#language').append($("<option selected></option>").text(languages[r].englishName).attr("value", languages[r].englishName));
                } else {
                    $('#language').append($("<option></option>").text(languages[r].englishName).attr("value", languages[r].englishName));
                }
            }
            $("#language").select2({
                allowClear: false,
                dropdownAutoWidth: true,
                width: 'element',
                minimumResultsForSearch: 20, //prevent filter input
                maximumSelectionSize: 20 // prevent scrollbar
            });
            @if (isset($data->additional->national_team))
                var newOption = new Option("{{ $data->additional->getNationalTeamName() }}", "{{ $data->additional->national_team }}", false, false);
                $('#national_team').append(newOption).trigger('change');
                $('#national_team').children('[value="{{ $data->additional->national_team }}"]').attr(
                    {
                        'team_link':"", //dynamic value from data array
                        'team_name':"{{ $data->additional->getNationalTeamName() }}" // fixed value
                    }
                );
            @endif
            $('#national_team').select2({
                ajax: {
                    type: "GET",
                    url: "{{ route('user.getteams') }}",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        let result = {"name":params.term};
                        return result;
                    },
                    processResults: function (data, params) {
                        return {
                            results:data
                        };
                    },
                    cache: true
                },
                dropdownParent: $("#additional-info"),
                tags: false,
                placeholder: 'Search for a team',
                minimumInputLength: 3,
                templateResult: formatRepo,
                templateSelection: formatRepoSelection
            }).on('select2:select', function (e) {
                let data = e.params.data;
                $(this).children('[value="'+data.id+'"]').attr(
                    {
                        'team_link':data.team_link, //dynamic value from data array
                        'team_name':data.team_name // fixed value
                    }
                );
            });
            @if (isset($data->additional->first_appearance_team))
                newOption = new Option("{{ $data->additional->getFirstAppearanceTeamName() }}", "{{ $data->additional->first_appearance_team }}", false, false);
                $('#first_appearance_team').append(newOption).trigger('change');
                $('#first_appearance_team').children('[value="{{ $data->additional->first_appearance_team }}"]').attr(
                    {
                        'team_link':"", //dynamic value from data array
                        'team_name':"{{ $data->additional->getFirstAppearanceTeamName() }}" // fixed value
                    }
                );
            @endif

            $('#first_appearance_team').select2({
                ajax: {
                    type: "GET",
                    url: "{{ route('user.getteams') }}",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        let result = {"name":params.term};
                        return result;
                    },
                    processResults: function (data, params) {
                        return {
                            results:data
                        };
                    },
                    cache: true
                },
                dropdownParent: $("#additional-info"),
                tags: false,
                placeholder: 'Search for a team',
                minimumInputLength: 3,
                templateResult: formatRepo,
                templateSelection: formatRepoSelection
            }).on('select2:select', function (e) {
                let data = e.params.data;
                $(this).children('[value="'+data.id+'"]').attr(
                    {
                        'team_link':data.team_link, //dynamic value from data array
                        'team_name':data.team_name // fixed value
                    }
                );
            });
            $("#first_appearance_date").flatpickr();
            $("#first_appearance_division").flatpickr();
            $("#contact_expires").flatpickr();
            $("input[name=injury_date]").flatpickr();
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
{{--            @if ($position->specify == "Sweeper") data.push({name: 'SW ', position: 'C_SW'}); @endif--}}
{{--            @if ($position->specify == "Left Full-back") data.push({name: 'LB ', position: 'L_B'}); @endif--}}
{{--            @if ($position->specify == "Centre-back") data.push({name: 'CB ', position: 'C_B'}); @endif--}}
{{--            @if ($position->specify == "Right Full-back") data.push({name: 'RB ', position: 'R_B'}); @endif--}}
{{--            @if ($position->specify == "Left Wing-back") data.push({name: 'CWB ', position: 'L_WB'}); @endif--}}
{{--            @if ($position->specify == "Right Wing-back") data.push({name: 'RWB ', position: 'R_WB'}); @endif--}}
{{--            @if ($position->specify == "Defensive midfield") data.push({name: 'CDM ', position: 'C_DM'}); @endif--}}
{{--            @if ($position->specify == "Left Wide midfield") data.push({name: 'LM ', position: 'L_M'}); @endif--}}
{{--            @if ($position->specify == "Centre midfield") data.push({name: 'CM ', position: 'C_M'}); @endif--}}
{{--            @if ($position->specify == "Right Wide midfield") data.push({name: 'RM ', position: 'R_M'}); @endif--}}
{{--            @if ($position->specify == "Attacking midfield") data.push({name: 'CAM ', position: 'C_AM'}); @endif--}}
{{--            @if ($position->specify == "Left Winger") data.push({name: 'LW ', position: 'L_W'}); @endif--}}
{{--            @if ($position->specify == "Second striker") data.push({name: 'CS ', position: 'C_S'}); @endif--}}
{{--            @if ($position->specify == "Right Winger") data.push({name: 'RW ', position: 'R_W'}); @endif--}}
{{--            @if ($position->specify == "Centre forward") data.push({name: 'CF ', position: 'C_F'}); @endif--}}
{{--            @if ($position->specify == "Goalkeeper") data.push({name: 'GK ', position: 'C_GK'}); @endif--}}

{{--            @if ($position->specify == "Left Centre-back") data.push({name: 'LCB ', position: 'LC_B'}); @endif--}}
{{--            @if ($position->specify == "Right Centre-back") data.push({name: 'RCB ', position: 'RC_B'}); @endif--}}
{{--            @if ($position->specify == "Left Defensive midfield") data.push({name: 'LDM ', position: 'LC_DM'}); @endif--}}
{{--            @if ($position->specify == "Right Defensive midfield") data.push({name: 'RDM ', position: 'RC_DM'}); @endif--}}
{{--            @if ($position->specify == "Left Centre midfield") data.push({name: 'LCM ', position: 'LC_M'}); @endif--}}
{{--            @if ($position->specify == "Right Centre midfield") data.push({name: 'RCM ', position: 'RC_M'}); @endif--}}
{{--            @if ($position->specify == "Left Attacking midfield") data.push({name: 'LAM ', position: 'LC_AM'}); @endif--}}
{{--            @if ($position->specify == "Right Attacking midfield") data.push({name: 'RAM ', position: 'RC_AM'}); @endif--}}
{{--            @if ($position->specify == "Left striker") data.push({name: 'LS ', position: 'LC_S'}); @endif--}}
{{--            @if ($position->specify == "Right striker") data.push({name: 'RS ', position: 'RC_S'}); @endif--}}
{{--            @if ($position->specify == "Left Centre forward") data.push({name: 'LCF ', position: 'LC_F'}); @endif--}}
{{--            @if ($position->specify == "Right Centre forward") data.push({name: 'RCF ', position: 'RC_F'}); @endif--}}
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
            let isGoalkeeper = 0;
            for (const r in data) {
                let before = data[r].position.split("_")[0];
                let after = data[r].position.split("_")[1];
                let obj = $(".posY-" + before + '.posX-' + after).find(".soccerfield-player-name");
                if (posIndex == 0) {
                    $(obj).attr("style", "background: #00ffc4; width: 15px !important; min-height: 15px !important; margin-top: 11px !important; margin-left: 2px !important;");
                }
                if (data[r].position == 'C_GK')
                {
                    isGoalkeeper = 1;
                }
                ++posIndex;
            }
            Chart.defaults.global.defaultFontColor = "rgba(255,255,255,0.5)";
            Chart.defaults.scale.gridLines.color = "rgba(255,255,255,0.05)";
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
            }
            $("#general-radar").css("height", "200px");
            $("#general-radar").css("width", "300px");
            new Chart(document.getElementById("general-radar").getContext("2d"), {
                type: 'radar',
                data: {
                    labels: general_radar_label,
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

            $("[role=progressbar]").parent().parent().css("display", "none");
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
        function saveAdditional() {
            let languages = $("#language").val().join(',');
            let national_team = $("#national_team").val();
            let first_appearance_date = $("#first_appearance_date").val();
            let first_appearance_team = $("#first_appearance_team").val();
            let first_appearance_division = $("#first_appearance_division").val();
            let contact_expires = $("#contact_expires").val();
            let market_value = $("#market_value").val();
            if (languages == "" || languages == null)
            {
                $.NotificationApp.send(
                    "Warning",
                    "You must type Languages.",
                    "top-right",
                    "#da8609",
                    "warning");
                return;
            }
            if (national_team == null || national_team == "")
            {
                $.NotificationApp.send(
                    "Warning",
                    "You must type National Team.",
                    "top-right",
                    "#da8609",
                    "warning");
                return;
            }
            if (first_appearance_date == "" || first_appearance_date == null)
            {
                $.NotificationApp.send(
                    "Warning",
                    "You must type First appearance in National team.",
                    "top-right",
                    "#da8609",
                    "warning");
                return;
            }
            if (first_appearance_team == "" || first_appearance_team == null)
            {
                $.NotificationApp.send(
                    "Warning",
                    "You must type First appearance in first division (Team).",
                    "top-right",
                    "#da8609",
                    "warning");
                return;
            }
            if (first_appearance_division == "" || first_appearance_division == null)
            {
                $.NotificationApp.send(
                    "Warning",
                    "You must type First appearance in First Division.",
                    "top-right",
                    "#da8609",
                    "warning");
                return;
            }
            if (contact_expires == "" || contact_expires == null)
            {
                $.NotificationApp.send(
                    "Warning",
                    "You must type Contact Expires.",
                    "top-right",
                    "#da8609",
                    "warning");
                return;
            }
            if (market_value == "" || market_value == null)
            {
                $.NotificationApp.send(
                    "Warning",
                    "You must type Market Value.",
                    "top-right",
                    "#da8609",
                    "warning");
                return;
            }
            $.ajax({
                url: "{{ route('user.save_additional', $data->id) }}",
                data: {languages: languages, national_team: national_team, first_appearance_date: first_appearance_date
                    , first_appearance_team: first_appearance_team, first_appearance_division: first_appearance_division, contact_expires: contact_expires, market_value: market_value},
                type: 'GET',
                dataType: 'text', // added data type
                success: function(res) {
                    $.NotificationApp.send(
                        "Notification",
                        "Additional Information was saved successfully.",
                        "top-right",
                        "#da8609",
                        "success");
                    $("#additional-info").modal('hide');
                },
                error: function (jqXHR, exception) {
                    $.NotificationApp.send(
                        "Warning",
                        "Additional Information was not saved.",
                        "top-right",
                        "#da8609",
                        "warning");
                }
            });
        }
        function saveScout() {
            let general_info = $("#general_info").val();
            let strengths = $("#strengths").val();
            let weaknesses = $("#weaknesses").val();
            let pros = $("#pros").val();
            let cons = $("#cons").val();
            let conclusion = 0;
            $("input[name=conclusion]").each(function (){
                if ($(this).prop("checked"))
                    conclusion = $(this).val();
            });
            let other = $("#other").val();
            if (general_info == "" || general_info == null)
            {
                $.NotificationApp.send(
                    "Warning",
                    "You must type General Information.",
                    "top-right",
                    "#da8609",
                    "warning");
                return;
            }
            if (strengths == null || strengths == "")
            {
                $.NotificationApp.send(
                    "Warning",
                    "You must type Strengths.",
                    "top-right",
                    "#da8609",
                    "warning");
                return;
            }
            if (weaknesses == "" || weaknesses == null)
            {
                $.NotificationApp.send(
                    "Warning",
                    "You must type Weaknesses.",
                    "top-right",
                    "#da8609",
                    "warning");
                return;
            }
            if (pros == "" || pros == null)
            {
                $.NotificationApp.send(
                    "Warning",
                    "You must type Pros.",
                    "top-right",
                    "#da8609",
                    "warning");
                return;
            }
            if (cons == "" || cons == null)
            {
                $.NotificationApp.send(
                    "Warning",
                    "You must type Cons.",
                    "top-right",
                    "#da8609",
                    "warning");
                return;
            }
            if (conclusion == "" || conclusion == null || conclusion == 0)
            {
                $.NotificationApp.send(
                    "Warning",
                    "You must select Conclusion.",
                    "top-right",
                    "#da8609",
                    "warning");
                return;
            }
            if (other == "" || other == null)
            {
                $.NotificationApp.send(
                    "Warning",
                    "You must type Other.",
                    "top-right",
                    "#da8609",
                    "warning");
                return;
            }
            $.ajax({
                url: "{{ route('user.save_scout', $data->id) }}",
                data: {general_info: general_info, strengths: strengths, weaknesses: weaknesses
                    , pros: pros, cons: cons, conclusion: conclusion, other: other},
                type: 'GET',
                dataType: 'text', // added data type
                success: function(res) {
                    $.NotificationApp.send(
                        "Notification",
                        "Scout Report was saved successfully.",
                        "top-right",
                        "#da8609",
                        "success");
                    $("#scout-report").modal('hide');
                },
                error: function (jqXHR, exception) {
                    $.NotificationApp.send(
                        "Warning",
                        "Scout Report was not saved.",
                        "top-right",
                        "#da8609",
                        "warning");
                }
            });
        }
        function addInjury() {
            $(".injury").append(
                '                        <div class="form-group" index = "1" style="border: 1px solid #6f7983; padding: 15px;">\n' +
                '                            <button class="btn btn-danger btn-xs" style="margin-left: calc(100% - 60px)" onclick="deleteInjury(this)">Delete</button>\n' +
                '                            <label for="injury" class="control-label">Injury<span class="text-danger">*</span></label>\n' +
                '                            <input type="text" required class="form-control" value="" name="injury">\n' +
                '                            <label for="injury_date" class="control-label mt-1">Date of injury<span class="text-danger">*</span></label>\n' +
                '                            <input type="text" required class="form-control" value="" name="injury_date">\n' +
                '                            <label for="description" class="control-label mt-1">Description and evolution<span class="text-danger">*</span></label>\n' +
                '                            <input type="text" required class="form-control" value="" name="description">\n' +
                '                        </div>');
            $("input[name=injury_date]").last().flatpickr();
        }
        function saveInjury() {
            let injury = [];
            $("input[name=injury]").each(function (){
                injury.push($(this).val());
            })
            let injury_date = [];
            $("input[name=injury_date]").each(function (){
                injury_date.push($(this).val());
            })
            let description = [];
            $("input[name=description]").each(function (){
                description.push($(this).val());
            })
            if (injury.length == 0 || injury.includes("") == true)
            {
                $.NotificationApp.send(
                    "Warning",
                    "You must type all Injuries.",
                    "top-right",
                    "#da8609",
                    "warning");
                return;
            }
            if (injury_date.length == 0 || injury_date.includes("") == true)
            {
                $.NotificationApp.send(
                    "Warning",
                    "You must type all Dates of injury.",
                    "top-right",
                    "#da8609",
                    "warning");
                return;
            }
            if (description.length == 0 || description.includes("") == true)
            {
                $.NotificationApp.send(
                    "Warning",
                    "You must type all Description and evolutions.",
                    "top-right",
                    "#da8609",
                    "warning");
                return;
            }
            $.ajax({
                url: "{{ route('user.save_injury', $data->id) }}",
                data: {injury: injury, injury_date: injury_date, description: description},
                type: 'GET',
                dataType: 'text', // added data type
                success: function(res) {
                    $.NotificationApp.send(
                        "Notification",
                        "Injuries was saved successfully.",
                        "top-right",
                        "#da8609",
                        "success");
                    $("#injuries-modal").modal('hide');
                },
                error: function (jqXHR, exception) {
                    $.NotificationApp.send(
                        "Warning",
                        "Injuries Report was not saved.",
                        "top-right",
                        "#da8609",
                        "warning");
                }
            });
        }
        function deleteInjury(obj){
            if(!confirm("are you really?")) return;
            $(obj).parent().remove();
        }
        function saveVideo() {
            let main_video = $("#main_video").val();
            let another_video = $("#another_video").val();
            if (main_video == "" || main_video == null)
            {
                $.NotificationApp.send(
                    "Warning",
                    "You must type Main Video link.",
                    "top-right",
                    "#da8609",
                    "warning");
                return;
            }
            $.ajax({
                url: "{{ route('user.save_video', $data->id) }}",
                data: {main_video: main_video, another_video: another_video},
                type: 'GET',
                dataType: 'text', // added data type
                success: function(res) {
                    $.NotificationApp.send(
                        "Notification",
                        "Video was saved successfully.",
                        "top-right",
                        "#da8609",
                        "success");
                    $("#video-modal").modal('hide');
                },
                error: function (jqXHR, exception) {
                    $.NotificationApp.send(
                        "Warning",
                        "Video was not saved.",
                        "top-right",
                        "#da8609",
                        "warning");
                }
            });
        }
    </script>
@endsection