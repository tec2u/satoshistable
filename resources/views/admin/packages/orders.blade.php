@extends('adminlte::page')

@section('title', 'Package Orders')

@section('content_header')
<h4>@lang('admin.orders.title')</h4>
@stop

@section('content')
@include('flash::message')
<div class="card">
    <div class="card-header">
        <div class="alignPackage">
            <h3>@lang('admin.orders.title')</h3>
        </div>
    </div>
    <div class="card-header">
        <div class="row">
            <div class="col-sm-6 col-md-6">
                <div class="text-left">
                    <div class="btn-group">

                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6">
                <div class="text-right">
                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-lg dropdown-toggle dropdown-icon" data-toggle="dropdown"
                            aria-expanded="false">
                            @lang('admin.orders.filter')
                        </button>
                        <div class="dropdown-menu" style="">
                            <a class="dropdown-item"
                                href="{{ route('admin.packages.orderfilter', ['parameter' => 'paid']) }}">@lang('admin.orders.filterOrder.paid')</a>
                            <a class="dropdown-item"
                                href="{{ route('admin.packages.orderfilter', ['parameter' => 'send']) }}">@lang('admin.orders.filterOrder.pending')</a>
                            <a class="dropdown-item"
                                href="{{ route('admin.packages.orderfilter', ['parameter' => 'canceled']) }}">@lang('admin.orders.filterOrder.canceled')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body table-responsive">
        <span class="counter float-right"></span>
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <form action="{{ route('admin.packages.orderPackages') }}" method="GET">
                    @csrf
                    <div class="input-group input-group-lg">
                        <input type="text" name="search" class="form-control @error('search') is-invalid @enderror"
                            placeholder="Enter the login or id order" value="{{ $search ?? '' }}">
                        <input type="date" class="form-control" name="fdate" value="{{ $fdate ?? '' }}">

                        <input type="date" class="form-control" name="sdate" value="{{ $sdate ?? '' }}">

                        <span class="input-group-append">
                            <button type="submit" class="btn btn-info btn-flat">@lang('admin.btn.search')</button>
                        </span>
                        @error('search')
                        <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-hover table-bordered results">
            <thead>
                <tr>
                    <th>#</th>
                    <th>@lang('admin.orders.order.col1')</th>
                    <th>@lang('admin.orders.orders.name')</th>
                    <th>@lang('admin.orders.order.col2')</th>

                    <th>@lang('admin.orders.order.col3')</th>
                    <th>@lang('admin.orders.orders.last_update')</th>
                    {{-- <th>@lang('admin.orders.orders.server')</th> --}}
                    {{-- <th>@lang('admin.orders.orders.requested_date')</th> --}}
                    <th>Name Bank transfer</th>
                    <th>Reference Bank transfer</th>
                    <th>@lang('admin.orders.order.col5')</th>
                    <th>@lang('admin.orders.order.col6')</th>
                    <th></th>

                </tr>
                <tr class="warning no-result">
                    <td colspan="4"><i class="fa fa-warning"></i> @lang('admin.btn.noresults')</td>
                </tr>
            </thead>
            <tbody>
                @forelse($orderpackages as $orderpackage)
                <tr>
                    <th>{{ $orderpackage->id }}</th>
                    <th>{{ $orderpackage->user->login }}</th>
                    <td>{{ $orderpackage->user->name }}</td>
                    <td>{{ $orderpackage->reference }}</td>
                    <td>{{ number_format($orderpackage->price, 2, ',', '.') }}</td>
                    <th>{{ $orderpackage->updated_at }}</th>
                    <td>
                        @if (isset($orderpackage->id_transaction_banks))
                        <img src="{{ asset($orderpackage->transactionBank->logo) }}" alt="" width="100px">
                        <br>
                        {{ $orderpackage->transactionBank->name }}
                        @endif
                    </td>

                    <td>
                        @if (isset($orderpackage->id_transaction_banks))
                        {{ $orderpackage->id }}+{{ $orderpackage->user->login }}
                        @endif
                    </td>
                    <td>
                        @if ($orderpackage->status == 2)
                        <button class="btn btn-danger btn-sm m-0">@lang('admin.orders.orders.deactivated')</button>
                        @elseif($orderpackage->status == 1)
                        <button class="btn btn-success btn-sm m-0">@lang('admin.orders.orders.activated')</button>
                        @else
                        <button class="btn btn-warning btn-sm m-0" style="color: white">@lang('admin.orders.orders.pending')</button>
                        @endif
                    </td>
                    <td>
                        <button type="button" class="btn btn-primary btn-sm m-0" data-bs-toggle="modal"
                            data-bs-target="#changeModal{{ $orderpackage->id }}">
                            @lang('admin.btn.changestatus')
                        </button>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm m-0" data-bs-toggle="modal"
                            data-bs-target="#deleteModal{{ $orderpackage->id }}">
                            @lang('admin.orders.orders.delete')
                        </button>
                    </td>
                </tr>
                @empty
                <p>@lang('admin.orders.order.empty')</p>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer clearfix py-3">
        {{ $orderpackages->links() }}
    </div>
    {{-- <div class="row d-flex justify-content-center ">
      {{$orderpackages->links()}}
</div> --}}
</div>
<!-- Modal -->

