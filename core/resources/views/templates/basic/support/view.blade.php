@extends($activeTemplate.'layouts.master')

@section('content')

    <section class="support-ticket-section ptb-80">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 mb-lg-0">
                    <div class="comment-area mb-5">
                        <div class="row justify-content-center justify-content-lg-between">
                            <div class="col-md-12">
                                <div class="card support-ticket">
                                    <div class="card-header  justify-content-between">
                                        <h5 class="card-title">
                                            @if($my_ticket->status == 0)
                                                <span class="badge badge-success">@lang('Open')</span>
                                            @elseif($my_ticket->status == 1)
                                                <span class="badge badge-primary">@lang('Answered')</span>
                                            @elseif($my_ticket->status == 2)
                                                <span class="badge badge-warning">@lang('Replied')</span>
                                            @elseif($my_ticket->status == 3)
                                                <span class="badge badge-dark">@lang('Closed')</span>
                                            @endif
                                            [@lang('Ticket')#{{ $my_ticket->ticket }}] {{ $my_ticket->subject }}
                                        </h5>
                                        @if($my_ticket->status !== 3)
                                            <button class="close-btn" type="button" title="@lang('Close Ticket')"
                                                  data-toggle="modal" data-target="#DelModal">
                                                  <i class="fa fa-lg fa-times-circle"></i></button>
                                        @endif
                                    </div>


                                </div>
                            </div>
                        </div>
                        @if($my_ticket->status != 3)
                            <form class="comment-form" method="post"
                                  action="{{ route('ticket.reply', $my_ticket->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <textarea name="message" placeholder="@lang('Your Reply') ..." required></textarea>
                                </div>

                                <div class="form-group">
                                    <span for="inputAttachments text-white">@lang('Attachments')</span>
                                    <div class="custom-file">
                                        <input name="attachments[]" type="file" id="customFile" class="custom-file-input form-control-sm">
                                        <label class="custom-file-label col-form-label-sm" for="custmFile">@lang('Choose file')</label>
                                    </div>
                                </div>

                                <div id="fileUploadsContainer"></div>

                                <p class="ticket-attachments-message text-muted mt-minus-15">
                                    @lang("Allowed File Extensions: .jpg, .jpeg, .png, .pdf")
                                </p>


                                <div class="form-group">
                                    <a href="javascript:void(0)" class="add-more-btn">
                                        <i class="la la-plus"></i>
                                    </a>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="submit-btn" name="replayTicket" value="1">
                                        <i class="fa fa-reply"></i> @lang('Reply')
                                    </button>
                                </div>
                            </form>
                        @endif
                    </div>

                    <div class="comment-area">
                        <ul class="comment-wrapper mb-20-none">
                            <li>
                                @foreach($messages as $message)
                                    @if($message->admin_id == 0)
                                        <div class="comment-item user d-flex flex-wrap align-items-center">
                                            <div class="comment-thumb">
                                                <img src="{{ getImage('') }}" alt="*">
                                            </div>
                                            <div class="comment-content">
                                                <div
                                                    class="comment-header align-items-center d-flex flex-wrap justify-content-between">
                                                    <div class="comment-header-left ">
                                                        <h5 class="sub-title mb-0"><a>{{ $message->ticket->name }}</a></h5>
                                                        <span class="comment-post">  @lang('Posted on') {{ diffForHumans($message->created_at) }}</span>
                                                    </div>
                                                </div>
                                                <p class="comment-custom-style">{{$message->message}}</p>
                                                @if($message->attachments()->count() > 0)
                                                    <div class="mt-2">
                                                        @foreach($message->attachments as $k=> $image)
                                                            <a href="{{route('ticket.download',encrypt($image->id))}}"
                                                               class="mr-3 Attachment"><i
                                                                    class="fa fa-file"></i> @lang('Attachment') {{++$k}}
                                                            </a>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @else
                                        <ul>
                                            <li>
                                                <div class="comment-item admin d-flex flex-wrap align-items-center">
                                                    <div class="comment-thumb">
                                                        <a class="h-100">
                                                            <img  src="{{ getImage('assets/images/logoIcon/favicon.png') }}" alt="*">
                                                        </a>
                                                    </div>
                                                    <div class="comment-content">
                                                        <div class="comment-header align-items-center d-flex flex-wrap justify-content-between">
                                                            <div class="comment-header-left ">
                                                                <h4 class="sub-title mb-0">
                                                                    {{ $message->admin->name }} (@lang('Staff'))
                                                                </h4>

                                                                <span class="comment-post">  @lang('Posted on') {{ diffForHumans($message->created_at) }} </span>


                                                            </div>
                                                        </div>
                                                        <p class="comment-custom-style">{{$message->message}}</p>
                                                        @if($message->attachments()->count() > 0)
                                                            <div class="mt-2">
                                                                @foreach($message->attachments as $k=> $image)
                                                                    <a href="{{route('ticket.download',encrypt($image->id))}}"
                                                                       class="mr-3"><i
                                                                            class="fa fa-file"></i> @lang('Attachment') {{++$k}}
                                                                    </a>
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>

                                    @endif
                                @endforeach

                            </li>
                        </ul>
                    </div>

                </div>

            </div>
        </div>
    </section>

    <div class="modal fade" id="DelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form method="post" action="{{ route('ticket.reply', $my_ticket->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title"> @lang('Confirmation')!</h5>
                        <button type="button" class="close close-button" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <strong class="text-dark">@lang('Are you sure you want to Close This Support Ticket')?</strong>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark btn-sm" data-dismiss="modal">@lang('No')</button>
                        <button type="submit" class="btn btn--success btn-sm" name="replayTicket" value="2">@lang("Yes")</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('css')
    <link rel="stylesheet" href="{{asset($activeTemplateTrue . 'frontend/css/ticket.css')}}">
@endpush

@push('script')
    <script>
        (function ($) {
            "use strict";
            $(document).ready(function () {
                $('.delete-message').on('click', function (e) {
                    $('.message_id').val($(this).data('id'));
                });
            });

            $(document).on("change", '.custom-file-input' ,function() {
                var fileName = $(this).val().split("\\").pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            });

            var itr = 0;

            $('.add-more-btn').on('click', function(){
                itr++
                $("#fileUploadsContainer").append(` <div class="form-group custom-file">
                                            <input type="file" name="attachments[]" id="customFile${itr}" class="custom-file-input"/>
                                            <label class="custom-file-label" for="customFile${itr}">@lang('Choose file')</label>
                                        </div>`);

            });
        })(jQuery);

    </script>
@endpush
