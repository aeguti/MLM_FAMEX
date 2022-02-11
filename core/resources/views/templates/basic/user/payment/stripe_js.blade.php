@extends($activeTemplate . 'user.layouts.app')
@push('style')
    <script src="https://js.stripe.com/v3/"></script>
    <style>
        .StripeElement {
            box-sizing: border-box;
            height: 40px;
            padding: 10px 12px;
            border: 1px solid transparent;
            border-radius: 4px;
            background-color: white;
            box-shadow: 0 1px 3px 0 #e6ebf1;
            -webkit-transition: box-shadow 150ms ease;
            transition: box-shadow 150ms ease;
        }

        .StripeElement--focus {
            box-shadow: 0 1px 3px 0 #cfd7df;
        }

        .StripeElement--invalid {
            border-color: #fa755a;
        }

        .StripeElement--webkit-autofill {
            background-color: #fefde5 !important;
        }

        .card button {
            padding-left: 0px !important;
        }
    </style>
@endpush

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

                        <script src="{{$data->src}}" class="stripe-button"
                            @foreach($data->val as $key=> $value)
                            data-{{$key}}="{{$value}}"
                            @endforeach>
                        </script>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
