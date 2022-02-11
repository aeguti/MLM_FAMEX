
@php
    $testimonialCaption = getContent('testimonial.content',true);
    $testimonials = getContent('testimonial.element');
@endphp

<section class="client-section bg--gray ptb-80 bg_img" data-background="{{ getImage('assets/images/frontend/testimonial/'.@$testimonialCaption->data_values->background_image, '1920x820') }}">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 text-center">
                <div class="section-header">
                    <h3 class="sub-title">@lang(@$testimonialCaption->data_values->subtitle)</h3>
                    <h2 class="section-title">@lang(@$testimonialCaption->data_values->title)</h2>
                    <span class="title-border bg_img" data-background="{{asset($activeTemplateTrue . 'frontend/images/icon-title.png')}}"></span>
                </div>
            </div>
        </div>
        <div class="row justify-content-center ml-b-30">
            <div class="col-lg-12">
                <div class="client-slider">
                    <div class="swiper-wrapper">

                        @foreach($testimonials as $testimonial)
                            <div class="swiper-slide">
                                <div class="client-item">
                                    <div class="client-thumb-area d-flex flex-wrap align-items-center justify-content-between">
                                        <div class="client-thumb">
                                            <img src="{{ getImage('assets/images/frontend/testimonial/'.@$testimonial->data_values->image, '100x100') }}" alt="@lang('client')">
                                            <span class="client-quote">
                                                <i class="las la-quote-left"></i>
                                            </span>
                                        </div>
                                        <div class="client-ratings pt-40">
                                            @php echo __(displayRating(intval($testimonial->data_values->rating))) @endphp
                                        </div>
                                    </div>
                                    <div class="client-content">
                                        <h3 class="title">{{ __(@$testimonial->data_values->author) }} - <span>{{ __(@$testimonial->data_values->designation) }}</span></h3>
                                        <p>{{ __(@$testimonial->data_values->quote) }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </div>
</section>



