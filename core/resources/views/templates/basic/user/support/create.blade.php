@extends($activeTemplate . 'user.layouts.app')
@section('panel')
    <div class="row justify-content-center mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __($page_title) }}
                    </div>
                    <div class="card-body">
                        <form  action="{{route('ticket.store')}}"  method="post" enctype="multipart/form-data" onsubmit="return submitUserForm();">
                            @csrf
                            <div class="row ">
                                <div class="form-group col-md-6">
                                    <label for="name">@lang('Name')</label>
                                    <input type="text"  name="name" value="{{@$user->firstname . ' '.@$user->lastname}}" class="form-control form-control-lg" placeholder="@lang('Enter Name')" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email">@lang('Email address')</label>
                                    <input type="email"  name="email" value="{{@$user->email}}" class="form-control form-control-lg" placeholder="@lang('Enter your Email')" required>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="website">@lang('Subject')</label>
                                    <input type="text" name="subject" value="{{old('subject')}}" class="form-control form-control-lg" placeholder="@lang('Subject')" >
                                </div>
                                <div class="col-12 form-group">
                                    <label for="inputMessage">@lang('Message')</label>
                                    <textarea name="message" id="inputMessage" rows="6" class="form-control form-control-lg">{{old('message')}}</textarea>
                                </div>
                            </div>

                            <div class="form-group mb-0">
                                <span for="inputAttachments text-white">@lang('Attachments')</span>
                                <div class="custom-file">
                                    <input name="attachments[]" type="file" id="customFile" class="custom-file-input" accept=".jpg,.jpeg,.png,.pdf">

                                    <label class="custom-file-label form-control-lg" for="custmFile">@lang('Choose file')</label>
                                </div>
                            </div>

                            <div class="fileUploadsContainer"></div>

                            <p class="text-muted m-2">
                                <i class="la la-info-circle"></i> @lang("Allowed File Extensions: .jpg, .jpeg, .png, .pdf")
                            </p>

                            <div class="form-group">
                                <a href="javascript:void(0)" class="btn btn--success add-more-btn">
                                    <i class="la la-plus"></i>
                                    @lang('Add More')
                                </a>
                            </div>

                            <div class="row form-group justify-content-center">
                                <div class="col-md-12">
                                    <button class="btn btn-block btn--success" type="submit" id="recaptcha" ><i class="fa fa-paper-plane"></i>&nbsp;@lang('Send')</button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
@push('script')
    <script>
        'use strict';
        (function($){
            $(document).on("change", '.custom-file-input' ,function() {
                var fileName = $(this).val().split("\\").pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            });

            var itr = 0;

            $('.add-more-btn').on('click', function(){
                itr++
                $(".fileUploadsContainer").append(` <div class="form-group custom-file mt-3">
                                            <input type="file" name="attachments[]" id="customFile${itr}" class="custom-file-input" accept=".jpg,.jpeg,.png,.pdf" />
                                            <label class="custom-file-label form-control-lg" for="customFile${itr}">@lang('Choose file')</label>
                                        </div>`);

            });

        })(jQuery)
    </script>
@endpush
@push('breadcrumb-plugins')
    <a href="{{route('ticket') }}" class="btn btn-sm btn--primary box--shadow1 text--small"><i class="la la-backward"></i> @lang('Go Back')</a>
@endpush
