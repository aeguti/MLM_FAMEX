@extends($activeTemplate . 'user.layouts.app')

@section('panel')

    <div id="enableModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content blue-bg">
                <div class="modal-header">
                    <h4 class="modal-title text-dark">@lang('Verify Your OTP')</h4>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>

                </div>
                <form action="{{route('user.twofactor.enable')}}" method="POST">
                    @csrf
                    <div class="modal-body">

                        <div class="form-group">
                            <input type="hidden" name="key" value="{{$secret}}">
                            <input type="text" class="form-control" name="code" placeholder="@lang('Enter Google Authenticator Code')">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn--success pull-right">@lang('Submit')</button>
                    </div>

                </form>
            </div>

        </div>
    </div>

    <!--Disable Modal -->
    <div id="disableModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content blue-bg ">
                <div class="modal-header">
                    <h4 class="modal-title">@lang('Verify Your OTP to Disable')</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>
                <form action="{{route('user.twofactor.disable')}}" method="POST">
                    {{csrf_field()}}
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" name="code" placeholder="@lang('Enter Google Authenticator Code')">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn--success btn-block pull-left">@lang('Verify')</button>
                        <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                    </div>
                </form>
            </div>

        </div>
    </div>



    <div class="row design-order-process">
        <div class="col-lg-6 col-sm-12 mb-10">
            <div class="faq-contact">

                @if(Auth::user()->ts == '1')
                    <div class="card">
                        <div class="card-header">
                            <h4 class="panel-title text-center">@lang('Two Factor Authenticator')</h4>
                        </div>
                        <div class="card-body min-height-310 text-center">
                            <button type="button" class="btn btn-block btn-lg bttn btn-fill btn--danger" data-toggle="modal" data-target="#disableModal">@lang('Disable Two Factor Authenticator')</button>
                        </div>
                    </div>
                @else
                    <div class="card">
                        <div class="card-header">
                            <h4 class="panel-title text-center">@lang('Two Factor Authenticator')</h4>
                        </div>
                        <div class="card-body text-center">
                            <div class="input-group mb-3">
                                <input type="text" name="key" value="{{$secret}}" class="form-control" id="code" readonly>
                                <div class="input-group-append">
                                    <span class="input-group-text bg--success" id="copybtnpp">@lang('Copy')</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <img src="{{$qrCodeUrl}}">
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-block btn--primary" data-toggle="modal" data-target="#enableModal">@lang('Enable Two Factor Authenticator')</button>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div class="col-lg-6 col-sm-12">
            <div class="faq-contact">
                <div class="card">
                    <div class="card-header">
                        <h4 class="panel-title">@lang('Google Authenticator')</h4>
                    </div>
                    <div class="card-body text-justify min-height-310">
                        <h3 class="mb-2">@lang('Use Google Authenticator to Scan the QR code  or use the code')</h3>
                        <p class="font-20">{{__('Google Authenticator is a multi factor app for mobile devices. It generates timed codes used during the 2-step verification process. To use Google Authenticator, install the Google Authenticator application on your mobile device.')}}</p>
                    </div>

                    <div class="card-footer">
                        <a class="btn btn--primary btn-block" href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=en" target="_blank">@lang('DOWNLOAD APP')</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('script')
    <script>
        'use strict';
        document.getElementById("copybtnpp").onclick = function()
        {
            document.getElementById('code').select();
            document.execCommand('copy');
            notify('success', 'Copied successfully');
        }
    </script>
@endpush


@push('style')
    <style>
        .min-height-310 {
            min-height: 310px !important;
        }
    </style>
@endpush
