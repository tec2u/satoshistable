@extends('layouts.header')
@section('content')

<main id="main" class="main">
    <section id="poolcommission" class="content">
        <div class="fade">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <h1>
                            Pay with credit
                        </h1>
                        <div class=" my-3">
                            @if ($errors->has('error'))
                            <div class="alert alert-danger">
                                {{ $errors->first('error') }}
                            </div>
                            @endif
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">
                                    Pay order with credit
                                </h3>
                                <h4>Total credit: {{ auth()->user()->totalCredit() }}</h4>
                            </div>
                            <div class="row d-flex justify-content-center">
                                <form class="col-6 my-4 d-flex" method="POST" action="{{ route('packages.pay_order') }}">
                                    @csrf
                                    <input type="number" class="form-control" name="order_id" placeholder="Insert id order to pay">
                                    <button class="btn btn-primary" type="submit">Pay</button>
                                </form>
                            </div>
                        </div>
</main>

@endsection
