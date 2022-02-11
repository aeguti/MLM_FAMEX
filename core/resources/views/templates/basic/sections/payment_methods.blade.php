@php
    $content    = getContent('payment_methods.content',true);
    $elements   = App\Models\Gateway::orderBy('name')->with('currencies')->automatic()->get();
@endphp

<section class="brand-section bg--gray ptb-80">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 text-center">
                <div class="section-header">
                    <h3 class="sub-title">@lang(@$content->data_values->subtitle)</h3>
                    <h2 class="section-title">@lang(@$content->data_values->title)</h2>
                    <span class="title-border bg_img" data-background="{{asset($activeTemplateTrue . 'frontend/images/icon-title.png')}}"></span>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="brand-slider">
                    <div class="swiper-wrapper">
                        @foreach($elements as $gateway)
                        <div class="swiper-slide">
                            <div class="brand-item">
                                <img src="{{ getImage(imagePath()['gateway']['path'].'/'. $gateway->image,imagePath()['gateway']['size'])}}" alt="@lang('logo-image')">
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
