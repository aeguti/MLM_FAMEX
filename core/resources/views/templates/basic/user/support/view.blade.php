@extends($activeTemplate . 'user.layouts.app')

@section('panel')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-bg d-flex flex-wrap justify-content-between align-items-center">
                    <h5 class="card-title mt-0">
                        @if($my_ticket->status == 0)
                            <span class="badge badge--success">@lang('Open')</span>
                        @elseif($my_ticket->status == 1)
                            <span class="badge badge--primary ">@lang('Answered')</span>
                        @elseif($my_ticket->status == 2)
                            <span class="badge badge--warning">@lang('Replied')</span>
                        @elseif($my_ticket->status == 3)
                            <span class="badge badge--dark">@lang('Closed')</span>
                        @endif
                        [@lang('Ticket')#{{ $my_ticket->ticket }}] {{ $my_ticket->subject }}
                    </h5>
                    <button class="btn btn-sm btn--danger close-button" type="button" data-toggle="modal" data-target="#DelModal"><i class="fa fa-times"></i> @lang('Close Ticket')
                    </button>
                </div>
                <div class="card-body">
                    @if($my_ticket->status != 4)
                        <form method="post" action="{{ route('ticket.reply', $my_ticket->id) }}"
                                enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row justify-content-between">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea name="message" class="form-control form-control-lg" id="inputMessage" placeholder="@lang('Your Reply') ..." rows="4" cols="10" required></textarea>
                                    </div>
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


                            <button type="submit" class="btn btn--success btn-block" name="replayTicket" value="1"><i class="fa fa-reply"></i> @lang('Reply')</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @foreach($messages as $message)
                        @if($message->admin_id == 0)
                            <div class="row border border-primary border-radius-3 my-3 py-3 mx-2">
                                <div class="col-md-3 border-right text-right">
                                    <h5 class="my-3">{{ $message->ticket->name }}</h5>
                                </div>
                                <div class="col-md-9">
                                    <p class="text-muted font-weight-bold my-3">
                                        @lang('Posted on') {{ $message->created_at->format('l, dS F Y @ H:i') }}</p>
                                    <p>{{$message->message}}</p>
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
                        @else
                            <div class="row border border-warning border-radius-3 my-3 py-3 mx-2"
                                 style="background-color: #ffd96729">
                                <div class="col-md-3 border-right text-right">
                                    <h5 class="my-3">{{ $message->admin->name }}</h5>
                                    <p class="lead text-muted">@lang('Staff')</p>
                                </div>
                                <div class="col-md-9">
                                    <p class="text-muted font-weight-bold my-3">
                                        @lang('Posted on') {{ $message->created_at->format('l, dS F Y @ H:i') }}</p>
                                    <p>{{$message->message}}</p>@if($message->attachments()->count() > 0)
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
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="DelModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form method="post" action="{{ route('ticket.reply', $my_ticket->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title"> @lang('Confirmation Alert')!</h5>
                        <button type="button" class="close close-button" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <strong class="text-dark">@lang('Are you sure you want to Close This Support Ticket')?</strong>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark btn-sm" data-dismiss="modal">
                            @lang('No')
                        </button>
                        <button type="submit" class="btn btn--success btn-sm" name="replayTicket"
                                value="2"></i> @lang("Yes")
                        </button>
                    </div>
                </form>
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
