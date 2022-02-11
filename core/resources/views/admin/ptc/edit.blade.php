@extends('admin.layouts.app')
@section('panel')





<div class="row">
    <div class="col-md-12">

        <div class="card">
            <div class="card-body">

                <form role="form" method="POST" action="{{ route("admin.ptc.update",$id) }}" enctype="multipart/form-data">
                    @csrf


                    <div class="row">

                     <div class="form-group col-md-8">
                        <label>@lang('Title of the Ad') <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control" value="{{ $ptc->title }}" placeholder="Title" required>
                    </div>

                    <div class="form-group col-md-4">
                        <label>@lang('Amount') <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" name="amount" class="form-control" value="{{ getAmount($ptc->amount) }}" placeholder="@lang('User will get ...')" required>
                            <div class="input-group-append">
                                <div class="input-group-text"> {{ $general->cur_text }} </div>
                            </div>
                        </div>
                    </div>


                    <div class="form-group col-md-4">
                        <label>@lang('Duration') <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" name="duration" class="form-control" value="{{ $ptc->duration }}" placeholder="@lang('Duration')" required>
                            <div class="input-group-append">
                                <div class="input-group-text">@lang('SECONDS')</div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <label>@lang('Maximum Show') <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" name="max_show" class="form-control" value="{{ $ptc->max_show }}" placeholder="@lang('Maximum Show')" required>
                            <div class="input-group-append">
                                <div class="input-group-text">@lang('Times')</div>
                            </div>
                        </div>
                    </div>


                    <div class="form-group col-md-4">
                        <label>@lang('Status')</label>
                        <input type="checkbox" data-width="100%" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="Active" data-off="Inactive" @if($ptc->status) checked @endif name="status">
                    </div>
                </div>






                <div class="row pt-5 mt-5 border-top">

                    <div class="form-group col-md-4">
                        <label for="ads_type">@lang('Advertisement Type') :</label>
                        <input type="hidden" name="ads_type" value="{{$ptc->ads_type}}">
                        <div class="pt-3">
                            @if($ptc->ads_type == 1)
                            <span class="font-weight-normal text--small badge badge--success"><i class="fa fa-link"></i> @lang('URL')</span>
                            @elseif($ptc->ads_type == 2)
                            <span class="font-weight-normal text--small badge badge--dark"><i class="fa fa-image"></i> @lang('Image')</span>
                            @else
                            <span class="font-weight-normal text--small badge badge--primary"><i class="fa fa-code"></i> @lang('Script')</span>
                            @endif
                        </div>

                    </div>



                    @if($ptc->ads_type == 1)

                    <div class="form-group col-md-8">
                        <label>@lang('Link') <span class="text-danger">*</span></label>
                        <input type="text" name="website_link" class="form-control" value="{{ $ptc->ads_body }}" placeholder="@lang('http://example.com')">
                    </div>
                    @elseif($ptc->ads_type == 2)

                    <div class="form-group col-md-4 ">
                        <label>@lang('Banner') <span class="text-danger">*</span></label>

                        <div class="image-upload">
                            <div class="thumb">
                                <div class="avatar-preview">
                                    <div class="profilePicPreview"></div>
                                </div>
                                <div class="avatar-edit">
                                    <input type="file" name="banner_image" class="profilePicUpload" id="image" accept=".png, .jpg, .jpeg"/>
                                    <label for="image" class="bg--primary">@lang('Upload')</label>
                                </div>
                            </div>
                        </div>

                    </div>

                       <div class="form-group col-md-4 ">

                        <label>@lang('Current Banner') <span class="text-danger">*</span></label>
                        <img src="{{ getImage('assets/images/ptcimages/'. $ptc->ads_body) }}" class="w-100" alt="*">

                    </div>

                    @else

                    <div class="form-group col-md-8">
                        <label>@lang('Script') <span class="text-danger">*</span></label>
                        <textarea  name="script" class="form-control">{{ $ptc->ads_body }}</textarea>
                    </div>

                    @endif

                </div>

                <div class="row pt-5 mt-5 border-top">
                    <div class="form-group col-md-12">
                        <button type="submit" class="btn btn--primary btn-block btn-lg">@lang('Update')</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
</div>
@endsection

@push('breadcrumb-plugins')
<a href="{{ route('admin.ptc.index') }}" class="icon-btn"><i class="fa fa-fw fa-backward"></i> @lang('Go Back') </a>
@endpush
