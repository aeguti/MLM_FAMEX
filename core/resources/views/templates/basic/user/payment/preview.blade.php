@extends($activeTemplate . 'user.layouts.app')

@section('panel')
    <div class="container">
        <div class="row  justify-content-center">
            <div class="col-md-6">

                <div class="card card-deposit text-center p-3">
                    <div class="card-body card-body-deposit">
                        <ul class="list-group text-center ">
                            <li class="list-group-item justify-content-center " >
                                <img class="max-w-h-100px" src="{{ $data->gateway_currency()->methodImage() }}" />
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                @lang('Amount'):
                                <strong>{{getAmount($data->amount)}} {{$general->cur_text}} </strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                @lang('Charge'):
                                <strong>{{getAmount($data->charge)}} {{$general->cur_text}}</strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                @lang('Payable'):
                                <strong> {{getAmount($data->amount + $data->charge)}} {{$general->cur_text}}</strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                @lang('Conversion Rate'):
                                <strong>1 {{$general->cur_text}} = {{getAmount($data->rate)}}  {{$data->baseCurrency()}}</strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                @lang('In') {{$data->baseCurrency()}}:
                                <strong>{{getAmount($data->final_amo)}}</strong>
                            </li>
                            @if($data->gateway->crypto==1)
                                <li class="list-group-item d-flex justify-content-between">
                                    @lang('Conversion with')
                                    <b> {{ $data->method_currency }}</b> @lang('and final value will Show on next step')
                                </li>
                            @endif
                        </ul>

                        @if( 1000 >$data->method_code)
                            <a href="{{route('user.deposit.confirm')}}" class="btn btn-lg btn--success btn-block mt-3 font-weight-bold">@lang('Confirm Deposit')</a>
                        @else
                            <a href="{{route('user.deposit.manual.confirm')}}" class="btn btn-lg btn--success btn-block mt-3 font-weight-bold">@lang('Confirm Deposit')</a>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
@stop


