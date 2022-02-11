@extends($activeTemplate.'layouts.master')

@section('content')
<section class="blog-details-section blog-section bg--gray ptb-80">
    <div class="container">
        <div class="row justify-content-center mb-30-none">
            <div class="col-xl-8 mb-30">
                <div class="blog-item">
                    <div class="blog-thumb">
                        <img src="{{ getImage('assets/images/frontend/blog/'.$blog->data_values->blog_image, '770x520') }}" alt="@lang('blog')">
                        <span class="blog-date text-center">{{showDateTime($blog->created_at,  $format = 'd M')}}</span>
                    </div>

                    <div class="blog-content">
                        <h3 class="title">{{ __($blog->data_values->title) }}</h3>

                        <p>@php echo $blog->data_values->description; @endphp</p>
                    </div>

                </div>
                <div class="comments-area mt-2">
                    <div class="fb-comments" data-width="100%" data-numposts="5"></div>
                </div>
            </div>

            <div class="col-xl-4 mb-30">
                <div class="sidebar">
                    <div class="widget-box">
                        <h5 class="widget-title">@lang('Latest Blog')</h5>
                        <div class="popular-widget-box">
                            @foreach($latestBlogs as $latestBlog)
                                <div class="single-popular-item d-flex flex-wrap align-items-center">
                                    <div class="popular-item-thumb">
                                        <img src="{{ getImage('assets/images/frontend/blog/'.@$latestBlog->data_values->blog_image) }}" alt="@lang('blog')">
                                    </div>

                                    <div class="popular-item-content">
                                        <a href="{{route('singleBlog', [slug(@$latestBlog->data_values->title), $latestBlog])}}">
                                            <h6 class="title"> {{__(str_limit(@$latestBlog->data_values->title, 45))}}</h6>
                                        </a>
                                        <span class="blog-date">{{showDateTime(@$latestBlog->created_at,  $format = 'd F, Y')}}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection

@push('script')
    @php echo fbcomment() @endphp
@endpush


@push('breadcrumb-plugins')
    <li class="breadcrumb-item"><a href="{{ route('blog') }}">@lang('Blog')</a></li>
@endpush






