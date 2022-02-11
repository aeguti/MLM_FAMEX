@extends($activeTemplate.'layouts.auth')
@section('content')
@php
    $content = App\Models\Frontend::where('data_keys', 'sign_in.content')->first();
@endphp
<section class="account-section bg_img" data-background="{{getImage('assets/images/frontend/sign_in/' . @$content->data_values->background_image, '1920x390')}}">
    <div class="container">
        <div class="row account-row align-items-center justify-content-center">
            <div class="col-lg-6">
                <div class="account-form-area">
                    <div class="account-logo-area text-center">
                        <div class="account-logo">
                            <a href="{{url('/')}}">
                                <img src="{{getImage(imagePath()['logoIcon']['path'] .'/logo.png')}}"  alt="@lang('site-logo')">
                            </a>
                        </div>
                    </div>
                    <div class="account-header text-center">
                        <h4 class="title">@lang('Reset Password')</h4>
                    </div>
                    <form class="account-form" method="post" action="{{ route('user.password.update') }}">
                        @csrf
                        <input type="hidden" name="email" value="{{ $email }}">
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="form-group my-3">
                            <input type="Password" name="password" class="form--control"  placeholder="@lang('Password')">
                        </div>
                        <div class="form-group my-3">
                            <input type="Password" name="password_confirmation" class="form--control"  placeholder="@lang('Confirm Password')">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="submit-btn" value="@lang('Change Password')">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection
