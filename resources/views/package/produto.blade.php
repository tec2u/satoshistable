@extends('layouts.header')
@section('content')
<main id="main" class="main">
    @include('flash::message')
    <section id="produto" class="content">
        <div class="fade">
            <div class="container-fluid">
                <div class="row justify-content-evenly">
                    @if ($package->type == 'kit')
                    Packages Kit
                    @foreach($packagesByKit as $itemKit)
                    <div class="card shadow " style="width: 28rem;">

                        <img src='{{ asset($itemKit->img) }}' class="card-img-top" alt="...">

                        <div class="card-body">
                            <h5 class="card-title">{{ $itemKit->name }}</h5>
                        </div>
                        {!! htmlspecialchars($itemKit->long_description, ENT_QUOTES, 'UTF-8', false) !!}
                    </div>
                    @endforeach
                    <div class="card-body">
                            @if ($itemKit->plan_id == null)
                            <a onclick="confirmPlan()" class="btn btn-primary rounded-pill m-4">@lang('package.subscribe_now')</a>
                            <script>
                                function confirmPlan() {
                                    if (confirm("You just selected the {!! $package->name !!} plan, is that correct?")) {
                                        location.href = "{!! route('payment.subscriptionClub', ['package' => $package->id]) !!}";
                                    } else {
                                        alert("Please go back and choose the correct plan!");
                                        history.go(-1);
                                    }
                                }
                            </script>
                            @endif
                        </div>
                    @else
                    <div class="card shadow " style="width: 28rem;">

                        <img src='{{ asset($package->img) }}' class="card-img-top" alt="...">

                        <div class="card-body">
                            <h5 class="card-title">{{ $package->name }}</h5>
                        </div>
                        {!! htmlspecialchars($package->long_description, ENT_QUOTES, 'UTF-8', false) !!}

                        <div class="card-body">
                            @if ($package->plan_id == null)
                            <a onclick="confirmPlan()" class="btn btn-primary rounded-pill m-4">@lang('package.subscribe_now')</a>
                            <script>
                                function confirmPlan() {
                                    if (confirm("You just selected the {!! $package->name !!} plan, is that correct?")) {
                                        location.href = "{!! route('payment.subscriptionClub', ['package' => $package->id]) !!}";
                                    } else {
                                        alert("Please go back and choose the correct plan!");
                                        history.go(-1);
                                    }
                                }
                            </script>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
