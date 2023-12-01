@extends('admin.layouts.app')

@push('styles_top')
    <link rel="stylesheet" href="/assets/default/vendors/sweetalert2/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="/assets/default/vendors/daterangepicker/daterangepicker.min.css">
    <link rel="stylesheet" href="/assets/default/vendors/bootstrap-timepicker/bootstrap-timepicker.min.css">
    <link rel="stylesheet" href="/assets/default/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="/assets/default/vendors/bootstrap-tagsinput/bootstrap-tagsinput.min.css">
    <link rel="stylesheet" href="/assets/vendors/summernote/summernote-bs4.min.css">
    <link href="/assets/default/vendors/sortable/jquery-ui.min.css"/>
    <style>
        .bootstrap-timepicker-widget table td input {
            width: 35px !important;
        }

        .select2-container {
            z-index: 1212 !important;
        }
    </style>
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{!empty($webinar) ?trans('/admin/main.edit'): trans('admin/main.new') }} {{ trans('admin/main.class') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ getAdminPanelUrl() }}">{{ trans('admin/main.dashboard') }}</a>
                </div>
                <div class="breadcrumb-item active">
                    <a href="{{ getAdminPanelUrl() }}/courses">{{ trans('admin/main.classes') }}</a>
                </div>
                <div class="breadcrumb-item">{{!empty($course) ?trans('/admin/main.edit'): trans('admin/main.new') }}</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12 ">
                    <div class="card">
                        <div class="card-body">


                            <div class="card-body">
                                <div>
                                    <table class="table table-striped font-14 ">
                                        <tr>
                                            <th class="text-left">{{trans('admin/main.title')}}</th>
                                            <th class="text-left">{{trans('Estado')}}</th>
                                            <th class="text-left">{{trans('Acciones')}}</th>
                                        </tr>

                                        @foreach($courses as $course)
                                            <tr class="text-center">
                                                <td>{{$course->title}}</td>
                                                <td>{{$course->state}}</td>
                                                <td class="font-12">
                                                    'b'
                                                </td>

                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts_bottom')


@endpush
