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
                        <button type="button" class="mt-4 btn--success btn-round  btn-lg" id="btn-confirm" onClick="payWithRave()">@lang('Pay Now')</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection


@push('script')

    <script src="https://api.ravepay.co/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>

    <script>
        'use strict';
        var btn = document.querySelector("#btn-confirm");
        btn.setAttribute("type", "button");
        const API_publicKey = "{{$data->API_publicKey}}";

        function payWithRave() {
            var x = getpaidSetup({
                PBFPubKey: API_publicKey,
                customer_email: "{{$data->customer_email}}",
                amount: "{{$data->amount }}",
                customer_phone: "{{$data->customer_phone}}",
                currency: "{{$data->currency}}",
                txref: "{{$data->txref}}",
                onclose: function () {
                },
                callback: function (response) {
                    var txref = response.tx.txRef;
                    var status = response.tx.status;
                    var chargeResponse = response.tx.chargeResponseCode;
                    if (chargeResponse == "00" || chargeResponse == "0") {
                        window.location = '{{ url('ipn/flutterwave') }}/' + txref + '/' + status;
                    } else {
                        window.location = '{{ url('ipn/flutterwave') }}/' + txref + '/' + status;
                    }
                }
            });
        }
    </script>

@endpush
