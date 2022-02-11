@php
    $teamTitle  = getContent('team.content', true);
    $teams      = getContent('team.element');
@endphp

<section class="team-section ptb-80">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 text-center">
                <div class="section-header">
                    <h3 class="sub-title">@lang(@$teamTitle->data_values->subtitle)</h3>
                    <h2 class="section-title">@lang(@$teamTitle->data_values->title)</h2>
                    <span class="title-border bg_img" data-background="{{asset($activeTemplateTrue . 'frontend/images/icon-title.png')}}"></span>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mb-30-none">
            @foreach($teams as $team)
                <div class="col-lg-3 col-md-6 col-sm-6 mb-30">
                    <div class="team-item text-center">
                        <div class="team-thumb">
                            <img src="{{ getImage('assets/images/frontend/team/'. @$team->data_values->image, '270x332') }}" alt="@lang('team')">
                        </div>
                        <div class="team-content">
                            <h3 class="title"><a href="#0">@lang(@$team->data_values->name)</a></h3>
                            <span class="sub-title">{{@$team->data_values->designation}}</span>
                        </div>
                        <div class="team-content-overlay">
                            <h3 class="title"><a href="#0">@lang(@$team->data_values->name)</a></h3>
                            <span class="sub-title">{{@$team->data_values->designation}}</span>
                            <p>{{@$team->data_values->description}}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>


