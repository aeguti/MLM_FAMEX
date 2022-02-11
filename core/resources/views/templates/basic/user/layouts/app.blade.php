@extends($activeTemplate .'user.layouts.master')

@section('content')
    <div class="page-wrapper default-version">
        @include($activeTemplate .'user.partials.sidenav')
        @include($activeTemplate .'user.partials.topnav')
        <div class="body-wrapper">
            <div class="bodywrapper__inner">
                @include($activeTemplate .'user.partials.breadcrumb')
                @yield('panel')
            </div>
        </div>
    </div>
@endsection
