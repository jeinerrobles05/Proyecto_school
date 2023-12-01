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
                <div class="breadcrumb-item">{{!empty($webinar) ?trans('/admin/main.edit'): trans('admin/main.new') }}</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12 ">
                    <div class="card">
                        <div class="card-body">

                            <form method="post" action="{{ getAdminPanelUrl() }}/courses/{{ !empty($webinar) ? $webinar->id.'update' : 'store' }}" id="courseForm" class="course-form">
                                {{ csrf_field() }}
                                <section>
                                    <h2 class="section-title after-line">{{ trans('public.basic_information') }}</h2>

                                    <div class="row">
                                        <div class="col-12 col-md-5">

                                            @if(!empty(getGeneralSettings('content_translate')))
                                                <div class="form-group">
                                                    <label class="input-label">{{ trans('auth.language') }}</label>
                                                    <select name="locale" class="form-control {{ !empty($webinar) ? 'js-edit-content-locale' : '' }}">
                                                        @foreach($userLanguages as $lang => $language)
                                                            <option value="{{ $lang }}" @if(mb_strtolower(request()->get('locale', app()->getLocale())) == mb_strtolower($lang)) selected @endif>{{ $language }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('locale')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            @else
                                                <input type="hidden" name="locale" value="{{ getDefaultLocale() }}">
                                            @endif


                                            <div class="form-group mt-15">
                                                <label class="input-label">{{ trans('Titulo') }}</label>
                                                <input type="text" name="title" value="{{ !empty($webinar) ? $webinar->title : old('title') }}" class="form-control @error('title')  is-invalid @enderror" placeholder=""/>
                                                @error('title')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>



                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group mt-15">
                                                        <label class="input-label">{{ trans('Description') }}</label>
                                                        <textarea id="summernote" name="description" class="form-control @error('description')  is-invalid @enderror" placeholder="{{ trans('Description') }}">{!! !empty($webinar) ? $webinar->description : old('description')  !!}</textarea>
                                                        @error('description')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>


                                                <div class="form-group mt-15 ">
                                                    <label class="input-label d-block">{{ trans('Estado') }}</label>

                                                    <select name="state" data-search-option="except_user" class="form-control search-user-select22"
                                                            data-placeholder="{{ trans('Estado') }}"
                                                    >
                                                            <option value='20' >{{trans('Habilitado')}}</option>
                                                            <option value='21' >{{trans('Deshabilitado')}}</option>
                                                    </select>
                                                </div>


                                        </div>
                                    </div>
                                    <button class="btn btn-success">Guardar</button>

                                </section>



                            </form>

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
