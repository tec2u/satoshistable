@extends('layouts.header')
@section('content')
<main id="main" class="main">
    @include('flash::message')
    <section id="cart" class="content">
        <div class="fade">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <h1 class="up font">Cart</h1>
                        <div class="card shadow my-3">
                            <div class="card-header bbcolorp">
                                <h3 class="card-title">Cart items</h3>
                            </div>

                            <div class="card-body table-responsive p-0">
                                @php
                                $items = [];
                                $packageID = 0;
                                @endphp
                                @if($cartActivatorItems->isNotEmpty())
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th cols=2>
                                                Activator Plan
                                            </th>
                                        </tr>
                                        <tr class="font up">
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Price</th>
                                            <th>Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($cartActivatorItems as $cartItem)
                                        @php
                                        $packageID = $cartItem->package_id;
                                        @endphp
                                        <tr>
                                            <td>
                                                {{ $cartItem->package->name }}
                                            </td>
                                            <td>
                                                {!! $cartItem->package->long_description !!}
                                            </td>
                                            <td>
                                                {{ $cartItem->price }}
                                            </td>
                                            <td>
                                                <a href="{{ route('cart.destroy', ['id' => $cartItem->id]) }}"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @endif
                                @php

                                @endphp
                                @if($cartItems->isNotEmpty())
                                <table class="table table-hover text-nowrap mt-3">
                                    <thead>
                                        <tr>
                                            <th cols=2>
                                                More Packages
                                            </th>
                                        </tr>
                                        <tr class="font up">
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Price</th>
                                            <th>Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($cartItems as $cartItem)
                                        @php
                                        $items[] = $cartItem->package_id;
                                        @endphp
                                        <tr>
                                            <td>
                                                {{ $cartItem->package->name }}
                                            </td>
                                            <td>
                                                {{ $cartItem->package->long_description }}
                                            </td>
                                            <td>
                                                {{ $cartItem->price }}
                                            </td>
                                            <td>
                                                <a href="{{ route('cart.destroy', ['id' => $cartItem->id]) }}"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @endif
                                <form method="POST" action="{{ route('payment.createActivatorOrder') }}" id="formData" class="p-2 d-flex align-items-center justify-content-between">
                                    <a class="btn btn-outline-danger" href="{{ route('packages.activation_packages') }}">Continue shopping</a>
                                    @csrf
                                    <input type="hidden" name="otherPackagesIDs" value="{{ json_encode($items) }}">
                                    <input type="hidden" name="packageID" id="packageID" value="{{ $packageID }}">
                                    <div class="d-flex align-items-center">
                                        <div class="mr-2">Total: {{ $total }}</div>
                                        <button type="button" class="btn btn-outline-primary" onclick="verifyDataAndSendForm()">CREATE ORDER</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
    </section>
</main>

<script>
    function verifyDataAndSendForm() {
        console.log($('#packageID').val())
        if ($('#packageID').val() == 0) {
            alert('You cannot purchase other packages without an activation plan.')
            return false
        }
        document.getElementById('formData').submit()
    }
</script>
@endsection
