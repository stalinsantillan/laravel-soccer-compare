@extends('layouts.user')
@section('styles')
    <!-- third party css -->
    <link href="{{ asset('admin_assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- third party css end -->
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
                    <div class="col-md-12">
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
    <script>
        $(document).ready(function(){
            $('[data-toggle="select2"]').select2()
        });
    </script>
@endsection