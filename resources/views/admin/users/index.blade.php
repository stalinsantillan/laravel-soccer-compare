@extends('layouts.admin')
@section('styles')
    <!-- third party css -->
    <link href="{{ asset('admin_assets/libs/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_assets/libs/datatables/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_assets/libs/datatables/buttons.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_assets/libs/datatables/select.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <!-- third party css end -->
@endsection
@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">{{ trans('cruds.user.title_singular') }}</li>
                </ol>
            </div>
            <h4 class="page-title">{{ trans('cruds.user.title_singular') }}</h4>
        </div>
    </div>
</div>
<!-- end page title -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <a class="btn btn-success mb-3" href="{{ route('admin.users.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.user.title_singular') }}
                </a>
                <table id="basic-datatable" class="table dt-responsive nowrap">
                    <thead>
                        <tr>
                            <th>
                                {{ trans('cruds.user.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.user.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.user.fields.email') }}
                            </th>
                            <th>
                                {{ trans('cruds.user.fields.roles') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $key => $user)
                            <tr data-entry-id="{{ $user->id }}">
                                <td>
                                    {{ $user->id ?? '' }}
                                </td>
                                <td>
                                    {{ $user->name ?? '' }}
                                </td>
                                <td>
                                    {{ $user->email ?? '' }}
                                </td>
                                <td>
                                    @foreach($user->roles()->pluck('name') as $role)
                                        <span class="badge badge-info">{{ $role }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.users.edit', $user->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>

                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
    <!-- third party js -->
    <script src="{{ asset('admin_assets/libs/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('admin_assets/libs/datatables/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('admin_assets/libs/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin_assets/libs/datatables/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin_assets/libs/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('admin_assets/libs/datatables/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin_assets/libs/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('admin_assets/libs/datatables/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('admin_assets/libs/datatables/buttons.print.min.js') }}"></script>
    <script src="{{ asset('admin_assets/libs/datatables/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('admin_assets/libs/datatables/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('admin_assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('admin_assets/libs/pdfmake/vfs_fonts.js') }}"></script>
    <!-- third party js ends -->
    <!-- Datatables init -->
    <script src="{{ asset('admin_assets/js/pages/datatables.init.js') }}"></script>
@endsection