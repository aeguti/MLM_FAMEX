@extends($activeTemplate.'layouts.master')
@section('content')

    <div class="ptb-80">
        <div class="container">
            <div>@php echo (@$description) @endphp</div>
        </div>
    </div>

@endsection
