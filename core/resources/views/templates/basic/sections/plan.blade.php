@php
    $planTitle  = getContent('plan.content', true);
    $plans      = \App\Models\Plan::where('status', 1)->orderBy('price')->get();
@endphp

<section class="plan-section bg--gray ptb-80" id="plan">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 text-center">
                <div class="section-header">
                    <h3 class="sub-title">@lang(@$planTitle->data_values->subtitle)</h3>
                    <h2 class="section-title">@lang(@$planTitle->data_values->title)</h2>
                    <span class="title-border bg_img"
                          data-background="{{asset($activeTemplateTrue . 'frontend/images/icon-title.png')}}"></span>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mb-30-none">
            @foreach($plans  as $plan)

                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb-30">
                    <div class="plan-item">
                        <div class="plan-header section--bg text-center">
                            <h3 class="title text-white">{{__(@$plan->name)}}</h3>
                            <div class="plan-price">

                                <h3 class="price"><span>{{$general->cur_sym}}</span>{{getAmount($plan->price)}}</h3>
                            </div>
                        </div>
                        <div class="plan-body text-center">
                            <ul class="plan-list">
                                <li>
                                    @lang('Business Volume') (@lang('BV')) : <span class="amount">{{$plan->bv}}</span>
                                    <span class="icon" data-toggle="modal" data-target="#exampleModal"><i
                                            class="fas fa-question-circle"></i></span>
                                </li>
                                <li>
                                    @lang('Referral Commission') : <span
                                        class="amount">{{$general->cur_sym}} {{getAmount($plan->ref_com)}}</span>
                                    <span class="icon" data-toggle="modal" data-target="#exampleModal2"><i
                                            class="fas fa-question-circle"></i></span>
                                </li>
                                <li>
                                    @lang('Commission To Tree') : <span
                                        class="amount">{{$general->cur_sym}} {{getAmount($plan->tree_com)}}</span>

                                    <span class="icon" data-toggle="modal" data-target="#exampleModal3"><i
                                            class="fas fa-question-circle"></i></span>
                                </li>
                                <li>
                                    @lang('Daily Ad Limit') : <span class="amount">{{$plan->daily_ad_limit}}</span>
                                    <span class="icon" data-toggle="modal" data-target="#adInfoModal"><i
                                            class="fas fa-question-circle"></i></span>
                                </li>
                            </ul>
                            <div class="plan-btn text-center mt-30">
                                <a href="{{route('user.plan.index')}}"
                                   class="btn--base w-100">@lang('Subscribe Now')</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">@lang("Business Volume (BV) info")</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>
                    <span class="text-danger">@lang('When some of your descendants subscribed to this plan, You will get this Business Volume which will be used for matching bonus')
                    </span>
                </h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">@lang('Close')</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">@lang('Referral Commission info')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5><span class="text-danger">@lang('When Your Direct-Referred/Sponsored  User Subscribe in') <b> @lang('ANY PLAN') </b>, @lang('You will get this amount').</span>
                    <br>
                    <br>
                    <span class="text-success"> @lang('This is the reason You should Choose a Plan With Bigger Referral Commission').</span>
                </h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">@lang('Close')</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">@lang('Commission to tree info')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="text-danger">@lang('When someone from your below tree subscribe this plan, You will get this amount as Tree Commission.')</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">@lang('Close')</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="adInfoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">@lang('Commission to tree info')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class=" text-danger">@lang('How many ad you can view in a day')</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">@lang('Close')</button>
            </div>
        </div>
    </div>
</div>


@push('style')
    <style>
        span.icon{
            cursor: pointer;
        }
    </style>
@endpush


