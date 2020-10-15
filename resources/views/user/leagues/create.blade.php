@extends('layouts.user')
@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('user.leagues.index') }}">
                            @lang(trans('cruds.league.title_singular'))
                        </a>
                    </li>
                    <li class="breadcrumb-item active">@lang(trans('global.create'))</li>
                </ol>
            </div>
            <h4 class="page-title">@lang(trans('global.create')) @lang(trans('cruds.league.title_singular'))</h4>
        </div>
    </div>
</div>
<!-- end page title -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route("user.leagues.store") }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
{{--                        {!! Form::label('name', trans('cruds.league.fields.title')."*", ['class' => 'col-md-12']) !!}--}}
                        <label for="name" class="col-md-12">@lang('Title')*</label>
                        <div class="col-md-12">
                            {!! Form::text('name', old('name', isset($league) ?? $league->name), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                            @if($errors->has('name'))
                                <div class="mt-1" style="color: #e6334d; font-weight: 500;">
                                    {{ $errors->first('name') }}
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