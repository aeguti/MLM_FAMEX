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
                        <h2 class="title">@lang('Verification Code')</h2>
                    </div>
                    <form class="account-form" method="post" action="{{ route('user.password.verify-code') }}">
                        @csrf
                        <input type="hidden" name="email" value="{{ $email }}">
                        <div class="form-group my-3">
                            <div id="phoneInput">
                                <div class="field-wrapper">
                                    <div class=" phone">
                                        <input type="text" name="code[]" class="letter"
                                                pattern="[0-9]*" inputmode="numeric" maxlength="1" required >
                                        <input type="text" name="code[]" class="letter"
                                                pattern="[0-9]*" inputmode="numeric" maxlength="1" required >
                                        <input type="text" name="code[]" class="letter"
                                                pattern="[0-9]*" inputmode="numeric" maxlength="1" required>
                                        <input type="text" name="code[]" class="letter"
                                                pattern="[0-9]*" inputmode="numeric" maxlength="1" required>
                                        <input type="text" name="code[]" class="letter"
                                                pattern="[0-9]*" inputmode="numeric" maxlength="1" required>
                                        <input type="text" name="code[]" class="letter"
                                                pattern="[0-9]*" inputmode="numeric" maxlength="1" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="submit-btn" value="{{ __('Submit') }}">
                        </div>

                        <p class="mt-2 text-white">@lang('Please check including your Junk/Spam Folder. if not found, you can')
                            <a class="text-danger" href="{{ route('user.password.request') }}">@lang('Try to send again')</a>
                        </p>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@include('partials.phoneInputScript')