@forelse($orderpackages as $orderpackage)
<div class="modal fade" id="changeModal{{ $orderpackage->id }}" tabindex="-1" aria-labelledby="changeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changeModalLabel">@lang('admin.orders.status.title') #{{ $orderpackage->id }}</h5>
                <button id='closeModal' type="button" class="btn btn-danger"
                    data-bs-dismiss="modal">@lang('admin.btn.close')</button>
            </div>
            <div class="modal-body">
                <form class="row g-3" action="{{ route('admin.packages.orderupdate', ['id' => $orderpackage->id]) }}"
                    method="POST" id="formData">
                    @csrf
                    @method('PUT')
                    <table class="table table-hover table-bordered responsive col-md-6">
                        <thead>
                            <tr>
                                <th scope="col"><b>@lang('admin.orders.status.col1')</th>
                                <th scope="col"><b>@lang('admin.orders.status.col2')</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th><b>@lang('admin.orders.status.col3'):</th>
                                <td>{{ $orderpackage->transaction_code }}</td>
                            </tr>
                            <tr>
                                <th><b>@lang('admin.orders.status.col4'):</th>
                                {{-- <th>{{isset($orderpackage->user) ? $orderpackage->user->name : $orderpackage->name}}</th> --}}
                            </tr>
                            <tr>
                                <th><b>@lang('admin.orders.status.col5'):</th>
                                <td>{{ isset($orderpackage->package) ? $orderpackage->package->name : $orderpackage->name }}</td>
                            </tr>
                            <tr>
                                <th><b>@lang('admin.orders.status.col6')</th>
                                <td>{{ number_format($orderpackage->price, 2, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th><b>@lang('admin.orders.status.col7')</th>
                                <td><b>wallet/api</td>
                            </tr>
                            <tr>
                                <th><b>@lang('admin.orders.status.col8')</th>
                                <td>{{ $orderpackage->printscreen }}</td>
                            </tr>
                            <tr>
                                <th><b>@lang('admin.orders.status.col9')</th>
                                <td>{{ date('h:i:s A , l jS \of F Y ') }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="col-md-6">
                        <div class="d-flex justify-content-between">
                            <label for="user_credit">
                                User credit
                            </label>
                            <div>
                                <h5>Credit: {{ $orderpackage->total_credit }}</h5>
                            </div>
                        </div>
                        <label for="payment_status">@lang('admin.orders.status.subtitle')</label>
                        <select id="payment_status" name="payment_status" class="form-control">

                            @if ($orderpackage->payment_status == 2)
                            <option value="0">@lang('admin.btn.pending')</option>
                            <option value="1">@lang('admin.btn.paid')</option>
                            <option value="2" selected>@lang('admin.btn.underpaid')</option>
                            @elseif($orderpackage->payment_status == 1)
                            <option value="0">@lang('admin.btn.pending')</option>
                            <option value="1" selected>@lang('admin.btn.paid')</option>
                            <option value="2">@lang('admin.btn.underpaid')</option>
                            @else
                            <option value="0" selected>@lang('admin.btn.pending')</option>
                            <option value="1">@lang('admin.btn.paid')</option>
                            <option value="2">@lang('admin.btn.underpaid')</option>
                            @endif

                        </select>

                        <label for="status">@lang('admin.orders.status.subtitle2')</label>
                        <select id="status" name="status" class="form-control">
                            @if ($orderpackage->status == 2)
                            <option value="2" selected>@lang('admin.btn.canceled')</option>
                            <option value="0">@lang('admin.btn.pending')</option>
                            <option value="1">@lang('admin.btn.paid')</option>
                            @elseif($orderpackage->status == 1)
                            <option value="1" selected>@lang('admin.btn.paid')</option>
                            <option value="0">@lang('admin.btn.pending')</option>
                            <option value="2">@lang('admin.btn.canceled')</option>
                            @else
                            <option value="0" selected>@lang('admin.btn.pending')</option>
                            <option value="1">@lang('admin.btn.paid')</option>
                            <option value="2">@lang('admin.btn.canceled')</option>
                            @endif

                        </select>
                        <input type="hidden" name="user_credit" id="user_credit" value="{{ $orderpackage->total_credit  }}">
                        <input type="hidden" name="pay_with_user_credit" id="pay_with_user_credit" value="no_pay">
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary mt-3">@lang('admin.orders.status.processed')</button>
                            @if(($orderpackage->payment_status == 0 || $orderpackage->payment_status == 2) && $orderpackage->total_credit >= $orderpackage->price)
                            <button type="button" class="btn btn-primary mt-3" onclick="payWithUserCredit()">Pay with user credit</button>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('admin.btn.close')</button>
            </div>
        </div>
    </div>
</div>
@empty
@endforelse

@forelse($orderpackages as $orderpackage)
<div class="modal fade" id="deleteModal{{ $orderpackage->id }}" tabindex="-1" aria-labelledby="deleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <form class="row g-3" action="{{ route('admin.packages.deleteOrderPackage') }}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{ $orderpackage->id }}">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">@lang('admin.orders.status.title') #{{ $orderpackage->id }}</h5>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('admin.btn.close')</button>
                    <button type="submit" class="btn btn-danger mt-3">Delete</button>
                </div>
            </div>
        </form>
    </div>
</div>
@empty
@endforelse

@stop
@section('css')
<link rel="stylesheet" href="{{ asset('/css/admin_custom.css') }}">
@stop
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
@section('js')
<script>
    function payWithUserCredit() {
        $('#pay_with_user_credit').val('pay')
        $('#formData').submit()
    }
    $(document).ready(function() {
        $(".search").keyup(function() {
            var searchTerm = $(".search").val();
            var listItem = $('.results tbody').children('tr');
            var searchSplit = searchTerm.replace(/ /g, "'):containsi('")

            $.extend($.expr[':'], {
                'containsi': function(elem, i, match, array) {
                    return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || "")
                        .toLowerCase()) >= 0;
                }
            });

            $(".results tbody tr").not(":containsi('" + searchSplit + "')").each(function(e) {
                $(this).attr('visible', 'false');
            });

            $(".results tbody tr:containsi('" + searchSplit + "')").each(function(e) {
                $(this).attr('visible', 'true');
            });

            var jobCount = $('.results tbody tr[visible="true"]').length;
            $('.counter').text(jobCount + ' item');

            if (jobCount == '0') {
                $('.no-result').show();
            } else {
                $('.no-result').hide();
            }
        });
    });
</script>
@stop
