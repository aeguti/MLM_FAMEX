@php
    $subscribe = getContent('subscribe.content', true);
@endphp



<section class="call-to-action-section bg_img ptb-80" data-background="{{ getImage('assets/images/frontend/subscribe/'.@$subscribe->data_values->background_image, '1920x390') }}">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 text-center">
                <div class="section-header">
                    <h2 class="title text-white">@lang(@$subscribe->data_values->title)</h2>
                </div>
            </div>
        </div>
        <div class="call-to-action-area">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-12 text-center">
                    <div class="call-to-action-content">
                        <form class="call-to-action-form" method="post" action="{{route('subscriber.store')}}">
                            @csrf
                            <div class="row justify-content-center align-items-center mb-20-none">
                                <div class="col-lg-5 mb-20">
                                    <input type="email" name="email" class="form-control" placeholder="@lang('Type your email')" required>
                                </div>
                                <div class="col-lg-2 mb-20">
                                    <button type="submit" class="submit-btn mt-0">@lang('Subscribe')</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    End Subscribe
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
