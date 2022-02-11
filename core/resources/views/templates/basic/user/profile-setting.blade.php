@extends($activeTemplate . 'user.layouts.app')

@section('panel')

    <div class="row mb-none-30">
        <div class="col-xl-3 col-lg-5 col-md-5">
            <div class="card b-radius--10 overflow-hidden box--shadow1">
                <div class="card-body p-0">
                    <div class="p-3 bg--white">
                        <img id="output" src="{{ getImage('assets/images/user/profile/'. auth()->user()->image, '350x300')}}" alt="@lang('profile-image')" class="b-radius--10 w-100">


                        <ul class="list-group mt-3">
                            <li class="list-group-item d-flex justify-content-between">
                                <span>@lang('Name')</span> {{auth()->user()->fullname}}
                            </li>
                            <li class="list-group-item rounded-0 d-flex justify-content-between">
                                <span>@lang('Username')</span> {{auth()->user()->username}}
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>@lang('Joined at')</span> {{date('d M, Y h:i A',strtotime(auth()->user()->created_at))}}
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-9 col-lg-7 col-md-7 mb-30">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-50 border-bottom pb-2">{{auth()->user()->fullname}} @lang('Information')</h5>

                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold">@lang('First Name') <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control form-control-lg" type="text" name="firstname"
                                           value="{{auth()->user()->firstname}}" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label  font-weight-bold">@lang('Last Name') <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control form-control-lg" type="text" name="lastname" value="{{auth()->user()->lastname}}" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold">@lang('Email')<span class="text-danger">*</span></label>
                                    <input class="form-control form-control-lg" type="email" value="{{auth()->user()->email}}" readonly>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label  font-weight-bold">@lang('Mobile Number')<span
                                            class="text-danger">*</span></label>
                                    <input class="form-control form-control-lg" type="text"
                                           value="{{auth()->user()->mobile}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label  font-weight-bold">@lang('Avatar')</label>
                                    <input class="form-control form-control-lg" type="file" accept="image/*"  onchange="loadFile(event)" name="image">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold">@lang('Address') </label>
                                    <input class="form-control form-control-lg" type="text" name="address"
                                           value="{{auth()->user()->address->address}}">
                                    <small class="form-text text-muted"><i
                                            class="las la-info-circle"></i>@lang('House number, street address')
                                    </small>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label font-weight-bold">@lang('City')</label>
                                    <input class="form-control form-control-lg" type="text" name="city"
                                           value="{{auth()->user()->address->city}}">
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold">@lang('State')</label>
                                    <input class="form-control form-control-lg" type="text" name="state"
                                           value="{{auth()->user()->address->state}}">
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold">@lang('Zip/Postal')</label>
                                    <input class="form-control form-control-lg" type="text" name="zip"
                                           value="{{auth()->user()->address->zip}}">
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold">@lang('Country')</label>
                                    <select name="country" class="form-control form-control-lg"> @include('partials.country') </select>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn--primary btn-block btn-lg">@lang('Save Changes')</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('breadcrumb-plugins')
    <a href="{{route('user.change-password')}}" class="btn btn--success btn--shadow"><i class="fa fa-key"></i>@lang('Change Password')</a>
@endpush



@push('script')
    <script>
        'use strict';
        (function($){
            $("select[name=country]").val("{{ auth()->user()->address->country }}");
        })(jQuery)

        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src)
            }
        };


    </script>
@endpush


