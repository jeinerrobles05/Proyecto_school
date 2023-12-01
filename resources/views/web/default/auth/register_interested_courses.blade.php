@extends(getTemplate().'.layouts.app')

@push('styles_top')
    <link rel="stylesheet" href="/assets/default/vendors/select2/select2.min.css">
@endpush

@section('content')
    @php
        $registerMethod = getGeneralSettings('register_method') ?? 'mobile';
        $showOtherRegisterMethod = getFeaturesSettings('show_other_register_method') ?? false;
        $showCertificateAdditionalInRegister = getFeaturesSettings('show_certificate_additional_in_register') ?? false;
        $selectRolesDuringRegistration = getFeaturesSettings('select_the_role_during_registration') ?? null;
    @endphp

    <div class="container">
        <div class="row login-container">
            <div class="col-12 col-md-6 pl-0">
                <img src="{{ getPageBackgroundSettings('register') }}" class="img-cover" alt="Login">
            </div>
            <div class="col-12 col-md-6">
                <div class="login-card">
                    <h1 class="font-20 font-weight-bold">{{ trans('auth.signup') }}</h1>

                    <form method="post" action="/register_classroom_course/store" class="mt-35">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="user_id" value="{{($user!=null)? $user->id:null}}">

                        <div class="form-group">
                            <label class="input-label" for="email">{{ trans('auth.email') }}:</label>
                            <input name="email" type="text" class="form-control @error('email') is-invalid @enderror"
                                   value="@if($user!=null){{$user->email}}@endif" id="email" aria-describedby="emailHelp">

                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-5">
                                <div class="form-group">
                                    <label class="input-label" for="mobile">{{ trans('auth.country') }}:</label>
                                    <select name="country_id" class="form-control select2">
                                        @foreach(getCountriesMobileCode() as $country => $code)
                                            <option value="{{ $code }}" @if($code == old('country_code')) selected @endif>{{ $country }}</option>
                                        @endforeach
                                    </select>

                                    @error('country_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-7">
                                <div class="form-group">
                                    <label class="input-label" for="mobile">{{ trans('auth.mobile') }} {{trans('public.optional')}}:</label>
                                    <input name="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror"
                                           value="@if($user!=null){{$user->mobile}}@endif" id="mobile" aria-describedby="mobileHelp">

                                    @error('mobile')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="input-label" for="full_name">{{ trans('auth.full_name') }}:</label>
                            <input name="full_name" type="text" value="@if($user!=null){{$user->full_name}}@endif" class="form-control @error('full_name') is-invalid @enderror">
                            @error('full_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="input-label" for="mobile">{{ trans('admin/main.courses_interest') }}:</label>
                            <select name="courses[]" class="form-control select2" multiple>
                                <option value="{{ $course->webinar_id }}" selected >{{ $course->title }}</option>
                                @foreach($courses as $cour)
                                    <option value="{{ $cour->id }}" >{{ $cour->title }}</option>
                                @endforeach
                            </select>

                            @error('courses')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="term" value="1" {{ (!empty(old('term')) and old('term') == '1') ? 'checked' : '' }} class="custom-control-input @error('term') is-invalid @enderror" id="term">
                            <label class="custom-control-label font-14" for="term">{{ trans('auth.i_agree_with') }}
                                <a href="pages/terms" target="_blank" class="text-secondary font-weight-bold font-14">{{ trans('auth.terms_and_rules') }}</a>
                            </label>

                            @error('term')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        @error('term')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror


                        <button type="submit" class="btn btn-primary btn-block mt-20">{{ trans('auth.send') }}</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts_bottom')
    <script src="/assets/default/vendors/select2/select2.min.js"></script>
@endpush
