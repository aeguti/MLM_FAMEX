<header class="header-section">
    <div class="header">
        <div class="header-bottom-area">
            <div class="container">
                <div class="header-menu-content">
                    <nav class="navbar navbar-expand-lg p-0">
                        <a class="site-logo site-title" href="{{url('/')}}">
                            <img src="{{getImage(imagePath()['logoIcon']['path'] .'/logo.png')}}"  alt="@lang('site-logo')">
                        </a>
                        <div class="language-select-area d-block d-lg-none ml-auto">
                            <select class="language-select langSel">
                                @foreach($language as $item)
                                    <option value="{{$item->code}}" @if(session('lang') == $item->code) selected  @endif>{{ __($item->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="fas fa-bars"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav main-menu ml-auto">
                                <li><a href="{{url('/')}}">@lang('Home')</a></li>
                                @foreach($pages as $k => $data)
                                    <li><a href="{{route('pages',[$data->slug])}}">{{trans($data->name)}}</a></li>
                                @endforeach
                                <li><a href="{{route('blog')}}">@lang('Blog')</a></li>
                                <li><a href="{{route('contact')}}">@lang('Contact')</a></li>


                            </ul>

                            <div class="language-select-area d-none d-lg-block">
                                <select class="language-select langSel">
                                    @foreach($language as $item)
                                        <option value="{{$item->code}}" @if(session('lang') == $item->code) selected  @endif>{{ __($item->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="header-action">
                                @guest
                                    <a href="{{route('user.register')}}" class="btn--base">@lang('Register')</a>
                                    <a href="{{route('user.login')}}" class="btn--base active">@lang('Login')</a>
                                @else
                                    <a href="{{route('user.home')}}" class="btn--base active">@lang('Dashboard')</a>
                                @endguest
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
