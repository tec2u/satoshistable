@extends('layouts.header')
@section('content')
<style>
    .modal-backdrop {
        display: none !important;
    }
</style>
<main id="main" class="main">
    @include('flash::message')
    <section id="userpackageinfo" class="content">
        <div class="fade">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <h1>@lang('package.order_payment')</h1>
                        <div class="card shadow my-3">
                            <div class="card-header bbcolorp">
                                <h3 class="card-title"></h3>
                            </div>

                            <div class="col-6">
                                <br>
                                @if ($orderpackage->payment_status == 1)
                                <p>@lang('package.paid')</p>
                                @endif
                            </div>

                            <br>
                            <br>

                            <div class="col-12">
                                @if (count($banks) > 0 && ($orderpackage->package->project_id == 1 || auth()->user()->id != 1))
                                @if (isset($orderpackage->id_transaction_banks))
                                <p>Bank choosed to payment: <img src="{{ asset($orderpackage->transactionBank->logo) }}"
                                        alt="" width="100px"> <strong> {{ $orderpackage->transactionBank->name }}</strong></p>
                                @else
                                <p>Choose bank to payment:</p>
                                @endif
                                <select class="form-select" name="method" id="bankSelect" required>
                                    @if (isset($orderpackage->id_transaction_banks))
                                    <option value="" disabled selected>Select for details</option>
                                    <option value="{{ $orderpackage->transactionBank }}"
                                        data-name="{{ $orderpackage->transactionBank->name }}"
                                        data-logo="{{ asset($orderpackage->transactionBank->logo) }}"
                                        data-description="{{ htmlspecialchars($orderpackage->transactionBank->description) }}"
                                        data-multiplier="{{ $orderpackage->transactionBank->multiplicador_local  }}"
                                        data-description="{{ $orderpackage->transactionBank->description }}">>
                                        <img src="{{ asset($orderpackage->transactionBank->logo) }}" alt="" width="100px">
                                        {{ $orderpackage->transactionBank->name }}
                                    </option>
                                    @else
                                    <option value="" disabled selected>Select a bank</option>
                                    @foreach ($banks as $item)
                                    <option value="{{ $item->id }}" data-name="{{ $item->name }}"
                                        data-logo="{{ asset($item->logo) }}"
                                        data-coin="{{ $item->moeda_local }}"
                                        data-multiplier="{{ $item->multiplicador_local  }}"
                                        data-description="{{ htmlspecialchars($item->description) }}">
                                        {{ $item->name }}
                                    </option>
                                    @endforeach
                                    @endif
                                </select>

                                <!-- Botão que aparece somente após selecionar -->
                                <button type="button" class="btn btn-primary mt-3" id="openModalButton" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal" style="display: none;">
                                    View Details
                                </button>

                                <!-- Modal -->
                                @else
                                <div class="col-12">
                                    @if ($orderpackage->payment_status == 1)
                                    @lang('package.payed')
                                    @else
                                    @if (!isset($orderpackage->price_crypto) && isset($moedas))
                                    @lang('package.payment_message') {{ $orderpackage->price }}
                                    <br>
                                    <br>
                                    @foreach ($moedas as $chave => $valor)
                                    @lang('package.usd_in') <strong> {{ $chave }} ({{ $valor ?? '' }})</strong>
                                    <br>
                                    @endforeach
                                    @else
                                    @if (isset($wallet) && $orderpackage->payment_status != 2)
                                    @lang('package.payment_message') {{ $orderpackage->price }} @lang('package.usd_in')
                                    <strong>{{ $wallet->coin ?? '' }}
                                        ({{ $value_btc ?? '' }})</strong>
                                    @endif
                                    @endif
                                    @endif

                                    @if (
                                    $orderpackage->payment_status == 2 ||
                                    (!isset($wallet) && isset($orderpackage->price_crypto) && $orderpackage->payment_status == 0))
                                    @if (isset($moedas))
                                    @lang('package.payment_message') {{ $orderpackage->price }}
                                    <br>
                                    <br>
                                    @foreach ($moedas as $chave => $valor)
                                    @lang('package.usd_in') <strong> {{ $chave }} ({{ $valor ?? '' }})</strong>
                                    <br>
                                    @endforeach
                                    @endif


                                    <form action="{{ route('packages.payCryptoNode') }}" method="POST">
                                        @csrf
                                        <input type="hidden" value="{{ $orderpackage->id }}" name="id">
                                        @if (isset($moedas))
                                        @foreach ($moedas as $chave => $valor)
                                        <input type="hidden" value="{{ $valor }}" name="{{ $chave }}">
                                        @endforeach
                                        @endif

                                        <input type="hidden" value="{{ $orderpackage->price }}" name="price">
                                        <input type="hidden" value="1" name="retry">


                                        <select class="form-select" aria-label="Default select example" name="method" required>
                                            @if($orderpackage->package->project_id == 2)
                                                <option value="" selected>@lang('package.choose_method')</option>
                                                <option value="BITCOIN">BTC</option>
                                                <option value="TRX">TRX</option>
                                                <option value="USDT_TRC20">@lang('package.usdt') TRC20</option>
                                            @else
                                                <option value="USDT_ERC20">@lang('package.usdt') ERC20</option>
                                            @endif
                                        </select>
                                        <button type="submit" class="btn btn-success" style="margin-top: 1rem">@lang('package.retry')
                                            @lang('package.pay')</button>
                                    </form>
                                    @endif

                                    <br>

                                    @if (!isset($orderpackage->price_crypto) && $orderpackage->payment_status == 0)
                                    <form action="{{ route('packages.payCryptoNode') }}" method="POST">
                                        @csrf
                                        <input type="hidden" value="{{ $orderpackage->id }}" name="id">
                                        @if (isset($moedas))
                                        @foreach ($moedas as $chave => $valor)
                                        <input type="hidden" value="{{ $valor }}" name="{{ $chave }}">
                                        @endforeach
                                        @endif
                                        <input type="hidden" value="{{ $orderpackage->price }}" name="price">

                                        <select class="form-select" aria-label="Default select example" name="method" required>
                                            @if($orderpackage->package->project_id == 2)
                                                <option value="" selected>@lang('package.choose_method')</option>
                                                <option value="BITCOIN">BTC</option>
                                                <option value="TRX">TRX</option>
                                                <option value="USDT_TRC20">@lang('package.usdt') TRC20</option>
                                            @else
                                                <option value="USDT_ERC20">@lang('package.usdt') ERC20</option>
                                            @endif
                                        </select>
                                        <button type="submit" class="btn btn-success" style="margin-top: 1rem">Choose</button>
                                    </form>
                                    @else
                                    @if ($orderpackage->payment_status != 2)
                                    <button type="button" class="btn btn-warning" style="color:white" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">
                                        See wallet
                                    </button>
                                    @endif
                                    @endif
                                </div>
                                @endif
                            </div>


                            </br></br>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@if (isset($wallet) && isset($wallet->address) && $orderpackage->payment_status != 2)
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">


                @php
                $img = '';

                if ($wallet->coin == 'BITCOIN') {
                $img = 'https://cryptologos.cc/logos/bitcoin-btc-logo.png?v=029';
                }
                if ($wallet->coin == 'TRX') {
                $img = 'https://cryptologos.cc/logos/tron-trx-logo.png?v=029';
                }
                if ($wallet->coin == 'ETH') {
                $img = 'https://cryptologos.cc/logos/ethereum-eth-logo.png?v=029';
                }
                if ($wallet->coin == 'USDT_TRC20') {
                $img =
                'https://images.ctfassets.net/77lc1lz6p68d/5Z7vveK1yJ7rDvX9K5ywJa/cfa5f74c313594a5a75652f98678578a/tether-usdt-trc20.svg';
                }
                if ($wallet->coin == 'USDT_ERC20') {
                $img = 'https://cryptologos.cc/logos/tether-usdt-logo.png?v=029';
                }

                @endphp
                {{ $wallet->address }}

                <h1 class="modal-title fs-5" id="exampleModalLabel">@lang('package.choose_method') {{ $wallet->coin ?? '' }} <img
                        src='{{ $img }}' style='width:20px'></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <strong>@lang('package.price_in') {{ $wallet->coin ?? '' }}:</br> <span style=" font-size: 50px;">
                        {{ $orderpackage->price_crypto ?? '' }} <img src='{{ $img }}'
                            style='width:20px'></br></strong>
                <br>
                <strong>@lang('package.price_in_usd'): {{ $orderpackage->price ?? '' }}</strong>
                <br>
                <br>
                <input type="text" class="form-control" id="landing" value="{{ $wallet->address ?? '' }}">
                <button class=" btn btn-dark orderbtn linkcopy px-4" type="button"
                    onclick="FunctionCopy1()">@lang('package.copy')</button>
                {{-- <strong>@lang('package.wallet_address'): {{ $wallet->address ?? '' }}</strong> --}}
                <br><br>
                <div class="card-body table-responsive p-0 col-6">
                    <img src='https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ $wallet->address ?? '' }}'>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('package.close')</button>

                </br>
                @lang('package.gateway_note')</br>

                {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
            </div>
        </div>
    </div>
</div>
@else

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalTitle">Bank Details</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <img id="imgBank" src="" alt="" style="width: 250px;margin:0 auto;">
            <div class="modal-body" id="modalBody">
                Please select a bank to view its details.
            </div>

            <div>
                Coin: <span id="coin-type" class="mr-2"></span>: <strong id="price-final"></strong>
            </div>
            <form action="{{ route('packages.payCryptoNode') }}" method="POST" id="formChooseBank">
                @csrf
                <input type="hidden" value="{{ $orderpackage->id }}" name="id">
                <input type="hidden" value="{{ $orderpackage->price }}" name="price" id="price_order">
                <!-- Este campo será atualizado com o banco selecionado -->
                <input type="hidden" id="bankInput" value="" name="bank">
            </form>

            <div class="modal-footer">
                <div class="alert alert-danger" role="alert">
                    Please use the reference code on your deposit:

                    <strong>{{ $orderpackage->id }}+{{ $user->login }}</strong>
                </div>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                @if (!isset($orderpackage->id_transaction_banks))
                <button type="submit" class="btn btn-success" form="formChooseBank">Confirm</button>
                @endif
            </div>
        </div>
    </div>
</div>
@endif
<script>
    // Captura o botão e o select
    const bankSelect = document.getElementById('bankSelect');
    const openModalButton = document.getElementById('openModalButton');
    const modalTitle = document.getElementById('modalTitle');
    const modalBody = document.getElementById('modalBody');
    const bankInput = document.getElementById('bankInput');
    const imgBank = document.getElementById('imgBank');

    // Evento ao alterar o select
    bankSelect.addEventListener('change', () => {
        const selectedOption = bankSelect.options[bankSelect.selectedIndex];

        // Mostra o botão somente se houver um banco selecionado
        if (selectedOption && selectedOption.value) {
            openModalButton.style.display = 'block';
        } else {
            openModalButton.style.display = 'none';
        }
    });

    // Evento ao clicar no botão
    openModalButton.addEventListener('click', () => {
        const selectedOption = bankSelect.options[bankSelect.selectedIndex];

        if (selectedOption && selectedOption.value) {
            // Atualiza o título e o corpo do modal com as informações do item selecionado
            const bankName = selectedOption.getAttribute('data-name');
            const bankDescription = selectedOption.getAttribute('data-description');
            const banklogo = selectedOption.getAttribute('data-logo');
            const bankMultiplier = selectedOption.getAttribute('data-multiplier');
            const bankCoin = selectedOption.getAttribute('data-coin');

            let priceInput = document.getElementById('price_order')
            let coinType = document.getElementById('coin-type')
            let finalPrice = document.getElementById('price-final')

            coinType.textContent = bankCoin
            finalPrice.textContent = parseFloat(priceInput.value) * parseFloat(bankMultiplier)
            priceInput.value = parseFloat(priceInput.value) * parseFloat(bankMultiplier)
            modalTitle.textContent = `Bank Details: ${bankName}`;
            modalBody.innerHTML = bankDescription; // Processa o HTML do description

            // Atualiza o campo oculto no formulário com o ID do banco selecionado
            bankInput.value = selectedOption.value;

            imgBank.src = banklogo;
        } else {
            // Caso nada esteja selecionado
            modalTitle.textContent = 'No bank selected';
            modalBody.textContent = 'Please select a bank to view its details.';
        }
    });
</script>

<script>
    function FunctionCopy1() {

        var copyText = document.getElementById("landing");


        copyText.select();
        copyText.setSelectionRange(0, 99999); // For mobile devices

        navigator.clipboard.writeText(copyText.value);

        // alert("Copied the text: " + copyText.value);
    }
</script>
@endsection
