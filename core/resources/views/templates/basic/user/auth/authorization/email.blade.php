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
                        <h5 class="title text-center">@lang('Please verify your email to get access')</h5>
                        <p class="text-center text-white">@lang('Your Email:') <strong>{{auth()->user()->email}}</strong></p>
                    </div>
                    <form class="account-form" method="post" action="{{route('user.verify_email')}}">
                        @csrf
                        <div class="form-group">
                            <div id="phoneInput">
                                <div class="phone">
                                    <input type="text" name="email_verified_code[]" class="letter"
                                            pattern="[0-9]*" inputmode="numeric" maxlength="1" required>
                                    <input type="text" name="email_verified_code[]" class="letter"
                                            pattern="[0-9]*" inputmode="numeric" maxlength="1" required>
                                    <input type="text" name="email_verified_code[]" class="letter"
                                            pattern="[0-9]*" inputmode="numeric" maxlength="1" required>
                                    <input type="text" name="email_verified_code[]" class="letter"
                                            pattern="[0-9]*" inputmode="numeric" maxlength="1" required>
                                    <input type="text" name="email_verified_code[]" class="letter"
                                            pattern="[0-9]*" inputmode="numeric" maxlength="1" required>
                                    <input type="text" name="email_verified_code[]" class="letter"
                                            pattern="[0-9]*" inputmode="numeric" maxlength="1" required>
                                </div>
                            </div>
                        </div>
                            <p class="mt-3 text-white">@lang('Please check including your Junk/Spam Folder. if not found, you can')
                                <a class="text-danger"
                                    href="{{route('user.send_verify_code')}}?type=email">@lang('Resend code')</a>
                            </p>
                        <div class="form-group">
                            <input type="submit" class="submit-btn" value="@lang('Submit')">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection


@include('partials.phoneInputScript')

