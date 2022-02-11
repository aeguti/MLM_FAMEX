@php
    $latestTrx = getContent('transaction.content', true);
    $deposits = App\Models\Deposit::latest()->where('status', 1)->take(10)->with('user')->get();
    $withdraws = App\Models\Withdrawal::latest()->where('status', 1)->take(10)->with('user')->get();
@endphp

<section class="transaction-section ptb-80">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 text-center">
                <div class="section-header">
                    <h3 class="sub-title">@lang(@$latestTrx->data_values->subtitle)</h3>
                    <h2 class="section-title">@lang(@$latestTrx->data_values->title)</h2>
                </div>
            </div>
        </div>


        <ul class="nav nav-tab justify-content-center transaction-tab-menu">
            <li class="nav-item">
                <a href="#deposit" class="nav-link active" data-toggle="tab">@lang('Latest Deposits')</a>
            </li>
            <li class="nav-item">
                <a href="#withdraw" class="nav-link" data-toggle="tab">@lang('Latest Withdraws')</a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane show fade active" id="deposit">
                <div class="transaction-table">
                    <table>
                        <thead>
                            <tr class="bg-2">
                                <th>@lang('Name')</th>
                                <th>@lang('Date')</th>
                                <th>@lang('Amount')</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($deposits as $deposit)
                            <tr>
                                <td data-input="@lang('Name')">
                                    <div class="author">
                                        <div class="thumb">
                                            <img  src="{{getImage('assets/images/user/profile/' . @$deposit->user->image, '150x150')}}"
                                                alt="@lang('jpg')">
                                        </div>
                                        <div class="content">{{@$deposit->user->fullName}}</div>
                                    </div>
                                </td>
                                <td data-input="@lang('Date')">{{showDateTime($deposit->created_at , $format = 'd F, Y')}}</td>
                                <td data-input="@lang('Amount')">{{getAmount($deposit->amount)}} {{$general->cur_text}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="withdraw">
                <div class="transaction-table">
                    <table>
                        <thead>
                            <tr class="bg-2">
                                <th>@lang('Name')</th>
                                <th>@lang('Date')</th>
                                <th>@lang('Amount')</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($withdraws as $withdraw)
                            <tr>
                                <td data-input="@lang('Name')">
                                    <div class="author">
                                        <div class="thumb">
                                            <img
                                                src="{{getImage('assets/images/user/profile/' . @$withdraw->user->image, '150x150')}}"
                                                alt="@lang('jpg')">
                                        </div>
                                        <div class="content">
                                            {{@$withdraw->user->fullName}}
                                        </div>
                                    </div>
                                </td>
                                <td data-input="@lang('Date')">{{showDateTime($withdraw->created_at , $format = 'd F, Y')}}</td>
                                <td data-input="@lang('Amount')">{{getAmount($withdraw->amount)}} {{$general->cur_text}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
