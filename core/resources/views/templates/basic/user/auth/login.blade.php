@extends($activeTemplate.'layouts.auth')

@section('content')

<section class="account-section bg_img" data-background="{{getImage('assets/images/frontend/sign_in/' . @$content->data_values->background_image, '1920x390')}}">
    <div class="container">
        <div class="row account-row align-items-center justify-content-center">
            <div class="col-lg-5">
                <div class="account-form-area">
                    <div class="account-logo-area text-center">
                        <div class="account-logo">
                            <a href="{{url('/')}}">
                                <img src="{{getImage(imagePath()['logoIcon']['path'] .'/logo.png')}}"  alt="@lang('site-logo')">
                            </a>
                        </div>
                    </div>

                    <div class="account-header text-center">
                        <h2 class="title">{{__(@$content->data_values->title)}}</h2>
                        <h3 class="sub-title">@lang('Don\'t Have An Account?') <a href="{{route('user.register')}}">@lang('Create An Account')</a></h3>
                    </div>

                    <form class="account-form" method="post" action="{{route('user.login')}}" onsubmit="return submitUserForm();">
                        @csrf
                        <div class="row ml-b-20">
                            <div class="form-group col-lg-12">
                                <label>@lang('Username')</label>
                                <input type="text" class="form--control" name="username" value="{{old('username')}}" required>
                            </div>

                            <div class="form-group col-lg-12">
                                <label>@lang('Password')</label>
                                <input type="password" class="form--control" id="myInputThree" name="password" required>
                            </div>

                            @php
                                $captcha = getCustomCaptcha($height = 46, $width = '100%', $bgcolor = '#003');
                            @endphp

                            @if($captcha)
                                <div class="form-group col-lg-12">
                                    <label>@lang('Enter The Code Below')</label>
                                    <input type="text" class="form--control" name="captcha" maxlength="6" required autocomplete="off" />
                                </div>
                                <div class="form-group col-lg-12">
                                    @php echo  $captcha @endphp
                                </div>
                            @endif

                            @if(reCaptcha())
                                <div class="form-group col-lg-12 ">
                                    @php echo reCaptcha(); @endphp
                                </div>
                            @endif

                            <div class="col-lg-12 form-group">
                                <div class="checkbox-wrapper d-flex flex-wrap align-items-center">
                                    <div class="checkbox-item">
                                        <label for="c1"><a href="#0"><a href="{{route('user.password.request')}}">@lang('Forgot Password?')</a></a></label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 form-group text-center">
                                <input class="submit-btn" type="submit" value="@lang('Login Account')">
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>

@endsection


@push('script')
    <script>
        'use strict';

        function submitUserForm() {
            var response = grecaptcha.getResponse();
            if (response.length == 0) {
                document.getElementById('g-recaptcha-error').innerHTML = '<span class="text-danger">@lang("Captcha field is required.")</span>';
                return false;
            }
            return true;
        }

        function verifyCaptcha() {
            document.getElementById('g-recaptcha-error').innerHTML = '';
        }
    </script>
@endpush
