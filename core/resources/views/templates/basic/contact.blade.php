@extends($activeTemplate.'layouts.master')

@section('content')
<section class="contact-section ptb-80 bg--gray bg_img"
    data-background="{{ getImage('assets/images/frontend/contact_us/'.@$contact->data_values->background_image, '1920x820') }}">
    <div class="container">
        <div class="row justify-content-center mb-30-none">
            <div class="col-lg-4 mb-30">
                <div class="contact-info-item-area mb-40-none">
                    <div class="contact-info-item d-flex flex-wrap mb-40">
                        <div class="contact-info-icon">
                            <i class="fas fa fa-map-marker-alt"></i>
                        </div>
                        <div class="contact-info-content">
                            <h3 class="title">@lang('Office Address')</h3>
                            <p>{{@$contact->data_values->contact_details}}</p>
                        </div>
                    </div>
                    <div class="contact-info-item d-flex flex-wrap mb-40">
                        <div class="contact-info-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="contact-info-content">
                            <h3 class="title">@lang('Email Address')</h3>
                            <p><a href="Mailto:{{@$contact->data_values->email_address}}">{{@$contact->data_values->email_address}}</a>
                            </p>
                        </div>
                    </div>
                    <div class="contact-info-item d-flex flex-wrap mb-40">
                        <div class="contact-info-icon">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div class="contact-info-content">
                            <h3 class="title">@lang('Phone Number')</h3>
                            <p><a href="Tel:{{@$contact->data_values->contact_number}}">{{@$contact->data_values->contact_number}}</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 mb-30">
                <div class="contact-form-area">
                    <form method="post" action="" class="contact-form">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 form-group">
                                <input type="text" name="name" class="form-control" value="{{old('name')}}"
                                    placeholder="@lang('Your Name')" id="name" required>
                            </div>
                            <div class="col-lg-6 form-group">
                                <input type="email" name="email" class="form-control" value="{{old('email')}}"
                                    id="email" placeholder="@lang('Enter E-Mail Address')" required>
                            </div>
                            <div class="col-lg-12 form-group">
                                <input type="text" name="subject" class="form-control"
                                    placeholder="@lang('Write your subject')" value="{{old('subject')}}" id="subject"
                                    required>
                            </div>
                            <div class="col-lg-12 form-group">
                                <textarea class="form-control" placeholder="@lang('Write your message')" name="message"
                                    id="message" required>{{old('message')}}</textarea>
                            </div>

                            @php
                            $captcha = getCustomCaptcha($height = 46, $width = '100%', $bgcolor = '#003');
                            @endphp

                            @if($captcha)
                            <div class="form-group col-lg-12">
                                <input type="text" class="form-control" name="captcha" maxlength="6"
                                    placeholder="@lang('Enter The Code Below')" required>
                            </div>
                            <div class="form-group col-lg-12">
                                @php echo $captcha @endphp
                            </div>
                            @endif

                            @if(reCaptcha())
                            <div class="form-group col-lg-12 ">
                                @php echo reCaptcha(); @endphp
                            </div>
                            @endif

                            <div class="col-lg-12 form-group">
                                <button type="submit" class="submit-btn">@lang('Send Message')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="maps"></div>

@endsection


@push('script-lib')
<script src="http://maps.google.com/maps/api/js?key={{ @$contact->data_values->api_key }}"></script>
@endpush

@push('script')
<script>
    'use strict';
    (function($){
        var styleArray = [
            {
                "featureType": "administrative",
                "elementType": "labels.text.fill",
                "stylers": [
                    {
                        "color": "#297bff"
                    }
                ]
            },
            {
                "featureType": "landscape",
                "elementType": "all",
                "stylers": [
                    {
                        "color": "#d2e9ff"
                    }
                ]
            },
            {
                "featureType": "poi",
                "elementType": "all",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "road",
                "elementType": "all",
                "stylers": [
                    {
                        "saturation": -100
                    },
                    {
                        "lightness": 45
                    }
                ]
            },
            {
                "featureType": "road.highway",
                "elementType": "all",
                "stylers": [
                    {
                        "visibility": "simplified"
                    }
                ]
            },
            {
                "featureType": "road.arterial",
                "elementType": "labels.icon",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "transit",
                "elementType": "all",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "water",
                "elementType": "all",
                "stylers": [
                    {
                        "color": "#b8dcff"
                    },
                    {
                        "visibility": "on"
                    }
                ]
            }]

        var mapOptions = {
            center: new google.maps.LatLng(`{{ @$contact->data_values->latitude }}`, `{{ @$contact->data_values->longitude }}`),
            zoom: 12,
            styles: styleArray,
            scrollwheel: true,
            backgroundColor: 'transparent',
            mapTypeControl: true,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementsByClassName("maps")[0],
            mapOptions);
        var myLatlng = new google.maps.LatLng(40.7590615, -73.969231);
        var focusplace = { lat: 40.7590615, lng: -73.969231 };
        var marker = new google.maps.Marker({
            position: myLatlng,
            map: map,
            icon: {
                url: `{{asset($activeTemplateTrue . 'frontend/images/map-marker.png')}}`
            }
        });
    })(jQuery)
</script>
@endpush
