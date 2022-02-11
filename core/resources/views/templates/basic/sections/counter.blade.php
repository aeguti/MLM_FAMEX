@php
$content   = getContent('counter.content', true);
$elements   = getContent('counter.element', false, null,true);
@endphp
@if($elements->count())
<section class="counter-section ptb-80 bg_img" data-background="{{ getImage('assets/images/frontend/counter/'.@$content->data_values->background_image, '1920x390') }}">
    <div class="container">
        <div class="row justify-content-center mb-30-none">
            @foreach ($elements as $element)
                <div class="col-lg-3 col-md-6 col-sm-6 mb-30">
                    <div class="counter-item text-center">
                        <div class="odo-area">
                            <h3 class="odo-title odometer" data-odometer-final="{{ @$element->data_values->counter_digit }}">0</h3><h3 class="odo-title">@lang(@$element->data_values->counter_digit_unit)</h3>
                        </div>
                        <span class="sub-title text--base">{{ __(@$element->data_values->title) }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif