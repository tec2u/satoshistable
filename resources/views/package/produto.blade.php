@extends('layouts.header')
@section('content')
<main id="main" class="main">
    @include('flash::message')

    <section id="produto" class="content">
        <div class="fade">
            <div class="container-fluid">
                <div class="row justify-content-evenly">
                    @if ($package->type == 'activator')
                    <form id="redirectForm" action="{{ route('cart.store') }}" method="POST" style="display: none;">
                        @csrf <!-- O token CSRF do Laravel -->
                        <input type="hidden" name="othersPackagesIDs" id="othersPackagesIDs">
                        <input type="hidden" name="packageID" value="{{ $package->id }}">
                    </form>

                    <div class="text-center">
                        <h3>You chose <strong style="font-family: 'Poppins' !important;">Activator package {{ $package->name }} - $ {{ $package->price }}</strong></h3> <br/>
                        <h5>Choose others packages</h5>
                    </div>
                    @foreach($othersPackages as $additionalPackage)
                    <div class="card shadow ">

                        <img src='{{ asset($additionalPackage->img) }}' class="card-img-top" alt="...">

                        <div class="card-body flex-column">
                            <div>{{ $additionalPackage->name }}</div>
                            <div>
                                Price: {{ $additionalPackage->price }} <input type="checkbox" value="{{ $additionalPackage->id }}" class="items-activator" name="additionalPackage[]" id="item_{{ $additionalPackage->id }}" onclick="selectItem()"> <label for="item_{{ $additionalPackage->id }}" class="mb-0 ml-1">Select</label>
                            </div>
                        </div>

                        {!! htmlspecialchars($additionalPackage->long_description, ENT_QUOTES, 'UTF-8', false) !!}
                    </div>
                    @endforeach
                    <div class="card-body">
                        <a onclick="confirmActivatorPlan()" class="btn btn-primary rounded-pill m-4">@lang('package.subscribe_now')</a>
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
<script>
    let othersPackagesIDs = [];

    function selectItem() {
        othersPackagesIDs = []
        $('.items-activator').each((index, element) => {
            if (element.checked) {
                othersPackagesIDs.push(element.value)
            }
        })
    }

    function confirmActivatorPlan() {
        selectItem();
        
        document.getElementById('othersPackagesIDs').value = JSON.stringify(othersPackagesIDs);

        document.getElementById('redirectForm').submit();
    }

    function confirmPlan() {
        if (confirm("You just selected the {!! $package->name !!} plan, is that correct?")) {
            location.href = "{!! route('payment.subscriptionClub', ['package' => $package->id]) !!}";
        } else {
            alert("Please go back and choose the correct plan!");
            history.go(-1);
        }
    }
</script>
@endsection
