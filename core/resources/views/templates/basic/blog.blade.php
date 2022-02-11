@extends($activeTemplate.'layouts.master')

@section('content')

<section class="blog-section bg--gray ptb-80">
    <div class="container">
        <div class="row justify-content-center mb-30-none">
            @foreach($blogs as $blog)
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb-30">
                <div class="blog-item">
                    <div class="blog-thumb">
                        <img src="{{ getImage('assets/images/frontend/blog/thumb_'.@$blog->data_values->blog_image, '770x520') }}" alt="@lang('blog')">
                        <span class="blog-date text-center">{{showDateTime($blog->created_at,  $format = 'd M')}}</span>
                    </div>
                    <div class="blog-content">

                        <h3 class="title"><a href="{{route('singleBlog', [slug(@$blog->data_values->title), $blog])}}">{{ __(@$blog->data_values->title) }}</a></h3>
                        <p> {{ __(shortDescription(strip_tags(@$blog->data_values->description) , 120)) }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row justify-content-center mb-30-none">
            <div class="col-lg-12 mb-30">
                {{  $blogs->links() }}
            </div>
        </div>
    </div>
</section>

    @if($sections->secs != null)
        @foreach(json_decode($sections->secs) as $sec)
            @include($activeTemplate.'sections.'.$sec)
        @endforeach
    @endif
@endsection


