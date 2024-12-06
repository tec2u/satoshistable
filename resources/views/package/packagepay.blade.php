@extends('layouts.header')
@section('content')
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

                <div>

                  <div class="card-header py-3">

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
                  </br>

                  </br></br>
                </div>
                <div class="col-6">
                  @lang('package.payment_message') {{ $orderpackage->price }} @lang('package.usdt') TRC20
                  {{-- TUxXULa6Gt3oAAFvE3v2eCEZZFyyqCojXF --}}
                  {{-- <div class="card-body table-responsive p-0 col-6">
                    <img src='https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=TUxXULa6Gt3oAAFvE3v2eCEZZFyyqCojXF'>
                                    </div> --}}
                  <br>
                  {{-- @if (auth()->user()->id != 1 && auth()->user()->id != 115876) --}}
                  @if (1 == 2)
                    @if ($orderpackage->payment_status == 0)
                      <form action="{{ route('packages.payCrypto') }}" method="POST">
                        @csrf
                        <input type="hidden" value="{{ $orderpackage->id }}" name="id">
                        <input type="hidden" value="{{ $orderpackage->price }}" name="price">
                        <select class="form-select" aria-label="Default select example" name="method" required>
                          <option value="" selected>@lang('package.choose_method')</option>
                          {{-- <option value="BTC">@lang('package.btc')</option> --}}
                          <option value="TRC20">@lang('package.usdt') TRC20</option>
                        </select>
                        <button type="submit" class="btn btn-success" style="margin-top: 1rem">@lang('package.pay')</button>
                      </form>
                    @endif

                    @if ($orderpackage->payment_status == 2)
                      <p>@lang('package.expired')</p>
                      <br>
                      <form action="{{ route('packages.payCrypto') }}" method="POST">
                        @csrf
                        <input type="hidden" value="{{ $orderpackage->id }}" name="id">
                        <input type="hidden" value="{{ $orderpackage->price }}" name="price">
                        <select class="form-select" aria-label="Default select example" name="method" required>
                          <option value="" selected>@lang('package.choose_method')</option>
                          {{-- <option value="BTC">@lang('package.btc')</option> --}}
                          <option value="TRC20">@lang('package.usdt') TRC20</option>
                        </select>
                        <button type="submit" class="btn btn-success"
                          style="margin-top: 1rem">@lang('package.retry')</button>
                      </form>
                    @endif
                  @endif

                  @if ($orderpackage->payment_status == 1)
                    <p>@lang('package.paid')</p>
                  @endif
                </div>

                <br>
                <br>
                @if (1 == 1)
                  {{-- @if (auth()->user()->id == 1 || auth()->user()->id == 115876) --}}
                  {{-- <p><strong>@lang('package.test')</strong></p> --}}

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
                        {{-- <input type="hidden" value="{{ $wallet->coin }}" name="method"> --}}


                        <select class="form-select" aria-label="Default select example" name="method" required>
                          <option value="" selected>@lang('package.choose_method')</option>
                          {{-- <option value="BITCOIN">BTC</option> --}}
                          {{-- <option value="USDT_ERC20">USDT ERC20</option> --}}
                          <option value="TRX">TRX</option>
                          {{-- <option value="ETH">ETH</option> --}}
                          <option value="USDT_TRC20">@lang('package.usdt') TRC20</option>
                        </select>
                        <button type="submit" class="btn btn-success" style="margin-top: 1rem">@lang('package.retry')
                          @lang('package.pay')</button>
                      </form>
                    @endif

                    {{-- TUxXULa6Gt3oAAFvE3v2eCEZZFyyqCojXF --}}
                    {{-- <div class="card-body table-responsive p-0 col-6">
                                    <img src='https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=TUxXULa6Gt3oAAFvE3v2eCEZZFyyqCojXF'>
                                </div> --}}
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
                          <option value="" selected>@lang('package.choose_method')</option>
                          {{-- <option value="BITCOIN">@lang('package.btc')</option> --}}
                          {{-- <option value="USDT_ERC20">@lang('package.usdt') ERC20</option> --}}
                          <option value="TRX">TRX</option>
                          {{-- <option value="ETH">ETH</option> --}}
                          <option value="USDT_TRC20">@lang('package.usdt') TRC20</option>
                        </select>
                        <button type="submit" class="btn btn-success" style="margin-top: 1rem">Choose</button>
                      </form>
                    @else
                      @if ($orderpackage->payment_status != 2)
                        {{-- <br> --}}
                        {{-- <button type="button" class="btn btn-warning" style="margin-top: 1rem; color:white">Pending</button> --}}
                        <button type="button" class="btn btn-warning" style="color:white" data-bs-toggle="modal"
                          data-bs-target="#exampleModal">
                          See wallet
                        </button>
                      @endif
                    @endif
                  </div>

                @endif
                </br></br>


              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    @if (isset($wallet) && isset($wallet->address) && $orderpackage->payment_status != 2)
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
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
    @endif
  </main>

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
