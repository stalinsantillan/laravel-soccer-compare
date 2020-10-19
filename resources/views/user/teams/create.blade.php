@extends('layouts.user')
@section('styles')
    <!-- third party css -->
    <link href="{{ asset('admin_assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('user_assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('user_assets/libs/dropify/dropify.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- third party css end -->
    <style>
        .btn-add-league i{
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
                    <li class="breadcrumb-item">
                        <a href="{{ route('user.teams.index') }}">
                            @lang(trans('cruds.team.title_singular'))
                        </a>
                    </li>
                    <li class="breadcrumb-item active">@lang(trans('global.create'))</li>
                </ol>
            </div>
            <h4 class="page-title">@lang(trans('global.create')) @lang(trans('cruds.team.title_singular'))</h4>
        </div>
    </div>
</div>
<!-- end page title -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route("user.teams.store") }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        {!! Form::label('name', trans('cruds.team.fields.title')."*", ['class' => 'col-md-12']) !!}
                        <div class="col-md-12">
                            {!! Form::text('name', old('name', isset($team) ?? $team->name), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                            @if($errors->has('name'))
                                <div class="mt-1" style="color: #e6334d; font-weight: 500;">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="logo" class="col-md-12">Logo</label>
                        <div class="col-md-7">
                            <input type="file" id="logo" name="logo" class="dropify" data-max-file-size="1M" accept="Image/*"/>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('league_id') ? 'has-error' : '' }}">
                        {!! Form::label('league_id', trans('cruds.league.title_singular'), ['class' => 'col-md-12']) !!}
                        <div class="col-md-12">
                            {!! Form::select('league_id', $leagues, old('league_id'), ['class' => 'form-control', 'data-toggle'=>'select2']) !!}
                            @if($errors->has('league_id'))
                                <div class="mt-1" style="color: #e6334d; font-weight: 500;">
                                    {{ $errors->first('league_id') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12 mb-2">
                        <button class="btn btn-info btn-add-league" type="button" onclick="showLeague()">@lang(trans('global.add')) @lang(trans('cruds.league.title_singular')) <i id="i-league" class="icon-plus"></i></button>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="text" class="form-control d-none" name="league" id="league">
                        </div>
                    </div>
                    <div class="col-md-12 text-right">
                        <input class="btn btn-danger" type="submit" value="@lang(trans('global.save'))">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    @parent
    <script src="{{ asset('user_assets/libs/select2/select2.min.js') }}"></script>
    <script src="{{ asset('user_assets/libs/dropify/dropify.min.js') }}"></script>
    <script>
        let addLeague = false;
        $(document).ready(function(){
            $('[data-toggle="select2"]').select2();
            $(".dropify").dropify({
                messages: {
                    default: "Logo",
                    replace: "Drag and drop or click to replace",
                    remove: "Remove",
                    error: "Ooops, something wrong appended."
                },
                error: {
                    fileSize: "The file size is too big (1M max)."
                }
            });
        });

        function showLeague() {
            addLeague = !addLeague;
            if(addLeague){
                $('#i-league').removeClass('icon-plus');
                $('#i-league').addClass('icon-arrow-up');
                $('#league').removeClass('d-none');
            }else{
                $('#i-league').removeClass('icon-arrow-up');
                $('#i-league').addClass('icon-plus');
                $('#league').addClass('d-none');
                $('#league').val('');
            }
        }
    </script>
@endsection