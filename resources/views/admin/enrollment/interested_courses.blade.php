@extends('admin.layouts.app')

@push('libraries_top')

@endpush

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

            <section class="card">
                <div class="card-body">
                    <form method="get" class="mb-0">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="input-label">{{trans('admin/main.search')}}</label>
                                    <input name="full_name" type="text" class="form-control" value="{{ request()->get('full_name') }}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="input-label mb-4"> </label>
                                    <input type="submit" class="text-center btn btn-primary w-100" value="{{trans('admin/main.show_results')}}">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </section>

            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card">
                        <div class="card-header">

                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped font-14">
                                    <tr>
                                        <th>{{ trans('admin/main.id') }}</th>
                                        <th class="text-left">{{ trans('admin/main.name') }}</th>
                                        <th>{{ trans('admin/main.mobile') }}</th>
                                        <th>{{ trans('admin/main.email') }}</th>
                                        <th>{{ trans('admin/main.courses_interest') }}</th>
                                        <th>{{ trans('admin/main.register_date') }}</th>
                                        <th>{{ trans('admin/main.status') }}</th>
                                        <th>{{ trans('public.note') }}</th>
                                        <th>{{ trans('admin/main.actions') }}</th>
                                    </tr>

                                    @foreach($interestedClassroomCourse as $interested)
                                        <tr>
                                            <td>{{ $interested->id }}</td>
                                            <td class="text-center">{{ $interested->full_name }}</td>
                                            <td class="text-center">{{ $interested->mobile }}</td>
                                            <td class="text-center">{{ $interested->email }}</td>
                                            <td class="text-center">
                                                @foreach($interested->interestedCourseTranslation as $course)
                                                    <div><span class="badge badge-light">{{$course->title}}</span></div>
                                                @endforeach
                                            </td>
                                            <td>{{ dateTimeFormat($interested->created_at, 'j M Y') }}</td>
                                            <td class="text-center">
                                                <div class="mt-0 mb-1 font-weight-bold {{ ($interested->pending == 1) ? 'text-danger' : 'text-success' }}">
                                                    {{ ($interested->pending == 1) ? 'Sin llamar' : 'Llamado' }}
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                @can('admin_enrollment_history')
                                                    <div>
                                                        <form method="POST" action="{{ getAdminPanelUrl() }}/enrollments/{{ $interested->id }}/update-note" id="noteCreate">
                                                            {{ csrf_field() }}
                                                            <textarea name="note" rows="1" cols="30" style="border: none; background: none">{{$interested->note}}</textarea>
                                                            <button type="submit" id="saveNote" class="btn btn-link">{{trans('admin/main.save')}}</button>
                                                        </form>
                                                    </div>
                                                @endcan
                                            </td>
                                            <td class="text-center">
                                                @can('admin_enrollment_history')
                                                    <a href="{{ getAdminPanelUrl() }}/enrollments/{{ $interested->id }}/edit" title="{{ trans('admin/main.change_status') }}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                @endcan

                                                @can('admin_enrollment_history')
                                                    @include('admin.includes.delete_button',['url' => getAdminPanelUrl().'/enrollments/'.$interested->id.'/delete' , 'btnClass' => '', 'deleteConfirmMsg' => trans('update.interested_delete_confirm_msg')])
                                                @endcan
                                            </td>

                                        </tr>
                                    @endforeach
                                </table>

                            </div>
                        </div>

                        <div class="card-footer text-center">
                            {{ $interestedClassroomCourse->appends(request()->input())->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts_bottom')

@endpush

