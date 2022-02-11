
@extends($activeTemplate . 'user.layouts.app')

@section('panel')

<div class="row">
    <div class="col-lg-12">
        <div class="card b-radius--10 overflow-hidden">
            <div class="card-body p-0">
                <div class="table-responsive--sm">
                    <table class="table table--light
                     style--two">
                        <thead>
                            <tr>
                                <th scope="col">@lang('Title')</th>
                                <th scope="col">@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($ads as $data)
                            @if(!in_array($data->id, $viewed))
                            <tr>
                                <td data-label="@lang('Title')">{{ __($data->title) }}</td>
                                <td data-label="@lang('Action')">
                                    <a href="{{ route('user.ptc.show',Crypt::encryptString($data->id.'|'.auth()->user()->id)) }}" class="btn btn--primary" target="_blank">@lang('View Now')</a>
                                </td>
                            </tr>
                            @endif
                            @empty
                            <tr>
                                <td class="text-center" colspan="100%">{{ __($empty_message) }}</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
