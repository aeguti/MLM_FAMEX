@php
    $faqTitle = getContent('faq.content', true);
    $faqs     = getContent('faq.element');
    $faqs     = $faqs->chunk(ceil($faqs->count()/2));
@endphp


<section class="transaction-section ptb-80">
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-lg-12 text-center">
                <div class="section-header">
                    <h3 class="sub-title">@lang(@$faqTitle->data_values->sub_heading)</h3>
                    <h2 class="section-title">@lang(@$faqTitle->data_values->heading)</h2>
                    <span class="title-border bg_img" data-background="{{asset($activeTemplateTrue . 'frontend/images/icon-title.png')}}"></span>
                </div>
            </div>
        </div>

        <div class="row flex-wrap-reverse justify-content-between mb-20-none">
            <div class="col-lg-6">
                <div class="faq-wrapper style-two">
                    @foreach($faqs[0] as $key => $faql)
                        <div class="faq-item">
                            <div class="faq-title">
                                <h6 class="title">{{ __(@$faql->data_values->question) }}</h6>
                                <div class="right-icon"></div>
                            </div>
                            <div class="faq-content">
                                <p>{{ __(@$faql->data_values->answer) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-6">
                <div class="faq-wrapper style-two">
                    @foreach($faqs[1] as $key => $faql)
                        <div class="faq-item">
                            <div class="faq-title">
                                <h6 class="title">{{ __(@$faql->data_values->question) }}</h6>
                                <div class="right-icon"></div>
                            </div>
                            <div class="faq-content">
                                <p>{{ __(@$faql->data_values->answer) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

