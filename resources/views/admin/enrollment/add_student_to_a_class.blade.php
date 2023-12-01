@extends('admin.layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ $pageTitle }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ getAdminPanelUrl() }}">{{trans('admin/main.dashboard')}}</a>
                </div>
                <div class="breadcrumb-item">{{ $pageTitle }}</div>
            </div>
        </div>

        <div class="section-body">


            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card">

                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <form action="{{ getAdminPanelUrl() }}/enrollments/store" method="Post">
                                        {{ csrf_field() }}

                                      {{--  <div class="form-group">
                                            <label class="input-label">{{trans('admin/main.class')}}</label>
                                            <select name="webinar_id" class="form-control search-webinar-select2"
                                                    data-placeholder="Search classes">

                                            </select>

                                            @error('webinar_id')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        --}}
                                        <div class="form-group mt-3">
                                            <label class="input-label">Webinar</label>
                                            <select name="webinar_id" class="search-webinar-select2 custom-select">
                                                <option selected disabled> Seleccione un webinar</option>
                                            </select>
                                            <div class="invalid-feedback"></div>
                                        </div>

                                        <div class="form-group mt-3">
                                            <label class="input-label">Grupo</label>
                                            <select name="group_id" class="js-ajax-course_group_id custom-select">
                                                <option {{ 'selected disabled' }} > Seleccione un grupo</option>

                                            </select>
                                            <div class="invalid-feedback"></div>
                                        </div>

                                        <div class="form-group">
                                            <label class="input-label d-block">{{ trans('admin/main.user') }}</label>
                                            <select name="user_id" class="form-control search-user-select2" data-placeholder="{{ trans('public.search_user') }}">

                                            </select>
                                            @error('user_id')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class=" mt-4">
                                            <button type="submit" class="btn btn-primary">{{ trans('admin/main.add') }}</button>
                                        </div>
                                    </form>
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

    <script src="/assets/default/vendors/sortable/jquery-ui.min.js"></script>
    <script src="/assets/default/js/panel/public.min.js"></script>
@endpush

