@extends('layouts.user')
@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="/">Soccer</a></li>
                    <li class="breadcrumb-item active">{{ trans('cruds.filter.title') }}</li>
                </ol>
            </div>
            <h4 class="page-title">{{ trans('cruds.filter.title') }}</h4>
        </div>
    </div>
</div>     
<!-- end page title -->
@endsection
