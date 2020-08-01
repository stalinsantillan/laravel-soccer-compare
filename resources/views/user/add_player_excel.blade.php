@extends('layouts.user')
@section('styles')
    <link href="{{ asset('user_assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('user_assets/libs/dropify/dropify.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('user_assets/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('erp_assets/rangeslider-2.3.0/rangeslider.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('erp_assets/select/css/select2.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .rangeslider--horizontal {
            height: 15px;
            top: 11px;
        }
        .rangeslider__handle {
            width: 25px;
            height: 25px;
        }
        .rangeslider--horizontal .rangeslider__handle {
            top: -5px;
        }
        .rangeslider__fill {
            background: #36A2EB;
        }
        .rangeslider__handle {
            background: #adb5b2;
            border: #bfced0;
        }
        .rangeslider {
            background: #adb5bd;
        }
        .select2-container--default .select2-results__option--selected {
            background-color: #4c5a67;
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
                    <li class="breadcrumb-item active">{{ trans('global.add') }}({{ trans('cruds.player.excel') }})</li>
                </ol>
            </div>
            <h4 class="page-title">{{ trans('global.add') }} {{ trans('cruds.player.title') }}</h4>
        </div>
    </div>
</div>
<!-- end page title -->
<form role="form" id="add_player_form" method="post" action="{{ route('user.store_player') }}" enctype="multipart/form-data">
    @csrf
    <div class="card">
        <div class="card-header font-16">
            Profile
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-9">
                    <div class="row">
                        <div class="form-group row col-md-6">
                            <label for="name" class="col-md-4 col-form-label text-right">
                                Name<span class="text-danger">*</span>
                            </label>
                            <div class="col-md-7">
                                <input type="text" required class="form-control" id="name" name="name">
                            </div>
                        </div>
                        <div class="form-group row col-md-6">
                            <label for="surname" class="col-md-4 col-form-label text-right">
                                Surname<span class="text-danger">*</span>
                            </label>
                            <div class="col-md-7">
                                <input type="text" required class="form-control" id="surname" name="surname">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group row col-md-6">
                            <label for="nationality" class="col-md-4 col-form-label text-right">
                                Nationality<span class="text-danger">*</span>
                            </label>
                            <div class="col-md-7">
                                <select class="custom-select mr-sm-2" id="nationality" name="nationality">
                                </select>
                            </div>
                        </div>
                        <div class="form-group row col-md-6">
                            <label for="birthdate" class="col-md-4 col-form-label text-right">
                                Date of birth<span class="text-danger">*</span>
                            </label>
                            <div class="col-md-7">
                                <input type="text" required class="form-control" id="birthdate" name="birthdate">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group row col-md-6">
                            <label for="height" class="col-md-4 col-form-label text-right">
                                Height<span class="text-danger">*</span>
                            </label>
                            <div class="col-md-7">
                                <select class="custom-select mr-sm-2" required id="height" name="height">
                                </select>
                            </div>
                        </div>
                        <div class="form-group row col-md-6">
                            <label for="weight" class="col-md-4 col-form-label text-right">
                                Weight<span class="text-danger">*</span>
                            </label>
                            <div class="col-md-7">
                                <select class="custom-select mr-sm-2" required id="weight" name="weight">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group row col-md-6">
                            <label for="foot" class="col-md-4 col-form-label text-right">
                                Foot<span class="text-danger">*</span>
                            </label>
                            <div class="col-md-7">
                                <select class="custom-select mr-sm-2" required id="foot" name="foot">
                                    <option value="left">Left</option>
                                    <option value="right">Right</option>
                                    <option value="both">Both</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row col-md-6">
                            <label for="cur_team" class="col-md-4 col-form-label text-right">
                                Current Team<span class="text-danger">*</span>
                            </label>
                            <div class="col-md-7">
                                <select class="custom-select mr-sm-2" required id="cur_team" name="cur_team">
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group row">
                        <label for="photo1" class="col-md-3 col-form-label text-right">
                            Photo
                        </label>
                        <div class="col-md-7">
                            {{-- <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="photo" id="photo">
                                    <label class="custom-file-label" for="photo">Choose file</label>
                                </div>
                            </div> --}}
                            <input type="file" id="photo" name="photo" class="dropify" data-max-file-size="1M" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end card-box-->
    <div class="card">
        <div class="card-header font-16">
            Technical features
        </div>
        <div class="card-body">
            <div class="row position-panel">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="main_pos" class="col-md-4 col-form-label text-right">
                            Main Position<span class="text-danger">*</span>
                        </label>
                        <div class="col-md-7">
                            <select class="custom-select mr-sm-2" required id="main_pos" name="main_position[]">
                                <option>Defender</option>
                                <option>Midfielder</option>
                                <option>Forward</option>
                                <option>Goalkeeper</option>
                            </select>
                            <a href="javascript:addnewposition()" class="text-white-50" style="line-height: 30px">Add new position</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="position2" class="col-md-4 col-form-label text-right">
                            Specify Position
                        </label>
                        <div class="col-md-7">
                            <select class="custom-select mr-sm-2" required id="position2" name="spec_position[]">
                            </select>
                        </div>
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
            <div class="card-title font-15 font-weight-bold">
                Technical
            </div>
            <div class="row">
                <div class="form-group col-md-6 row">
                    <label for="corners" class="col-md-3 col-form-label text-right">
                        Corners
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="corners" name="corners">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="{{ $paramsetting->corners }}" step="0.1" match="corners" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="crossing" class="col-md-3 col-form-label text-right">
                        Crossing
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="crossing" name="crossing">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="{{ $paramsetting->crossing }}" step="0.1"  match="crossing" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="dribbling" class="col-md-3 col-form-label text-right">
                        Dribbling
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="dribbling" name="dribbling">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="{{ $paramsetting->dribbling }}" step="0.1"  match="dribbling" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="finishing" class="col-md-3 col-form-label text-right">
                        Finishing
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="finishing" name="finishing">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="{{ $paramsetting->finishing }}" step="0.1"  match="finishing" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="areial_reach" class="col-md-3 col-form-label text-right">
                        Aerial Reach
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="areial_reach" name="areial_reach">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="{{ $paramsetting->areial_reach }}" step="0.1"  match="areial_reach" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="command_of_area" class="col-md-3 col-form-label text-right">
                        Command Of Area
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="command_of_area" name="command_of_area">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="{{ $paramsetting->command_of_area }}" step="0.1"  match="command_of_area" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="communication" class="col-md-3 col-form-label text-right">
                        Communication
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="communication" name="communication">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="{{ $paramsetting->communication }}" step="0.1"  match="communication" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="eccentricity" class="col-md-3 col-form-label text-right">
                        Eccentricity
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="eccentricity" name="eccentricity">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="{{ $paramsetting->eccentricity }}" step="0.1"  match="eccentricity" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="first_touch" class="col-md-3 col-form-label text-right">
                        First Touch
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="first_touch" name="first_touch">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="{{ $paramsetting->first_touch }}" step="0.1"  match="first_touch" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="handling" class="col-md-3 col-form-label text-right">
                        Handling
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="handling" name="handling">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="{{ $paramsetting->handling }}" step="0.1"  match="handling" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="kicking" class="col-md-3 col-form-label text-right">
                        Kicking
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="kicking" name="kicking">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="{{ $paramsetting->kicking }}" step="0.1"  match="kicking" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="one_on_ones" class="col-md-3 col-form-label text-right">
                        One On Ones
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="one_on_ones" name="one_on_ones">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="{{ $paramsetting->one_on_ones }}" step="0.1"  match="one_on_ones" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="feet_playing" class="col-md-3 col-form-label text-right">
                        Feet playing
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="feet_playing" name="feet_playing">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="{{ $paramsetting->feet_playing }}" step="0.1"  match="feet_playing" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="free_kick" class="col-md-3 col-form-label text-right">
                        Free Kick Taking
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="free_kick" name="free_kick">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="{{ $paramsetting->free_kick }}" step="0.1"  match="free_kick" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="heading" class="col-md-3 col-form-label text-right">
                        Heading
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="heading" name="heading">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="{{ $paramsetting->heading }}" step="0.1"  match="heading" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="shots" class="col-md-3 col-form-label text-right">
                        Shots
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="shots" name="shots">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="{{ $paramsetting->shots }}" step="0.1"  match="shots" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="long_shots" class="col-md-3 col-form-label text-right">
                        Long Shots
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="long_shots" name="long_shots">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="{{ $paramsetting->long_shots }}" step="0.1"  match="long_shots" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="long_throws" class="col-md-3 col-form-label text-right">
                        Long Throws
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="long_throws" name="long_throws">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="{{ $paramsetting->long_throws }}" step="0.1"  match="long_throws" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="marking" class="col-md-3 col-form-label text-right">
                        Marking
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="marking" name="marking">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="{{ $paramsetting->marking }}" step="0.1"  match="marking" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="passing" class="col-md-3 col-form-label text-right">
                        Passing
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="passing" name="passing">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="{{ $paramsetting->passing }}" step="0.1"  match="passing" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="punching" class="col-md-3 col-form-label text-right">
                        Punching
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="punching" name="punching">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="{{ $paramsetting->punching }}" step="0.1"  match="punching" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="reflexes" class="col-md-3 col-form-label text-right">
                        Reflexes
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="reflexes" name="reflexes">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="{{ $paramsetting->reflexes }}" step="0.1"  match="reflexes" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="rushing_out" class="col-md-3 col-form-label text-right">
                        Rushing Out
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="rushing_out" name="rushing_out">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="{{ $paramsetting->rushing_out }}" step="0.1"  match="rushing_out" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="throwing" class="col-md-3 col-form-label text-right">
                        Throwing
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="throwing" name="throwing">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="{{ $paramsetting->throwing }}" step="0.1"  match="throwing" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="penalty_taking" class="col-md-3 col-form-label text-right">
                        Penalty Taking
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="penalty_taking" name="penalty_taking">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="{{ $paramsetting->penalty_taking }}" step="0.1"  match="penalty_taking" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="tackling" class="col-md-3 col-form-label text-right">
                        Tackling
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="tackling" name="tackling">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="{{ $paramsetting->tackling }}" step="0.1"  match="tackling" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="technique" class="col-md-3 col-form-label text-right">
                        Technique
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="technique" name="technique">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="{{ $paramsetting->technique }}" step="0.1"  match="technique" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="offensive" class="col-md-3 col-form-label text-right">
                        1 VS 1 Offensive
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="offensive" name="offensive">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="{{ $paramsetting->offensive }}" step="0.1"  match="offensive" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="deffense" class="col-md-3 col-form-label text-right">
                        1 VS 1 Deffense
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="deffense" name="deffense">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="{{ $paramsetting->deffense }}" step="0.1"  match="deffense" data-rangeslider>
                    </div>
                </div>
            </div>

            <div class="card-title font-15 font-weight-bold">
                Mental
            </div>
            <div class="row">
                <div class="form-group col-md-6 row">
                    <label for="aggression" class="col-md-3 col-form-label text-right">
                        Aggression
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="aggression" name="aggression">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="{{ $paramsetting->aggression }}" step="0.1" match="aggression" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="articipation" class="col-md-3 col-form-label text-right">
                        Anticipation
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="articipation" name="articipation">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="{{ $paramsetting->articipation }}" step="0.1"  match="articipation" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="bravery" class="col-md-3 col-form-label text-right">
                        Bravery
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="bravery" name="bravery">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="{{ $paramsetting->bravery }}" step="0.1"  match="bravery" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="composure" class="col-md-3 col-form-label text-right">
                        Composure
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="composure" name="composure">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="{{ $paramsetting->composure }}" step="0.1"  match="composure" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="concentration" class="col-md-3 col-form-label text-right">
                        Concentration
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="concentration" name="concentration">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="{{ $paramsetting->concentration }}" step="0.1"  match="concentration" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="decisions" class="col-md-3 col-form-label text-right">
                        Decisions
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="decisions" name="decisions">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="{{ $paramsetting->decisions }}" step="0.1"  match="decisions" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="determination" class="col-md-3 col-form-label text-right">
                        Determination
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="determination" name="determination">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="{{ $paramsetting->determination }}" step="0.1"  match="determination" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="flair" class="col-md-3 col-form-label text-right">
                        Flair
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="flair" name="flair">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="{{ $paramsetting->flair }}" step="0.1"  match="flair" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="leadership" class="col-md-3 col-form-label text-right">
                        Leadership
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="leadership" name="leadership">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="{{ $paramsetting->leadership }}" step="0.1"  match="leadership" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="off_ball" class="col-md-3 col-form-label text-right">
                        Off The Ball
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="off_ball" name="off_ball">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="{{ $paramsetting->off_ball }}" step="0.1"  match="off_ball" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="positioning" class="col-md-3 col-form-label text-right">
                        Positioning
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="positioning" name="positioning">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="{{ $paramsetting->positioning }}" step="0.1"  match="positioning" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="teamwork" class="col-md-3 col-form-label text-right">
                        Teamwork
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="teamwork" name="teamwork">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="{{ $paramsetting->teamwork }}" step="0.1"  match="teamwork" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="vision" class="col-md-3 col-form-label text-right">
                        Vision
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="vision" name="vision">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="{{ $paramsetting->vision }}" step="0.1"  match="vision" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="work_rate" class="col-md-3 col-form-label text-right">
                        Work Rate
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="work_rate" name="work_rate">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="{{ $paramsetting->work_rate }}" step="0.1"  match="work_rate" data-rangeslider>
                    </div>
                </div>
            </div>
            <div class="card-title font-15 font-weight-bold">
                Physical
            </div>
            <div class="row">
                <div class="form-group col-md-6 row">
                    <label for="acceleration" class="col-md-3 col-form-label text-right">
                        Acceleration
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="acceleration" name="acceleration">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="{{ $paramsetting->acceleration }}" step="0.1" match="acceleration" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="aerial_duels" class="col-md-3 col-form-label text-right">
                        Aerial Duels
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="aerial_duels" name="aerial_duels">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="{{ $paramsetting->aerial_duels }}" step="0.1" match="aerial_duels" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="agility" class="col-md-3 col-form-label text-right">
                        Agility
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="agility" name="agility">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="{{ $paramsetting->agility }}" step="0.1"  match="agility" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="balance" class="col-md-3 col-form-label text-right">
                        Balance
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="balance" name="balance">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="{{ $paramsetting->balance }}" step="0.1"  match="balance" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="jumping_reach" class="col-md-3 col-form-label text-right">
                        Jumping Reach
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="jumping_reach" name="jumping_reach">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="{{ $paramsetting->jumping_reach }}" step="0.1"  match="jumping_reach" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="natural_fitness" class="col-md-3 col-form-label text-right">
                        Natural Fitness
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="natural_fitness" name="natural_fitness">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="{{ $paramsetting->natural_fitness }}" step="0.1"  match="natural_fitness" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="pace" class="col-md-3 col-form-label text-right">
                        Pace
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="pace" name="pace">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="{{ $paramsetting->pace }}" step="0.1"  match="pace" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="reaction" class="col-md-3 col-form-label text-right">
                        Reaction
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="reaction" name="reaction">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="{{ $paramsetting->reaction }}" step="0.1"  match="reaction" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="sprint_speed" class="col-md-3 col-form-label text-right">
                        Sprint Speed
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="sprint_speed" name="sprint_speed">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="{{ $paramsetting->sprint_speed }}" step="0.1"  match="sprint_speed" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="stamina" class="col-md-3 col-form-label text-right">
                        Stamina
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="stamina" name="stamina">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="{{ $paramsetting->stamina }}" step="0.1"  match="stamina" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="strength" class="col-md-3 col-form-label text-right">
                        Strength
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="strength" name="strength">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="{{ $paramsetting->strength }}" step="0.1"  match="strength" data-rangeslider>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end card-box-->
</form>
<div class="row">
    <div class="col-md-6 offset-3">
        <button type="button" onclick="submitForm()" class="btn btn-block btn-danger waves-effect waves-light">Save</button>
    </div>
</div>

@endsection
@section('scripts')
@parent
    <script src="{{ asset('user_assets/libs/dropzone/dropzone.min.js') }}"></script>
    <script src="{{ asset('user_assets/libs/dropify/dropify.min.js') }}"></script>
    <script src="{{ asset('user_assets/libs/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('erp_assets/rangeslider-2.3.0/rangeslider.js') }}"></script>

    <script src="{{ asset('erp_assets/select/js/select2.js') }}"></script>
    <script>
        let curCounter = 1;
        let arrDefender = ["Centre-back", "Sweeper", "Left Full-back", "Right Full-back", "Left Wing-back", "Right Wing-back", "Left Centre-back", "Right Centre-back"];
        let arrMidfielder = ["Centre midfield", "Defensive midfield", "Attacking midfield", "Left Wide midfield", "Right Wide midfield"
            , "Left Defensive midfield", "Right Defensive midfield", "Left Centre midfield", "Right Centre midfield"
            , "Left Attacking midfield", "Right Attacking midfield"];
        let arrForward = ["Centre forward", "Second striker", "Left Winger", "Right Winger", "Left striker", "Right striker"
            , "Left Centre forward", "Right Centre forward"];
        let arrGoalkeeper = ["Goalkeeper"];

        let arrDefenderPos = ["Centre-back", "Sweeper", "Left Full-back", "Right Full-back", "Left Wing-back", "Right Wing-back"
            , "Defensive midfield", "Centre midfield", "Left Wide midfield", "Right Wide midfield"
            , "Left Centre-back", "Right Centre-back", "Left Defensive midfield", "Right Defensive midfield"
            , "Left Centre midfield", "Right Centre midfield"];
        let arrAttackingPos = ["Attacking midfield", "Left Attacking midfield", "Right Attacking midfield", "Left Winger", "Right Winger"
            , "Second striker", "Left striker", "Right striker", "Centre forward", "Left Centre forward", "Right Centre forward"];
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
        function formatRepo (repo) {
            if (repo.loading) {
                return repo.text;
            }

            var $container = $(
                "<p class='title mb-0'></p>"
            ).text(repo.name);

            return $container;
        }

        function formatRepoSelection (repo) {
            return repo.name;
        }
        $(document).ready(function(){
            $_token = @php echo $_token; @endphp;
            $('#cur_team').select2({
                ajax: {
                    type: "POST",
                    beforeSend: function(request) {
                        request.setRequestHeader("x-auth-token", $_token.user.token);
                    },
                    url: "https://api-football.instatscout.com/data",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        let result = {"proc":"tmp_euh_scout_get_players_teams_by_params","params":{"_ps_any_text":params.term,"_p_include_type":[2],"_p_get_short_names":1}}
                        return result;
                    },
                    processResults: function (data, params) {
                        let results = [];
                        let items = data.data[0].tmp_euh_scout_get_players_teams_by_params.teams;
                        console.log(items)
                        for (let i = 0; i < items.length; i++)
                        {
                            results.push({id: items[i].name_eng, name: items[i].name_eng});
                        }
                        params.page = params.page || 1;
                        return {
                            results: results
                        };
                    },
                    cache: true
                },
                placeholder: 'Search for a team',
                minimumInputLength: 3,
                templateResult: formatRepo,
                templateSelection: formatRepoSelection
            });
            var inputs = document.querySelectorAll( '.custom-file-input' );
            Array.prototype.forEach.call( inputs, function( input )
            {
                var labelVal = $( '.custom-file-label' ).text();
                input.addEventListener( 'change', function( e )
                {
                    var fileName = '';
                    if( this.files && this.files.length > 1 )
                        fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
                    else
                        fileName = e.target.value.split( '\\' ).pop();

                    if( fileName )
                        $( '.custom-file-label' ).text(fileName);
                    else
                        $( '.custom-file-label' ).text(labelVal);
                });
            });

            $(".dropify").dropify({
                messages: {
                    default: "Photo",
                    replace: "Drag and drop or click to replace",
                    remove: "Remove",
                    error: "Ooops, something wrong appended."
                },
                error: {
                    fileSize: "The file size is too big (1M max)."
                }
            });

            $("#birthdate").flatpickr();
            $('[data-rangeslider]').rangeslider({

                // Deactivate the feature detection
                polyfill: false,

                // Callback function
                onInit: function() {
                    $match = $(this.$element.get(0)).attr("match");
                    value = $(this.$element.get(0)).val();
                    $('#' + $match).val(value);
                },

                // Callback function
                onSlide: function(position, value) {
                    $match = $(this.$element.get(0)).attr("match");
                    $('#' + $match).val(value);
                },

                // Callback function
                onSlideEnd: function(position, value) {
                    console.log('onSlideEnd');
                    console.log('position: ' + position, 'value: ' + value);
                }
            });
            $("[attrtype=range_input]").change(function(){
                $match = $(this).attr("id");
                console.log($match);
                $("[match=" + $match + "]").val($(this).val()).change();
            })
            var settings = {
                "async": true,
                "crossDomain": true,
                "url": "https://ajayakv-rest-countries-v1.p.rapidapi.com/rest/v1/all",
                "method": "GET",
                "headers": {
                    "x-rapidapi-host": "ajayakv-rest-countries-v1.p.rapidapi.com",
                    "x-rapidapi-key": "596585807fmsh94116d249e0cd64p1d139cjsn6b7b5407af9b"
                }
            }
            for(var i = 100; i < 211; i++)
            {
                $('#height').append($("<option></option>").text(i + "cm").attr("value", i));
            }
            $('#height').select2({
                allowClear: false,
                dropdownAutoWidth: true,
                width: 'element',
                minimumResultsForSearch: 20, //prevent filter input
                maximumSelectionSize: 20 // prevent scrollbar
            });
            for(var i = 30; i < 101; i++)
            {
                $('#weight').append($("<option></option>").text(i + "kg").attr("value", i));
            }
            $('#weight').select2({
                allowClear: false,
                dropdownAutoWidth: true,
                width: 'element',
                minimumResultsForSearch: 20, //prevent filter input
                maximumSelectionSize: 20 // prevent scrollbar
            });
            $('#foot').select2({
                allowClear: false,
                dropdownAutoWidth: true,
                width: 'element',
                minimumResultsForSearch: 20, //prevent filter input
                maximumSelectionSize: 20 // prevent scrollbar
            });
            $.ajax(settings).done(function (response) {
                for(ind in response)
                {
                    $('#nationality').append($("<option></option>").text(response[ind].name).attr("value", response[ind].name));
                }
                $('#nationality').select2({
                    allowClear: false,
                    dropdownAutoWidth: true,
                    width: 'element',
                    minimumResultsForSearch: 20, //prevent filter input
                    maximumSelectionSize: 20 // prevent scrollbar
                });
            });
            $("#main_pos").select2({
                allowClear: false,
                dropdownAutoWidth: true,
                width: 'element',
                minimumResultsForSearch: 20, //prevent filter input
                maximumSelectionSize: 20 // prevent scrollbar
            });
            $("#position2").select2({
                allowClear: false,
                dropdownAutoWidth: true,
                width: 'element',
                minimumResultsForSearch: 20, //prevent filter input
                maximumSelectionSize: 20 // prevent scrollbar
            });
            $("#main_pos").change(function (e) {
                let main_pos = $( "#main_pos option:selected" ).text();
                $("#position2 option").remove();
                $('#position2').select2('val', null);
                if (main_pos == "Defender")
                {
                    for (let i = 0; i < arrDefender.length; i++)
                    {
                        $('#position2').append($("<option></option>").text(arrDefender[i]).attr("value", arrDefender[i]));
                    }
                } else if (main_pos == "Midfielder")
                {
                    for (let i = 0; i < arrMidfielder.length; i++)
                    {
                        $('#position2').append($("<option></option>").text(arrMidfielder[i]).attr("value", arrMidfielder[i]));
                    }
                } else if (main_pos == "Forward")
                {
                    for (let i = 0; i < arrForward.length; i++)
                    {
                        $('#position2').append($("<option></option>").text(arrForward[i]).attr("value", arrForward[i]));
                    }
                } else
                {
                    for (let i = 0; i < arrGoalkeeper.length; i++)
                    {
                        $('#position2').append($("<option></option>").text(arrGoalkeeper[i]).attr("value", arrGoalkeeper[i]));
                    }
                }
                $("#position2").change(function (e) {
                    changeAttributes();
                });
                $("#position2").trigger("change");
            });
            $("#main_pos").trigger("change");
        })
        function changeAttributes() {
            $spec_pos = $("#position2").val();
            $("[attrtype=range_input]").parent().parent().css("display", "none");

            if (arrDefenderPos.includes($spec_pos))
            {
                for (let i = 0; i < arrDefenderAttr.length; i++)
                {
                    $("#" + arrDefenderAttr[i]).parent().parent().css("display", "");
                }
            } else if (arrAttackingPos.includes($spec_pos))
            {
                for (let i = 0; i < arrAttackingAttr.length; i++)
                {
                    $("#" + arrAttackingAttr[i]).parent().parent().css("display", "");
                }
            } else if (arrGoalkeeperPos.includes($spec_pos))
            {
                for (let i = 0; i < arrGoalkeeperAttr.length; i++)
                {
                    $("#" + arrGoalkeeperAttr[i]).parent().parent().css("display", "");
                }
            }
            $("[identi=spec_position]").each(function () {
                $spec_pos = $(this).val();
                if (arrDefenderPos.includes($spec_pos))
                {
                    for (let i = 0; i < arrDefenderAttr.length; i++)
                    {
                        $("#" + arrDefenderAttr[i]).parent().parent().css("display", "");
                    }
                } else if (arrAttackingPos.includes($spec_pos))
                {
                    for (let i = 0; i < arrAttackingAttr.length; i++)
                    {
                        $("#" + arrAttackingAttr[i]).parent().parent().css("display", "");
                    }
                } else if (arrGoalkeeperPos.includes($spec_pos))
                {
                    for (let i = 0; i < arrGoalkeeperAttr.length; i++)
                    {
                        $("#" + arrGoalkeeperAttr[i]).parent().parent().css("display", "");
                    }
                }
            })
        }
        function deleteposition(count) {
            $("#main_position" + count).parent().parent().parent().remove();
            $("#spec_position" + count).parent().parent().parent().remove();
        }
        function addnewposition() {
            $element_main = '<div class="col-md-6">\n' +
                '                    <div class="form-group row">\n' +
                '                        <label for="position' + (curCounter + 1) + '" class="col-md-4 col-form-label text-right">\n' +
                '                            Other Position\n' +
                '                        </label>\n' +
                '                        <div class="col-md-7">\n' +
                '                            <select class="custom-select mr-sm-2" required id="main_position' + (curCounter + 1) + '" counter = "' + (curCounter + 1) + '" identi="main_position" name="main_position[]">\n' +
                '                                <option>Defender</option>\n' +
                '                                <option>Midfielder</option>\n' +
                '                                <option>Forward</option>\n' +
                '                                <option>Goalkeeper</option>\n' +
                '                            </select>\n' +
                '                        </div>\n' +
                '                    </div>\n' +
                '                </div>';
            $element_spec = '<div class="col-md-6">\n' +
                '                    <div class="form-group row">\n' +
                '                        <label for="position' + (curCounter + 1) + '" class="col-md-4 col-form-label text-right">\n' +
                '                            Specify Position\n' +
                '                        </label>\n' +
                '                        <div class="col-md-7">\n' +
                '                            <select class="custom-select mr-sm-2" required id="spec_position' + (curCounter + 1) + '" counter = "' + (curCounter + 1) + '" identi="spec_position" name="spec_position[]">\n' +
                '                            </select>\n' +
                '                        </div>\n' +
                '                        <div class="col-md-1" style="padding-top: 10px;">\n' +
                '                            <span style="cursor: pointer" onclick="deleteposition(' + (curCounter + 1) + ')">x</span>\n' +
                '                        </div>\n' +
                '                    </div>\n' +
                '                </div>';
            $(".position-panel").append($element_main);
            $(".position-panel").append($element_spec);
            $('#spec_position' + (curCounter + 1)).change(function (e) {
                changeAttributes();
            });
            $('#main_position' + (curCounter + 1)).change(function () {
                let $curCounter = $(this).attr("counter");
                let cur_main_pos = $('#main_position' + ($curCounter)).val();
                $('#spec_position' + ($curCounter) + ' option').remove();
                $('#spec_position' + ($curCounter)).select2('val', null);
                if (cur_main_pos == "Defender")
                {
                    for (let i = 0; i < arrDefender.length; i++)
                    {
                        $('#spec_position' + ($curCounter)).append($("<option></option>").text(arrDefender[i]).attr("value", arrDefender[i]));
                    }
                } else if (cur_main_pos == "Midfielder")
                {
                    for (let i = 0; i < arrMidfielder.length; i++)
                    {
                        $('#spec_position' + ($curCounter)).append($("<option></option>").text(arrMidfielder[i]).attr("value", arrMidfielder[i]));
                    }
                } else if (cur_main_pos == "Forward")
                {
                    for (let i = 0; i < arrForward.length; i++)
                    {
                        $('#spec_position' + ($curCounter)).append($("<option></option>").text(arrForward[i]).attr("value", arrForward[i]));
                    }
                } else
                {
                    for (let i = 0; i < arrGoalkeeper.length; i++)
                    {
                        $('#spec_position' + ($curCounter)).append($("<option></option>").text(arrGoalkeeper[i]).attr("value", arrGoalkeeper[i]));
                    }
                }
                $('#spec_position' + ($curCounter)).trigger('change');
            });
            $('#main_position' + (curCounter + 1)).select2({
                allowClear: false,
                dropdownAutoWidth: true,
                width: 'element',
                minimumResultsForSearch: 20, //prevent filter input
                maximumSelectionSize: 20 // prevent scrollbar
            });
            $('#spec_position' + (curCounter + 1)).select2({
                allowClear: false,
                dropdownAutoWidth: true,
                width: 'element',
                minimumResultsForSearch: 20, //prevent filter input
                maximumSelectionSize: 20 // prevent scrollbar
            });
            $('#main_position' + (curCounter + 1)).trigger("change");
            ++curCounter;
        }
        function submitForm() {
            if ($("#name").val() == "")
            {
                $.NotificationApp.send(
                    "Warning",
                    "You must enter name",
                    "top-right",
                    "#da8609",
                    "info");
                return;
            }
            if ($("#surname").val() == "")
            {
                $.NotificationApp.send(
                    "Warning",
                    "You must enter surname",
                    "top-right",
                    "#da8609",
                    "info");
                return;
            }
            if ($("#birthdate").val() == "")
            {
                $.NotificationApp.send(
                    "Warning",
                    "You must enter date of birth",
                    "top-right",
                    "#da8609",
                    "info");
                return;
            }
            if ($("#cur_team").val() == "" || $("#cur_team").val() == null)
            {
                $.NotificationApp.send(
                    "Warning",
                    "You must enter team",
                    "top-right",
                    "#da8609",
                    "info");
                return;
            }
            if ($("#main_pos").val() == "")
            {
                $.NotificationApp.send(
                    "Warning",
                    "You must enter main position",
                    "top-right",
                    "#da8609",
                    "info");
                return;
            }
            if ($("#position2").val() == "")
            {
                $.NotificationApp.send(
                    "Warning",
                    "You must secondary position",
                    "top-right",
                    "#da8609",
                    "info");
                return;
            }
            $("#add_player_form").submit();
        }
    </script>
@endsection