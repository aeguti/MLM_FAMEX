@php
    $blogCaption = getContent('blog.content',true);
    $blogs = getContent('blog.element',false,3);
@endphp

<section class="blog-section bg--gray ptb-80">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 text-center">
                <div class="section-header">
                    <h3 class="sub-title">@lang(@$blogCaption->data_values->subtitle)</h3>
                    <h2 class="section-title">@lang(@$blogCaption->data_values->title)</h2>
                    <span class="title-border bg_img" data-background="{{asset($activeTemplateTrue . 'frontend/images/icon-title.png')}}"></span>
                </div>
            </div>
        </div>
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


    </div>
</section>

