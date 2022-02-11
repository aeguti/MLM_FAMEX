@extends($activeTemplate.'layouts.master')

@section('content')

    @php
        $content = getContent('banner.content', true);
    @endphp

    <section class="banner-section bg_img" data-background="{{getImage('assets/images/frontend/banner/' . @$content->data_values->background_image, '1920x1024')}}">
        <div class="wave-block bg_img" data-background="{{asset($activeTemplateTrue . 'frontend/images/banner/wave.png')}}"></div>
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-8 text-center">
                    <div class="banner-content">
                        <h1 class="title text-white">{{__(@$content->data_values->title)}}</h1>
                        <p class="text-white">{{__(@$content->data_values->description)}}</p>
                        <div class="banner-btn">
                            <a href="{{ @$content->data_values->left_button_link }}" class="btn--base">
                                {{__(@$content->data_values->left_button)}}
                            </a>
                            <a href="{{ @$content->data_values->right_button_link }}" class="btn--base active">
                                {{__(@$content->data_values->right_button)}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="particles"></div>
    </section>



    @if($sections->secs != null)
        @foreach(json_decode($sections->secs) as $sec)
            @include($activeTemplate.'sections.'.$sec)
        @endforeach
    @endif

@endsection

@push('script-lib')
<script src="{{asset($activeTemplateTrue . 'frontend/js/particles.min.js')}}"></script>
<script src="{{asset($activeTemplateTrue . 'frontend/js/particles-app.js')}}"></script>
@endpush


