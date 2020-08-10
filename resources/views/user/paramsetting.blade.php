@extends('layouts.user')
@section('styles')
    <link href="{{ asset('erp_assets/rangeslider-2.3.0/rangeslider.css') }}" rel="stylesheet" type="text/css" />

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
                    <li class="breadcrumb-item active">{{ trans('cruds.paramsetting.title') }}</li>
                </ol>
            </div>
            <h4 class="page-title">{{ trans('cruds.paramsetting.title') }}</h4>
        </div>
    </div>
</div>
<!-- end page title -->
<form role="form" id="param_setting_form" method="post" action="{{ route('user.paramsetting_store') }}" enctype="multipart/form-data">
    @csrf
    <div class="card">
        <div class="card-header font-16">
            Attribute Max Value
        </div>
        <div class="card-body">
            <div class="card-title font-15 font-weight-bold">
                Technical
            </div>
            <div class="row">
                <div class="form-group col-md-6 row">
                    <label for="corners" class="col-md-3 col-form-label text-right">
                        Coreners
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="corners" name="corners">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="{{ $data->corners }}" max="100"step="0.1" match="corners" data-rangeslider>
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
                        <input type="range" min="0" value="{{ $data->crossing }}" max="100"step="0.1"  match="crossing" data-rangeslider>
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
                        <input type="range" min="0" value="{{ $data->dribbling }}" max="100"step="0.1"  match="dribbling" data-rangeslider>
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
                        <input type="range" min="0" value="{{ $data->finishing }}" max="100"step="0.1"  match="finishing" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="aerial_reach" class="col-md-3 col-form-label text-right">
                        Aerial Reach
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="aerial_reach" name="aerial_reach">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="{{ $data->aerial_reach }}" max="100"step="0.1"  match="aerial_reach" data-rangeslider>
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
                        <input type="range" min="0" value="{{ $data->command_of_area }}" max="100"step="0.1"  match="command_of_area" data-rangeslider>
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
                        <input type="range" min="0" value="{{ $data->communication }}" max="100"step="0.1"  match="communication" data-rangeslider>
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
                        <input type="range" min="0" value="{{ $data->eccentricity }}" max="100"step="0.1"  match="eccentricity" data-rangeslider>
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
                        <input type="range" min="0" value="{{ $data->first_touch }}" max="100"step="0.1"  match="first_touch" data-rangeslider>
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
                        <input type="range" min="0" value="{{ $data->handling }}" max="100"step="0.1"  match="handling" data-rangeslider>
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
                        <input type="range" min="0" value="{{ $data->kicking }}" max="100"step="0.1"  match="kicking" data-rangeslider>
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
                        <input type="range" min="0" value="{{ $data->one_on_ones }}" max="100"step="0.1"  match="one_on_ones" data-rangeslider>
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
                        <input type="range" min="0" value="{{ $data->feet_playing }}" max="100"step="0.1"  match="feet_playing" data-rangeslider>
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
                        <input type="range" min="0" value="{{ $data->free_kick }}" max="100"step="0.1"  match="free_kick" data-rangeslider>
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
                        <input type="range" min="0" value="{{ $data->heading }}" max="100"step="0.1"  match="heading" data-rangeslider>
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
                        <input type="range" min="0" value="{{ $data->shots }}" max="100"step="0.1"  match="shots" data-rangeslider>
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
                        <input type="range" min="0" value="{{ $data->long_shots }}" max="100"step="0.1"  match="long_shots" data-rangeslider>
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
                        <input type="range" min="0" value="{{ $data->long_throws }}" max="100"step="0.1"  match="long_throws" data-rangeslider>
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
                        <input type="range" min="0" value="{{ $data->marking }}" max="100"step="0.1"  match="marking" data-rangeslider>
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
                        <input type="range" min="0" value="{{ $data->passing }}" max="100"step="0.1"  match="passing" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="long_pass" class="col-md-3 col-form-label text-right">
                        Long Pass
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="long_pass" name="long_pass">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="{{ $data->long_pass }}" max="100"step="0.1"  match="long_pass" data-rangeslider>
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
                        <input type="range" min="0" value="{{ $data->punching }}" max="100"step="0.1"  match="punching" data-rangeslider>
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
                        <input type="range" min="0" value="{{ $data->reflexes }}" max="100"step="0.1"  match="reflexes" data-rangeslider>
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
                        <input type="range" min="0" value="{{ $data->rushing_out }}" max="100"step="0.1"  match="rushing_out" data-rangeslider>
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
                        <input type="range" min="0" value="{{ $data->throwing }}" max="100"step="0.1"  match="throwing" data-rangeslider>
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
                        <input type="range" min="0" value="{{ $data->penalty_taking }}" max="100"step="0.1"  match="penalty_taking" data-rangeslider>
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
                        <input type="range" min="0" value="{{ $data->tackling }}" max="100"step="0.1"  match="tackling" data-rangeslider>
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
                        <input type="range" min="0" value="{{ $data->technique }}" max="100"step="0.1"  match="technique" data-rangeslider>
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
                        <input type="range" min="0" value="{{ $data->offensive }}" max="100"step="0.1"  match="offensive" data-rangeslider>
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
                        <input type="range" min="0" value="{{ $data->deffense }}" max="100"step="0.1"  match="deffense" data-rangeslider>
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
                        <input type="range" min="0" value="{{ $data->aggression }}" max="100"step="0.1" match="aggression" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="anticipation" class="col-md-3 col-form-label text-right">
                        Anticipation
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="anticipation" name="anticipation">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="{{ $data->anticipation }}" max="100"step="0.1"  match="anticipation" data-rangeslider>
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
                        <input type="range" min="0" value="{{ $data->bravery }}" max="100"step="0.1"  match="bravery" data-rangeslider>
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
                        <input type="range" min="0" value="{{ $data->composure }}" max="100"step="0.1"  match="composure" data-rangeslider>
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
                        <input type="range" min="0" value="{{ $data->concentration }}" max="100"step="0.1"  match="concentration" data-rangeslider>
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
                        <input type="range" min="0" value="{{ $data->decisions }}" max="100"step="0.1"  match="decisions" data-rangeslider>
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
                        <input type="range" min="0" value="{{ $data->determination }}" max="100"step="0.1"  match="determination" data-rangeslider>
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
                        <input type="range" min="0" value="{{ $data->flair }}" max="100"step="0.1"  match="flair" data-rangeslider>
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
                        <input type="range" min="0" value="{{ $data->leadership }}" max="100"step="0.1"  match="leadership" data-rangeslider>
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
                        <input type="range" min="0" value="{{ $data->off_ball }}" max="100"step="0.1"  match="off_ball" data-rangeslider>
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
                        <input type="range" min="0" value="{{ $data->positioning }}" max="100"step="0.1"  match="positioning" data-rangeslider>
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
                        <input type="range" min="0" value="{{ $data->teamwork }}" max="100"step="0.1"  match="teamwork" data-rangeslider>
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
                        <input type="range" min="0" value="{{ $data->vision }}" max="100"step="0.1"  match="vision" data-rangeslider>
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
                        <input type="range" min="0" value="{{ $data->work_rate }}" max="100"step="0.1"  match="work_rate" data-rangeslider>
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
                        <input type="range" min="0" value="{{ $data->acceleration }}" max="100"step="0.1" match="acceleration" data-rangeslider>
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
                        <input type="range" min="0" value="{{ $data->aerial_duels }}" max="100"step="0.1" match="aerial_duels" data-rangeslider>
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
                        <input type="range" min="0" value="{{ $data->agility }}" max="100"step="0.1"  match="agility" data-rangeslider>
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
                        <input type="range" min="0" value="{{ $data->balance }}" max="100"step="0.1"  match="balance" data-rangeslider>
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
                        <input type="range" min="0" value="{{ $data->jumping_reach }}" max="100"step="0.1"  match="jumping_reach" data-rangeslider>
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
                        <input type="range" min="0" value="{{ $data->natural_fitness }}" max="100"step="0.1"  match="natural_fitness" data-rangeslider>
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
                        <input type="range" min="0" value="{{ $data->pace }}" max="100"step="0.1"  match="pace" data-rangeslider>
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
                        <input type="range" min="0" value="{{ $data->reaction }}" max="100"step="0.1"  match="reaction" data-rangeslider>
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
                        <input type="range" min="0" value="{{ $data->sprint_speed }}" max="100"step="0.1"  match="sprint_speed" data-rangeslider>
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
                        <input type="range" min="0" value="{{ $data->stamina }}" max="100"step="0.1"  match="stamina" data-rangeslider>
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
                        <input type="range" min="0" value="{{ $data->strength }}" max="100"step="0.1"  match="strength" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="injury_resistance" class="col-md-3 col-form-label text-right">
                        Injury resistance
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="injury_resistance" name="injury_resistance">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="{{ $data->injury_resistance }}" max="100"step="0.1"  match="injury_resistance" data-rangeslider>
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
    <script src="{{ asset('erp_assets/rangeslider-2.3.0/rangeslider.js') }}"></script>
    <script>
        $(document).ready(function(){
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
        })
        function submitForm() {
            $("#param_setting_form").submit();
        }
    </script>
@endsection