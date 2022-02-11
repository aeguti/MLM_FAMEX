@php
    $featureCaption = getContent('feature.content',true);
    $features       = getContent('feature.element');
@endphp
@if($features)

    <section class="service-section bg--gray ptb-80">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 text-center">
                    <div class="section-header">
                        <h3 class="sub-title">@lang(@$featureCaption->data_values->subtitle)</h3>
                        <h2 class="section-title">@lang(@$featureCaption->data_values->title)</h2>
                        <span class="title-border bg_img" data-background="{{asset($activeTemplateTrue . 'frontend/images/icon-title.png')}}"></span>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mb-30-none">
                @foreach($features as $feature)

                    <div class="col-lg-4 col-md-6 col-sm-8 mb-30">
                        <div class="service-item">
                            <div class="service-body d-flex flex-wrap align-items-center">
                                <div class="service-icon">
                                    <?php echo @$feature->data_values->icon ?>
                                </div>
                                <div class="service-content">
                                    <h3 class="title">{{__(@$feature->data_values->title)}}</h3>
                                    <p>{{__(@$feature->data_values->description)}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif

