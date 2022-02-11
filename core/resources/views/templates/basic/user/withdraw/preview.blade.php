@extends($activeTemplate . 'user.layouts.app')

@section('panel')

        <div class="row justify-content-center mt-2">
            <div class="col-lg-8 ">
                <div class="card card-deposit">
                    <h5 class="text-center my-3">@lang('Current Balance') :
                        <strong>{{ getAmount(auth()->user()->balance)}}  {{ $general->cur_text }}</strong></h5>
                    <div class="card-body mt-4">
                        <div class="row">
                            <div class="col-md-5">

                                <ul  class="list-group text-center">
                                    <li class="list-group-item">
                                        <span class="font-weight-bold">@lang('Request Amount') :
                                        {{getAmount($withdraw->amount)  }} {{$general->cur_text }} </span>
                                    </li>

                                    <li class="list-group-item">
                                        <span class="font-weight-bold">@lang('Withdrawal Charge') :
                                         {{getAmount($withdraw->charge) }} {{$general->cur_text }} </span>
                                    </li>
                                    <li class="list-group-item">
                                        <span class="font-weight-bold">@lang('After Charge') :
                                         {{getAmount($withdraw->after_charge) }} {{$general->cur_text }} </span>
                                    </li>
                                    <li class="list-group-item">
                                        <span class="font-weight-bold">@lang('Conversion Rate') : 1 {{$general->cur_text }} =
                                         {{getAmount($withdraw->rate)  }} {{$withdraw->currency }} </span>
                                    </li>
                                    <li class="list-group-item">
                                        <span class="font-weight-bold">@lang('You Will Get')
                                            {{getAmount($withdraw->final_amount)  }} {{$withdraw->currency }} </span>
                                    </li>
                                </ul>
                                <div class="form-group mt-5">
                                    <label class="font-weight-bold">@lang('Balance Will be') : </label>
                                    <div class="input-group">
                                        <input type="text" value="{{getAmount($withdraw->user->balance - ($withdraw->amount))}}"  class="form-control form-control-lg" placeholder="@lang('Enter Amount')" required readonly>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text ">{{ $general->cur_text }} </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <form action="{{route('user.withdraw.submit')}}" method="post" enctype="multipart/form-data">
                                    @csrf

                                    @if($withdraw->method->user_data)
                                    @foreach($withdraw->method->user_data as $k => $v)
                                        @if($v->type == "text")
                                            <div class="form-group">
                                                <label><strong>{{__($v->field_level)}} @if($v->validation == 'required') <span class="text-danger">*</span>  @endif</strong></label>
                                                <input type="text" name="{{$k}}" class="form-control" value="{{old($k)}}" placeholder="{{__($v->field_level)}}" @if($v->validation == "required") required @endif>
                                                @if ($errors->has($k))
                                                    <span class="text-danger">{{ __($errors->first($k)) }}</span>
                                                @endif
                                            </div>
                                        @elseif($v->type == "textarea")
                                            <div class="form-group">
                                                <label><strong>{{__($v->field_level)}} @if($v->validation == 'required') <span class="text-danger">*</span>  @endif</strong></label>
                                                <textarea name="{{$k}}"  class="form-control"  placeholder="{{__($v->field_level)}}" rows="3" @if($v->validation == "required") required @endif>{{old($k)}}</textarea>
                                                @if ($errors->has($k))
                                                    <span class="text-danger">{{ __($errors->first($k)) }}</span>
                                                @endif
                                            </div>
                                        @elseif($v->type == "file")

                                            <label><strong>{{__($v->field_level)}} @if($v->validation == 'required') <span class="text-danger">*</span>  @endif</strong></label>
                                            <div class="form-group">
                                                <div class="fileinput fileinput-new " data-provides="fileinput">
                                                    <div class="fileinput-new thumbnail withdraw-thumbnail"
                                                         data-trigger="fileinput">
                                                        <img class="m-w-220px" src="{{ getImage(imagePath()['image']['default'])}}" alt="@lang('image')">
                                                    </div>
                                                    <div class="fileinput-preview fileinput-exists thumbnail wh-200-150"></div>

                                                    <div class="img-input-div">
                                                                <span class="btn btn--info btn-file">
                                                                    <span class="fileinput-new text-white"> @lang('Select') {{$v->field_level}}</span>
                                                                    <span class="fileinput-exists text-white"> @lang('Change')</span>
                                                                    <input type="file" name="{{$k}}" accept="image/*" @if($v->validation == "required") required @endif>
                                                                </span>
                                                        <a href="#" class="btn btn--danger fileinput-exists"
                                                           data-dismiss="fileinput"> @lang('Remove')</a>
                                                    </div>

                                                </div>
                                                @if ($errors->has($k))
                                                    <br>
                                                    <span class="text-danger">{{ __($errors->first($k)) }}</span>
                                                @endif
                                            </div>
                                        @endif
                                    @endforeach
                                    @endif

                                    <div class="form-group">
                                        <button type="submit" class="btn btn--success btn-block btn-lg mt-4 text-center">@lang('Confirm')</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

@endsection

@push('style-lib')
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'/users/css/bootstrap-fileinput.css')}}">
@endpush

@push('script-lib')
    <script src="{{asset($activeTemplateTrue.'/users/js/bootstrap-fileinput.js')}}"></script>

@endpush

