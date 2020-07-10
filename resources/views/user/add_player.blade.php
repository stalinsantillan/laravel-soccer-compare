@extends('layouts.user')
@section('styles')
    <link href="{{ asset('user_assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('user_assets/libs/dropify/dropify.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('user_assets/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('erp_assets/rangeslider-2.3.0/rangeslider.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('erp_assets/select2/select2.css') }}" rel="stylesheet" type="text/css" />
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

        .custom-select
        {
            padding: 0 !important;
        }
        .select2-choice
        {
            padding-left: 17px !important;
            padding-top: 5px !important;
            height: 38px !important;
            color: #d2d9dc !important;
            border: 1px solid #3c4853 !important;
            background-image: linear-gradient(to top, #3c4853 0%, #3c4853 0%) !important;
        }
        .select2-arrow
        {
            padding-top: 5px !important;
            background-image: linear-gradient(to top, #3c4853 0%, #3c4853 0%) !important;
            border-left: none !important;
        }
        .select2-dropdown-open .select2-choice {
            color: #f3f4f4;
            border-bottom-color: #485561 !important;
            -webkit-box-shadow: 0 0px 0 #485561 inset;
            box-shadow: 0 0px 0 #485561 inset;
        }
        .select2-container.form-control
        {
            padding: 0 !important;
            border: none;
        }
        .select2-drop.select2-display-none.select2-with-searchbox.select2-drop-auto-width.select2-drop-active
        {
            width: 200px;
            z-index: 9999;
            max-height: 355px !important;
            overflow-y: auto;
            background: #485561;
            color: white;
        }
        .select2-drop.select2-display-none.select2-drop-auto-width.select2-drop-active
        {
            width: 200px;
            z-index: 9999;
            max-height: 355px !important;
            overflow-y: auto;
            background: #485561;
            color: white;
        }
        .select2-search
        {
            background: #485561 !important;
        }
        .select2-results .select2-no-results, .select2-results .select2-searching, .select2-results .select2-ajax-error, .select2-results .select2-selection-limit
        {
            background: #485561 !important;
        }
        .select2-drop-mask
        {
            /* z-index: -1 !important; */
        }
        .custom-select
        {
            width: 100% !important;
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
                    <li class="breadcrumb-item active">{{ trans('global.add') }}</li>
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
                                Surname
                            </label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" id="surname" name="surname">
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
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="cur_team" class="col-md-4 col-form-label text-right">
                            Current Team<span class="text-danger">*</span>
                        </label>
                        <div class="col-md-7">
                            <input type="text" required class="form-control" id="cur_team" name="cur_team">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="main_pos" class="col-md-4 col-form-label text-right">
                            Main Position<span class="text-danger">*</span>
                        </label>
                        <div class="col-md-7">
                            <select class="custom-select mr-sm-2" required id="main_pos" name="main_pos">
                                <option>Defender</option>
                                <option>Midfielder</option>
                                <option>Forward</option>
                                <option>Goalkeeper</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row position-panel">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="position2" class="col-md-4 col-form-label text-right">
                            Secondary Position
                        </label>
                        <div class="col-md-7">
                            <select class="custom-select mr-sm-2" required id="position2">
                            </select>
                            <a href="javascript:addnewposition()" class="text-white-50" style="line-height: 30px">Add new position</a>
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
                        Coreners
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="corners" name="corners">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="10" step="0.1" match="corners" data-rangeslider>
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
                        <input type="range" min="0" value="0" max="10" step="0.1"  match="crossing" data-rangeslider>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6 row">
                    <label for="dribbling" class="col-md-3 col-form-label text-right">
                        Dribbling
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="dribbling" name="dribbling">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="10" step="0.1"  match="dribbling" data-rangeslider>
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
                        <input type="range" min="0" value="0" max="10" step="0.1"  match="finishing" data-rangeslider>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6 row">
                    <label for="first_touch" class="col-md-3 col-form-label text-right">
                        First Touch
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="first_touch" name="first_touch">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="10" step="0.1"  match="first_touch" data-rangeslider>
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
                        <input type="range" min="0" value="0" max="10" step="0.1"  match="free_kick" data-rangeslider>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6 row">
                    <label for="heading" class="col-md-3 col-form-label text-right">
                        Heading
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="heading" name="heading">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="10" step="0.1"  match="heading" data-rangeslider>
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
                        <input type="range" min="0" value="0" max="10" step="0.1"  match="long_shots" data-rangeslider>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6 row">
                    <label for="long_throws" class="col-md-3 col-form-label text-right">
                        Long Throws
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="long_throws" name="long_throws">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="10" step="0.1"  match="long_throws" data-rangeslider>
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
                        <input type="range" min="0" value="0" max="10" step="0.1"  match="marking" data-rangeslider>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6 row">
                    <label for="passing" class="col-md-3 col-form-label text-right">
                        Passing
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="passing" name="passing">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="10" step="0.1"  match="passing" data-rangeslider>
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
                        <input type="range" min="0" value="0" max="10" step="0.1"  match="penalty_taking" data-rangeslider>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6 row">
                    <label for="tackling" class="col-md-3 col-form-label text-right">
                        Tackling
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="tackling" name="tackling">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="10" step="0.1"  match="tackling" data-rangeslider>
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
                        <input type="range" min="0" value="0" max="10" step="0.1"  match="technique" data-rangeslider>
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
                        <input type="range" min="0" value="0" max="10" step="0.1" match="aggression" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="articipation" class="col-md-3 col-form-label text-right">
                        Articipation
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="articipation" name="articipation">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="10" step="0.1"  match="articipation" data-rangeslider>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6 row">
                    <label for="bravery" class="col-md-3 col-form-label text-right">
                        Bravery
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="bravery" name="bravery">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="10" step="0.1"  match="bravery" data-rangeslider>
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
                        <input type="range" min="0" value="0" max="10" step="0.1"  match="composure" data-rangeslider>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6 row">
                    <label for="concentration" class="col-md-3 col-form-label text-right">
                        Concentration
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="concentration" name="concentration">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="10" step="0.1"  match="concentration" data-rangeslider>
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
                        <input type="range" min="0" value="0" max="10" step="0.1"  match="decisions" data-rangeslider>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6 row">
                    <label for="determination" class="col-md-3 col-form-label text-right">
                        Determination
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="determination" name="determination">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="10" step="0.1"  match="determination" data-rangeslider>
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
                        <input type="range" min="0" value="0" max="10" step="0.1"  match="flair" data-rangeslider>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6 row">
                    <label for="leadership" class="col-md-3 col-form-label text-right">
                        Leadership
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="leadership" name="leadership">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="10" step="0.1"  match="leadership" data-rangeslider>
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
                        <input type="range" min="0" value="0" max="10" step="0.1"  match="off_ball" data-rangeslider>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6 row">
                    <label for="positioning" class="col-md-3 col-form-label text-right">
                        Positioning
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="positioning" name="positioning">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="10" step="0.1"  match="positioning" data-rangeslider>
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
                        <input type="range" min="0" value="0" max="10" step="0.1"  match="teamwork" data-rangeslider>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6 row">
                    <label for="vision" class="col-md-3 col-form-label text-right">
                        Vision
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="vision" name="vision">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="10" step="0.1"  match="vision" data-rangeslider>
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
                        <input type="range" min="0" value="0" max="10" step="0.1"  match="work_rate" data-rangeslider>
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
                        <input type="range" min="0" value="0" max="10" step="0.1" match="acceleration" data-rangeslider>
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
                        <input type="range" min="0" value="0" max="10" step="0.1"  match="agility" data-rangeslider>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6 row">
                    <label for="balance" class="col-md-3 col-form-label text-right">
                        Balance
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="balance" name="balance">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="10" step="0.1"  match="balance" data-rangeslider>
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
                        <input type="range" min="0" value="0" max="10" step="0.1"  match="jumping_reach" data-rangeslider>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6 row">
                    <label for="natural_fitness" class="col-md-3 col-form-label text-right">
                        Natural Fitness
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="natural_fitness" name="natural_fitness">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="10" step="0.1"  match="natural_fitness" data-rangeslider>
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
                        <input type="range" min="0" value="0" max="10" step="0.1"  match="pace" data-rangeslider>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6 row">
                    <label for="stamina" class="col-md-3 col-form-label text-right">
                        Stamina
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="stamina" name="stamina">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="10" step="0.1"  match="stamina" data-rangeslider>
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
                        <input type="range" min="0" value="0" max="10" step="0.1"  match="strength" data-rangeslider>
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

    <script src="{{ asset('erp_assets/select2/select2.js') }}"></script>
    <script>
        let curCounter = 2;
        let arrDefender = ["Centre-back", "Sweeper", "Left Full-back", "Right Full-back", "Left Wing-back", "Right Wing-back"];
        let arrMidfielder = ["Centre midfield", "Defensive midfield", "Attacking midfield", "Left Wide midfield", "Right Wide midfield"];
        let arrForward = ["Centre forward", "Second striker", "Left Winger", "Right Winger"];
        $(document).ready(function(){
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
                $("[name=position]").each(function( index ) {
                    $(this).parent().parent().parent().remove();
                });
                curCounter = 2;
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
                }
                $("#position2").trigger("change");
            });
            $("#main_pos").trigger("change");
        })
        let arrCounterLabels = ['First', 'Secondary', 'Third', 'Fourth', 'Fifth', 'Sixth', 'Seventh', 'Eighth', 'Ninth', 'Tenth'];
        function addnewposition() {
            if (curCounter > 9) return;
            let selectedPosition = [];
            selectedPosition.push($("#position2").val());
            $("[name=position]").each(function( index ) {
                selectedPosition.push($( this ).val());
            });
            let main_pos = $( "#main_pos option:selected" ).text();
            if (main_pos == "Defender" && selectedPosition.length == arrDefender.length)
                return;
            else if (main_pos == "Midfielder" && selectedPosition.length == arrMidfielder.length)
                return;
            else if (main_pos == "Forward" && selectedPosition.length == arrForward.length)
                return;
            $element = '<div class="col-md-6">\n' +
                '                    <div class="form-group row">\n' +
                '                        <label for="position' + (curCounter + 1) + '" class="col-md-4 col-form-label text-right">\n' +
                '                            ' + arrCounterLabels[curCounter] + ' Position\n' +
                '                        </label>\n' +
                '                        <div class="col-md-7">\n' +
                '                            <select class="custom-select mr-sm-2" required id="position' + (curCounter + 1) + '" counter = "' + (curCounter + 1) + '" name="position">\n' +
                '                            </select>\n' +
                '                        </div>\n' +
                '                    </div>\n' +
                '                </div>';
            $(".position-panel").append($element);
            if (main_pos == "Defender")
            {
                for (let i = 0; i < arrDefender.length; i++)
                {
                    if (!selectedPosition.includes(arrDefender[i]))
                        $('#position' + (curCounter + 1)).append($("<option></option>").text(arrDefender[i]).attr("value", arrDefender[i]));
                }
            } else if (main_pos == "Midfielder")
            {
                for (let i = 0; i < arrMidfielder.length; i++)
                {
                    if (!selectedPosition.includes(arrDefender[i]))
                        $('#position' + (curCounter + 1)).append($("<option></option>").text(arrMidfielder[i]).attr("value", arrMidfielder[i]));
                }
            } else if (main_pos == "Forward")
            {
                for (let i = 0; i < arrForward.length; i++)
                {
                    if (!selectedPosition.includes(arrDefender[i]))
                        $('#position' + (curCounter + 1)).append($("<option></option>").text(arrForward[i]).attr("value", arrForward[i]));
                }
            }
            $('#position' + (curCounter + 1)).select2({
                allowClear: false,
                dropdownAutoWidth: true,
                width: 'element',
                minimumResultsForSearch: 20, //prevent filter input
                maximumSelectionSize: 20 // prevent scrollbar
            });
            $('#position' + (curCounter + 1)).trigger("change");
            ++curCounter;
            $('#position' + (curCounter)).change(function () {
                curCounter = $(this).attr("counter");
                $("[name=position]").each(function(index) {
                    $counter = $(this).attr("counter");
                    if (parseInt($counter) > curCounter)
                    {
                        $(this).parent().parent().parent().remove();
                    }
                });
            });
            $('#position2').change(function () {
                $("[name=position]").each(function(index) {
                    $counter = $(this).attr("counter");
                    $(this).parent().parent().parent().remove();
                    curCounter = 2;
                });
            });
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
            if ($("#cur_team").val() == "")
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