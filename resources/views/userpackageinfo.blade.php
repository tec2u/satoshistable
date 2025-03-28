@extends('layouts.header')
@section('content')
<main id="main" class="main">
    @include('flash::message')
    <style>
        .bubble {
            color: #000000;
            padding: 5px 10px;
            font-size: 14px;
            margin: 5px;
        }

        .hidden-list {
            display: none;
        }
    </style>
    <section id="userpackageinfo" class="content">
        <div class="fade">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <h1>@lang('header.orders')</h1>
                        <div class="card shadow my-3">
                            <div class="card-header bbcolorp">
                                <h3 class="card-title" style="float: none;">@lang('purchase.order.li1')</h3>
                            </div>
                            <div class="card-header py-3">
                                <!-- <button type="button" class="btn btn-info btn-sm rounded-pill" style="width: 80px;">CSV</button>
                                    <button type="button" class="btn btn-success btn-sm rounded-pill" style="width: 80px;">Excel</button>
                                    <button type="button" class="btn btn-danger btn-sm rounded-pill" style="width: 80px;">PDF</button> -->
                                <div class="card-tools">
                                    <div class="input-group input-group-sm my-1" style="width: 250px;">
                                        <input type="text" name="table_search" class="form-control float-right rounded-pill pl-3"
                                            placeholder="@lang('package.search')">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="bi bi-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>@lang('package.name')</th>
                                            <th>@lang('package.order_id')</th>
                                            <th>@lang('package.package_price')</th>
                                            <th>@lang('package.date')</th>
                                            <th>@lang('package.payment_status')</th>
                                            <th>@lang('package.hide')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($orderpackages as $orderpackage)
                                        <tr class="{{ !$orderpackage->package_id ? 'order-row': '' }}" data-id="{{ $orderpackage->id }}">
                                            <th>
                                                @if (!$orderpackage->package_id)
                                                {{ '⬇  '.$orderpackage->reference ?? '' }}
                                                @else
                                                {{ $orderpackage->package->name ?? '' }}
                                                @endif
                                            </th>
                                            <td>{{ $orderpackage->id }}</td>
                                            <td>$ {{ $orderpackage->price }}</td>
                                            <td>{{ date('d/m/Y', strtotime($orderpackage->created_at)) }}</td>
                                            <td>
                                                @if ($orderpackage->payment_status == 1)
                                                <span class="rounded-pill bg-success px-4 py-1">@lang('package.paid')</span>
                                                @elseif($orderpackage->payment_status == 2)
                                                <span class="rounded-pill bg-warning px-4 py-1">@lang('package.cancelled')</span>
                                                @else
                                                <span class="rounded-pill bg-primary px-4 py-1">@lang('package.waiting')</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($orderpackage->payment_status != 1)
                                                <button class="btn rounded-pill px-bg-success4 py-1">
                                                    <a href="{{ route('packages.packagepay', ['id' => $orderpackage->id]) }}" style="color: #000000;">PAY</a>
                                                </button>
                                                <button class="btn rounded-pill bg-info px-4 py-1">
                                                    <a href="{{ route('packages.hide', ['id' => $orderpackage->id]) }}">@lang('package.btn_hide')</a>
                                                </button>
                                                @endif
                                            </td>
                                        </tr>

                                        <!-- Sublista oculta com os outros pacotes -->
                                        <tr class="sublist" id="sublist-{{ $orderpackage->id }}" style="display: none;">
                                            <td colspan="6">
                                                @if($orderpackage->activator_package)
                                                <div class="mb-1">
                                                    <div>Activator package</div>
                                                    <ul class="pl-0">
                                                        @foreach ($orderpackage->activator_package as $package)
                                                        <li style="list-style-type: none;">➡ package: {{ $package->name }} - price: {{ $package->price }} </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                <hr>
                                                <div>
                                                    <div>Additional packages</div>
                                                    <ul class="pl-0">

                                                        @foreach ($orderpackage->other_packages as $package)
                                                        <li style="list-style-type: none;">➡ package: {{ $package->name }} - price: {{ $package->price }} </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                @endif
                                            </td>
                                        </tr>
                                        @empty
                                        <p>@lang('package.any_packages_registered')</p>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer clearfix py-3">
                                {{ $orderpackages->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".order-row").forEach(function(row) {
            row.addEventListener("click", function() {
                let orderId = row.getAttribute("data-id");
                let sublist = document.getElementById("sublist-" + orderId);

                if (sublist.style.display === "none") {
                    sublist.style.display = "table-row";
                } else {
                    sublist.style.display = "none";
                }
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        var target = document.querySelector('#minting-nav');
        var collapse = new bootstrap.Collapse(target);
        collapse.show();
    });
</script>
@endsection
