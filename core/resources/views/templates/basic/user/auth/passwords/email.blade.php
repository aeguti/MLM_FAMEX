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
                        <h2 class="title">@lang('Reset Password')</h2>
                    </div>

                    <form class="account-form" method="post" action="{{ route('user.password.email') }}">
                        @csrf
                        <div class="row ml-b-20">
                            <div class="form-group col-lg-12">
                                <select class="form--control" name="type">
                                    <option value="email">@lang('E-Mail Address')</option>
                                    <option value="username">@lang('Username')</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-12">
                                <input type="text" class="form--control @error('value') is-invalid @enderror" name="value" value="{{ old('value') }}" required autofocus="off" placeholder="@lang('Type Here...')">
                            </div>

                            <div class="col-lg-12 form-group text-center">
                                <input type="submit" class="submit-btn" value="@lang('Send Password Reset Code')">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

