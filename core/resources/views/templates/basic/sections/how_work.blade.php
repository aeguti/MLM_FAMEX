@php
    $content = getContent('how_work.content',true);
    $elements       = getContent('how_work.element', false, 4, true);
@endphp
@if($elements)
<section class="video-section bg-overlay-black bg_img" data-background="{{getImage('assets/images/frontend/how_work/' . @$content->data_values->background_image, '1920x824')}}">
    <div class="wave-block bg_img" data-background="{{asset($activeTemplateTrue . 'frontend/images/banner/wave.png')}}"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 text-center">
                <div class="video-area">
                    <a class="video-icon" data-rel="lightcase:myCollection" href="{{ @$content->data_values->video_link }}">
                        <i class="las la-play"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="service-section bg--gray ptb-80">
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
        <div class="row mb-30-none">
            @foreach($elements as $item)
                <div class="col-sm-6 col-lg-3 mb-30">
                    <div class="how__item">
                        <div class="how__thumb">
                            <div class="thumb">
                                {{ $loop->iteration }}
                            </div>
                        </div>
                        <h5 class="title">{{__(@$item->data_values->title)}}</h5>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>


@endif
