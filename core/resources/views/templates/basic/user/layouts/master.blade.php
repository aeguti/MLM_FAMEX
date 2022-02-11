
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $general->sitename($page_title ?? '') }}</title>
    <!-- site favicon -->
    <link rel="shortcut icon" type="image/png" href="{{getImage(imagePath()['logoIcon']['path'] .'/favicon.png')}}">

    <link rel="stylesheet" href="{{ asset($activeTemplateTrue.'users/css/vendor/bootstrap.min.css') }}">
    <!-- bootstrap toggle css -->
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'users/css/vendor/bootstrap-toggle.min.css')}}">
    <!-- fontawesome 5  -->
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'users/css/all.min.css')}}">
    <!-- line-awesome webfont -->
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'users/css/line-awesome.min.css')}}">

    @stack('style-lib')

    <!-- custom select box css -->
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'users/css/vendor/nice-select.css')}}">

    <!-- select 2 css -->
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'users/css/vendor/select2.min.css')}}">

    <!-- bootstrap-pincode css -->
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'users/css/vendor/bootstrap-pincode-input.css')}}">
    <!-- dashdoard main css -->

    @stack('style-lib')

    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'users/css/app.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'users/css/custom.css')}}">

    @stack('style')

    @stack('css')
</head>
<body>


@yield('content')



<!-- jQuery library -->
<script src="{{asset($activeTemplateTrue.'users/js/vendor/jquery-3.6.0.min.js')}}"></script>
<!-- bootstrap js -->
<script src="{{asset($activeTemplateTrue.'users/js/vendor/bootstrap.bundle.min.js')}}"></script>
<!-- bootstrap-toggle js -->
<script src="{{asset($activeTemplateTrue.'users/js/vendor/bootstrap-toggle.min.js')}}"></script>

<!-- slimscroll js for custom scrollbar -->
<script src="{{asset($activeTemplateTrue.'users/js/vendor/jquery.slimscroll.min.js')}}"></script>
<!-- custom select box js -->
<script src="{{asset($activeTemplateTrue.'users/js/vendor/jquery.nice-select.min.js')}}"></script>


@include('partials.notify')

@stack('script-lib')

<script src="{{ asset($activeTemplateTrue.'users/js/nicEdit.js') }}"></script>

<!-- seldct 2 js -->
<script src="{{asset($activeTemplateTrue.'users/js/vendor/select2.min.js')}}"></script>
<!-- data-table js -->
<script src="{{asset($activeTemplateTrue.'users/js/vendor/datatables.min.js')}}"></script>
<!-- main js -->
<script src="{{asset($activeTemplateTrue.'users/js/app.js')}}"></script>

{{-- LOAD NIC EDIT --}}
<script>
    'use strict';
    bkLib.onDomLoaded(function() {
        $( ".nicEdit" ).each(function( index ) {
            $(this).attr("id","nicEditor"+index);
            new nicEditor({fullPanel : true}).panelInstance('nicEditor'+index,{hasPanel : true});
        });
    });
</script>

@stack('script')


@include('partials.plugins')

</body>
</html>


