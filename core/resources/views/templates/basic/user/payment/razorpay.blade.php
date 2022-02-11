@extends($activeTemplate . 'user.layouts.app')
@section('panel')
    <div class="row mb-none-30 justify-content-center">
        <div class="col-xl-4 col-lg-4 col-md-6 mb-30">
            <div class="card border--primary">
                <div class="card-header">{{__($page_title)}}</div>
                <div class="card-body text-primary">
                    <div class="card-body text-center border-bottom">
                        <img src="{{$deposit->gateway_currency()->methodImage()}}" alt="@lang('profile-image')" class="user-image custom">
                        <h5 class="card-title mt-3">{{$deposit->gateway->name}}</h5>
                    </div>
                    <div class="card-body text-center">
                        <p class="clearfix">
                            <span class="float-left">@lang('Please Pay')</span>
                            <span class="float-right text-muted">{{getAmount($deposit->final_amo)}} {{$deposit->method_currency}}</span>
                        </p>
                        <hr>
                        <p class="clearfix">
                            <span class="float-left">@lang('To Get')</span>
                            <span class="float-right text-muted">{{getAmount($deposit->amount)}} {{$general->cur_text}}</span>
                        </p>
                        <form action="{{$data->url}}" method="{{$data->method}}">
                        <script src="{{$data->checkout_js}}"
                            @foreach($data->val as $key=>$value)
                                data-{{$key}}="{{$value}}"
                            @endforeach >
                        </script>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        "use strict";
        (function ($) {
            $('input[type="submit"]').addClass("ml-4 mt-4 btn-custom2 text-center btn-lg");
        })(jQuery);
    </script>
@endpush
