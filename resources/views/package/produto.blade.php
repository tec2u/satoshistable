@extends('layouts.header')
@section('content')
<main id="main" class="main">
    @include('flash::message')

    <section id="produto" class="content">
        <div class="fade">
            <div class="container-fluid">
                <div class="row justify-content-evenly">
                    @if ($package->type == 'kit')
                    <form id="redirectForm" action="/payment/subscriptionKit" method="POST" style="display: none;">
                        @csrf <!-- O token CSRF do Laravel -->
                        <input type="hidden" name="itemsKit" id="itemsKit">
                        <input type="hidden" name="packageID" value="{{ $package->id }}">
                    </form>
                    <div class="text-center">
                        <h3><strong>Packages Kit</strong></h3>
                    </div>
                    @foreach($packagesByKit as $itemKit)
                    <div class="card shadow ">

                        <img src='{{ asset($itemKit->img) }}' class="card-img-top" alt="...">

                        <div class="card-body flex-column">
                            <div>{{ $itemKit->name }}</div>
                            <div>
                                Price: {{ $itemKit->price }} <input type="checkbox" value="{{ $itemKit->id }}" class="items-kit" name="itemKit[]" id="item_{{ $itemKit->id }}" onclick="selectItem()"> <label for="item_{{ $itemKit->id }}" class="mb-0 ml-1">Select</label>
                            </div>
                        </div>

                        {!! htmlspecialchars($itemKit->long_description, ENT_QUOTES, 'UTF-8', false) !!}
                    </div>
                    @endforeach
                    <div class="card-body">
                        <a onclick="confirmKitPlan()" class="btn btn-primary rounded-pill m-4">@lang('package.subscribe_now')</a>
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
    let itemsKit = [];

    function selectItem() {
        itemsKit = []
        $('.items-kit').each((index, element) => {
            if (element.checked) {
                itemsKit.push(element.value)
            }
        })
    }

    function confirmKitPlan() {
        selectItem();

        if (itemsKit.length === 0) {
            alert("Por favor, selecione ao menos um item.");
            return;
        }

        document.getElementById('itemsKit').value = JSON.stringify(itemsKit);

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
