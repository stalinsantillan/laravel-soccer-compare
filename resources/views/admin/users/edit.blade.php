@extends('layouts.admin')
@section('styles')
    <!-- third party css -->
    <link href="{{ asset('admin_assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_assets/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- third party css end -->
    <style>
        .select2-container{
            width: 100% !important;
        }
        .select2-selection--single{
            height: 32px !important;
            border-color: #ced4da !important;
        }
        .select2-selection__rendered{
            /*line-height: 32px !important;*/
        }
    </style>
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.users.index') }}">
                            {{ trans('cruds.user.title_singular') }}
                        </a>
                    </li>
                    <li class="breadcrumb-item active">{{ trans('global.edit') }}</li>
                </ol>
            </div>
            <h4 class="page-title">{{ trans('global.edit') }} {{ trans('cruds.user.title_singular') }}</h4>
        </div>
    </div>
</div>
<!-- end page title -->
<div class="card">
    <div class="card-body">
        <form action="{{ route("admin.users.update", [$user->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">{{ trans('cruds.user.fields.name') }}*</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($user) ? $user->name : '') }}" required>
                @if($errors->has('name'))
                    <div class="mt-1" style="color: #e6334d; font-weight: 500;">
                        {{ $errors->first('name') }}
                    </div>
                @endif
            </div>
            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                <label for="email">{{ trans('cruds.user.fields.email') }}*</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email', isset($user) ? $user->email : '') }}" required>
                @if($errors->has('email'))
                    <div class="mt-1" style="color: #e6334d; font-weight: 500;">
                        {{ $errors->first('email') }}
                    </div>
                @endif
            </div>
            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                <label for="password">{{ trans('cruds.user.fields.password') }}</label>
                <input type="password" id="password" name="password" class="form-control">
                @if($errors->has('password'))
                    <div class="mt-1" style="color: #e6334d; font-weight: 500;">
                        {{ $errors->first('password') }}
                    </div>
                @endif
            </div>
            <div class="form-group {{ $errors->has('roles') ? 'has-error' : '' }}">
                {!! Form::label('roles', trans('cruds.user.fields.roles')) !!}
                <div>
                    {!! Form::select('roles[]', $roles
                        , old('roles') ? old('roles') : $user->roles()->pluck('name', 'name')
                        , ['class' => 'form-control', 'data-toggle'=>'select2']) !!}
                </div>
                @if($errors->has('roles'))
                    <div class="mt-1" style="color: #e6334d; font-weight: 500;">
                        {{ $errors->first('roles') }}
                    </div>
                @endif
            </div>
            <div class="form-group {{ $errors->has('trial_start') ? 'has-error' : '' }}">
                <label for="trial_start">{{ trans('cruds.user.fields.trial_start') }}*</label>
                <input type="text" id="trial_start" name="trial_start" class="form-control" value="{{ old('trial_start', isset($user) ? $user->trial_start : '') }}" required>
                @if($errors->has('trial_start'))
                    <div class="mt-1" style="color: #e6334d; font-weight: 500;">
                        {{ $errors->first('trial_start') }}
                    </div>
                @endif
            </div>
            <div class="form-group {{ $errors->has('trial_end') ? 'has-error' : '' }}">
                <label for="trial_end">{{ trans('cruds.user.fields.trial_end') }}*</label>
                <input type="text" id="trial_end" name="trial_end" class="form-control" value="{{ old('trial_end', isset($user) ? $user->trial_end : '') }}" required>
                @if($errors->has('trial_end'))
                    <div class="mt-1" style="color: #e6334d; font-weight: 500;">
                        {{ $errors->first('trial_end') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                {!! Form::label('trial_type', trans('cruds.user.fields.trial_type')) !!}
                <div>
                    {!! Form::select('trial_type', $trial_types, old('trial_type') ? old('trial_type') : $user->trial_type, ['class' => 'form-control', 'data-toggle'=>'select2']) !!}
                </div>
                @if($errors->has('trial_type'))
                    <div class="mt-1" style="color: #e6334d; font-weight: 500;">
                        {{ $errors->first('trial_type') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                {!! Form::label('status', trans('cruds.user.fields.status')) !!}
                <div>
                    {!! Form::select('status', $status, old('status') ? old('status') : $user->status, ['class' => 'form-control', 'data-toggle'=>'select2']) !!}
                </div>
                @if($errors->has('status'))
                    <div class="mt-1" style="color: #e6334d; font-weight: 500;">
                        {{ $errors->first('status') }}
                    </div>
                @endif
            </div>
            <div class="form-group {{ $errors->has('limit_count') ? 'has-error' : '' }}">
                <label for="limit_count">{{ trans('cruds.user.fields.limit_count') }}*</label>
                <input type="text" id="limit_count" name="limit_count" class="form-control" value="{{ old('limit_count', isset($user) ? $user->limit_count : '5') }}" required>
                @if($errors->has('limit_count'))
                    <div class="mt-1" style="color: #e6334d; font-weight: 500;">
                        {{ $errors->first('limit_count') }}
                    </div>
                @endif
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>


    </div>
</div>
@endsection
@section('scripts')
@parent
    <script src="{{ asset('admin_assets/libs/select2/select2.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/pages/datatables.init.js') }}"></script>
    <script src="{{ asset('admin_assets/libs/flatpickr/flatpickr.min.js') }}"></script>

    <script>
        $(document).ready(function(){
            $('[data-toggle="select2"]').select2()
            $("#trial_start").flatpickr();
            $("#trial_end").flatpickr();
        });
    </script>
@endsection