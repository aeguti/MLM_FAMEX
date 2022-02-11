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
                            <button type="button" class="mt-4 btn--success btn-round  btn-lg" id="btn-confirm">@lang('Pay Now')</button>
                        </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script src="//voguepay.com/js/voguepay.js"></script>
    <script>
        'use strict';
        var closedFunction = function() {
        }
        var successFunction = function(transaction_id) {
            window.location.href = '{{ route('user.deposit') }}';
        }
        var failedFunction =function(transaction_id) {
            window.location.href = '{{ route('user.deposit') }}' ;
        }

        function pay(item, price) {
            //Initiate voguepay inline payment
            Voguepay.init({
                v_merchant_id: "{{ $data->v_merchant_id}}",
                total: price,
                notify_url: "{{ $data->notify_url }}",
                cur: "{{$data->cur}}",
                merchant_ref: "{{ $data->merchant_ref }}",
                memo:"{{$data->memo}}",
                recurrent: true,
                frequency: 10,
                developer_code: '5af93ca2913fd',
                store_id:"{{ $data->store_id }}",
                custom: "{{ $data->custom }}",

                closed:closedFunction,
                success:successFunction,
                failed:failedFunction
            });
        }

        (function($){
            $(document).on('click', '#btn-confirm', function (e) {
                e.preventDefault();
                pay('Buy', {{ $data->Buy }});
            });

        })(jQuery)

    </script>
@endpush
