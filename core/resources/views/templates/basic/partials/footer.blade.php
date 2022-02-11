


<footer class="footer-section pt-80 bg-overlay-black bg_img" data-background="{{ getImage('assets/images/frontend/footer_section/'.@$footer->data_values->background_image, '1920x390') }}">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 text-center">
                <div class="footer-social-area">
                    <ul class="footer-social">
                        @foreach($socials as $social)
                            <li>
                                <a href="{{@$social->data_values->url}}" target="_blank" title="{{@$social->data_values->title}}">
                                    @php echo @$social->data_values->social_icon; @endphp
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-bottom-area">
            <div class="row justify-content-center">
                <div class="col-lg-12 text-center">
                    <p>{{__(@$footer->data_values->copyright)}}</p>
                </div>
            </div>
        </div>
    </div>
</footer>

