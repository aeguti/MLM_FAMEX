@extends($activeTemplate . 'user.layouts.app')

@section('panel')
    <div class="row mb-none-30">
        @foreach($plans as $data)

            <div class="col-xl-4 col-md-6 mb-30">
                <div class="card">
                    <div class="card-body pt-5 pb-5 ">
                        <div class="pricing-table text-center mb-4">
                            <h2 class="package-name mb-20 text-"><strong>@lang($data->name)</strong></h2>
                            <span class="price text--dark font-weight-bold d-block">{{$general->cur_sym}}{{getAmount($data->price)}}</span>
                            <hr>
                            <ul class="package-features-list mt-30">
                                <li class="">
                                    <i class="fas fa-check bg--success"></i> <span>@lang('Business Volume (BV)'): {{getAmount($data->bv)}}</span>
                                    <span class="icon" data-toggle="modal" data-target="#bvInfoModal"><i
                                            class="fas fa-question-circle"></i></span></li>
                                <li>
                                    <i class="fas fa-check bg--success"></i> <span> @lang('Referral Commission'): {{$general->cur_sym}} {{getAmount($data->ref_com)}} </span>
                                    <span class="icon" data-toggle="modal" data-target="#refComInfoModal"><i
                                    class="fas fa-question-circle"></i></span>
                                </li>
                                <li>
                                    <i class="fas @if(getAmount($data->tree_com) != 0) fa-check bg--success @else fa-times bg--danger @endif "></i>  <span>@lang('Tree Commission'): {{$general->cur_sym}} {{getAmount($data->tree_com)}} </span>

                                     <span class="icon" data-toggle="modal" data-target="#treeComInfoModal"><i
                                    class="fas fa-question-circle"></i></span>
                                </li>
                                <li>
                                    <i class="fas fa-check bg--success"></i>
                                   <span>@lang('Daily Ad View Limit'): {{$data->daily_ad_limit}} </span>

                                   <span class="icon" data-toggle="modal" data-target="#adInfoModal"><i
                                    class="fas fa-question-circle"></i></span>
                                </li>
                            </ul>
                        </div>
                        @if(Auth::user()->plan_id != $data->id)
                            <a href="#confBuyModal{{$data->id}}" data-toggle="modal" class="btn w-100 btn-outline--primary  mt-20 py-2 box--shadow1">@lang('Subscribe')</a>
                        @else
                            <a data-toggle="modal" class="btn w-100 btn-outline--primary  mt-20 py-2 box--shadow1">@lang('Already Subscribe')</a>
                        @endif
                    </div>

                </div><!-- card end -->
            </div>


            <div class="modal fade" id="confBuyModal{{$data->id}}" tabindex="-1" role="dialog"
                 aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel"> @lang('Confirm Purchase '.$data->name)?</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                            <h5 class="text-danger text-center">{{getAmount($data->price)}} {{$general->cur_text}} @lang('will subtract from your balance')</h5>
                        </div>
                        <form method="post" action="{{route('user.plan.purchase')}}">
                            @csrf
                            <div class="modal-footer">
                                <button type="button" class="btn btn--danger" data-dismiss="modal"><i
                                        class="fa fa-times"></i> @lang('Close')</button>

                                <button type="submit" name="plan_id" value="{{$data->id}}" class="btn btn--success"><i
                                        class="lab la-telegram-plane"></i> @lang('Subscribe')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="modal fade" id="bvInfoModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang("Business Volume (BV) info")</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="@lang('Close')">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 class="text-danger">@lang('When someone from your below tree subscribe this plan, You will get this Business Volume  which will be used for matching bonus').
                    </h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="refComInfoModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Referral Commission info')</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5><span
                            class=" text-danger">@lang('When your referred user subscribe in') <b> @lang('ANY PLAN')</b>, @lang('you will get this amount').</span>
                        <br>
                        <br>
                        <span class="text-success"> @lang('This is the reason you should choose a plan with bigger referral commission').</span>
                    </h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="treeComInfoModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Commission to tree info')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 class=" text-danger">@lang('When someone from your below tree subscribe this plan, You will get this amount as tree commission'). </h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="adInfoModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Daily Ad Limit Info')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 class=" text-danger">@lang('How many ad you can view in a day') </h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                </div>
            </div>
        </div>
    </div>
@endsection
