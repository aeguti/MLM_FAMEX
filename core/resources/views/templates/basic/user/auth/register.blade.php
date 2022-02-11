@extends($activeTemplate.'layouts.auth')

@section('content')

<section class="account-section ptb-80 bg_img" data-background="{{getImage('assets/images/frontend/sign_up/' . @$content->data_values->background_image, '1920x390')}}">
    <div class="container">
        <div class="row account-row align-items-center justify-content-center">
                <div class="col-lg-8">
                    <div class="account-form-area">
                        <div class="account-logo-area text-center">
                            <div class="account-logo">
                                <a href="{{url('/')}}">
                                    <img src="{{getImage(imagePath()['logoIcon']['path'] .'/logo.png')}}"  alt="@lang('site-logo')">
                                </a>
                            </div>
                        </div>
                        <div class="account-header text-center">
                            <h2 class="title">{{__(@$content->data_values->login_section_title)}}</h2>
                            <h3 class="sub-title">@lang('Already Have An Account?') <a href="{{route('user.login')}}">@lang('Login Now')</a></h3>
                        </div>

                        <form class="account-form" method="post" action="{{route('user.register')}}" onsubmit="return submitUserForm();">
                            @csrf
                            <div class="row ml-b-20">
                                @if ($ref_user == null)
                                    <div class="col-lg-6 form-group ">
                                        <label>@lang('Referrer')*</label>
                                        <input type="text" name="referral" class="form--control referral" value="{{old('referral')}}" id="ref_name" required>
                                        <div id="ref"></div>
                                        <span id="referral"></span>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label>@lang('Select Position')*</label>
                                        <select name="position" class="position form--control" id="position" required disabled>
                                            <option value="">@lang('Select One')</option>
                                            @foreach(mlmPositions() as $k=> $v)
                                                <option value="{{$k}}">@lang($v)</option>
                                            @endforeach
                                        </select>
                                        <span id="position-test"><span class="text-danger">@lang('Please enter referral username first')</span></span>
                                    </div>
                                @else
                                    <div class="form-group col-lg-6">
                                        <label>@lang('Referrer')*</label>
                                        <input type="text" name="referral" class="form--control referral" value="{{$ref_user->username}}" placeholder="@lang('Enter referral username')*" required readonly>
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label>@lang('Position')*</label>
                                        <select class="position form--control" id="position" required disabled>
                                            <option value="">@lang('Select position')*</option>
                                            @foreach(mlmPositions() as $k=> $v)
                                                <option @if($position == $k) selected
                                                        @endif value="{{$k}}">@lang($v)</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="position" value="{{$position}}">
                                        <p class="text-success">@php echo $joining; @endphp</p>
                                    </div>
                                @endif

                                <div class="form-group col-lg-6">
                                    <label>@lang('First Name')*</label>
                                    <input type="text" class="form--control" name="firstname" value="{{old('firstname')}}" autocomplete="off" required>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label>@lang('Last Name')*</label>
                                    <input type="text" class="form--control" name="lastname" value="{{old('lastname')}}" required>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label>@lang('Email')*</label>
                                    <input type="email" class="form--control" name="email" value="{{old('email')}}" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>@lang('Mobile')*</label>
                                    <div class="input-group mb-3 input-group-custom">
                                        <div class="input-group-prepend">
                                            <select name="country_code" class="input-group-text">
                                                @include('partials.country_code')
                                            </select>
                                        </div>
                                        <input type="text" class="form-control form--control" name="mobile" required>
                                    </div>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label>@lang('Country')</label>
                                    <input type="text" class="form--control" name="country" readonly/>
                                </div>


                                <div class="form-group col-lg-6">
                                    <label>@lang('Username')</label>
                                    <input type="text" class="form--control" name="username" value="{{old('username')}}" required>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label>@lang('Password')</label>
                                    <input type="password" class="form--control" name="password" id="myInputTwo" required>
                                    @if($general->secure_password)
                                        <p class="text-danger my-1 capital">@lang('At least 1 capital letter is required')</p>
                                        <p class="text-danger my-1 number">@lang('At least 1 number is required')</p>
                                        <p class="text-danger my-1 special">@lang('At least 1 special character is required')</p>
                                    @endif
                                </div>



                                <div class="form-group col-lg-6">
                                    <label>@lang('Confirm password')</label>
                                    <input type="password" class="form--control" name="password_confirmation" id="myInputTwo" required>
                                </div>

                                @php
                                    $captcha = getCustomCaptcha($height = 46, $width = '100%', $bgcolor = '#003');
                                @endphp

                                @if($captcha)
                                    <div class="form-group col-lg-12">
                                        <label>@lang('Enter The Code Below')</label>
                                        <input type="text" class="form--control" name="captcha" maxlength="6" placeholder="@lang('Enter Code')" required>
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

                                @php
                                    $links = getContent('user_links.element');
                                @endphp

                                @if($links->count() > 0)
                                <div class="col-lg-12 form-group">
                                    <div class="checkbox-wrapper d-flex flex-wrap align-items-center">
                                        <div class="checkbox-item">
                                            <input type="checkbox" id="c1" name="ticket-type" required>
                                            <label for="c1">@lang('I have read and agree to the')
                                                @foreach ($links as $item)
                                                <a href="{{route('links', slug($item->data_values->title).'-'.$item->id)}}">@php echo __($item->data_values->title) @endphp</a>@if(!$loop->last),@endif
                                                @endforeach
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                @endif

                                <div class="col-lg-12 form-group text-center">
                                    <input type="submit" class="submit-btn" id="recaptcha" value="Create an Account">
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
        "use strict";

        (function ($) {
            var not_select_msg = $('#position-test').html();

            $(document).on('keyup', '#ref_name', function () {
                var ref_id = $('#ref_name').val();
                var token = "{{csrf_token()}}";
                $.ajax({
                    type: "POST",
                    url: "{{route('check.referral')}}",
                    data: {
                        'ref_id': ref_id,
                        '_token': token
                    },
                    success: function (data) {
                        if (data.success) {
                            $('select[name=position]').removeAttr('disabled');
                            $('#position-test').text('');
                        } else {
                            $('select[name=position]').attr('disabled', true);
                            $('#position-test').html(not_select_msg);
                        }
                        $("#ref").html(data.msg);
                    }
                });
            });

            $(document).on('change', '#position', function () {
                updateHand();
            });

            function updateHand() {
                var pos = $('#position').val();
                var referrer_id = $('#referrer_id').val();
                var token = "{{csrf_token()}}";
                $.ajax({
                    type: "POST",
                    url: "{{route('get.user.position')}}",
                    data: {
                        'referrer': referrer_id,
                        'position': pos,
                        '_token': token
                    },
                    success: function (data) {
                        $("#position-test").html(data.msg);
                    }
                });
            }

        @if($country_code)
            $(`option[data-code={{ $country_code }}]`).attr('selected','');
        @endif


        var country = $('select[name=country_code] :selected').data('country');
        if(country){
            $('input[name=country]').val(country);
        }


        $('select[name=country_code]').change(function(){
            $('input[name=country]').val($('select[name=country_code] :selected').data('country'));
        });

        function submitUserForm() {
            var response = grecaptcha.getResponse();
            if (response.length == 0) {
                document.getElementById('g-recaptcha-error').innerHTML = '<span style="color:red;">@lang("Captcha field is required.")</span>';
                return false;
            }
            return true;
        }

        function verifyCaptcha() {
            document.getElementById('g-recaptcha-error').innerHTML = '';
        }
        @if($general->secure_password)
            $('input[name=password]').on('input',function(){
                var password = $(this).val();
                var capital = /[ABCDEFGHIJKLMNOPQRSTUVWXYZ]/;
                var capital = capital.test(password);
                if (!capital){
                    $('.capital').removeClass('d-none');
                }else{
                    $('.capital').addClass('d-none');
                }
                var number = /[123456790]/;
                var number = number.test(password);
                if (!number){
                    $('.number').removeClass('d-none');
                }else{
                    $('.number').addClass('d-none');
                }
                var special = /[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
                var special = special.test(password);
                if (!special){
                    $('.special').removeClass('d-none');
                }else{
                    $('.special').addClass('d-none');
                }

            });
        @endif

        })(jQuery);

    </script>



@endpush


