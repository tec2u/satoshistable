@extends('adminlte::page')
@section('title', 'Packages')

@section('content_header')
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1> @lang('admin.orders.admin_order')</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">
              @lang('admin.orders.admin_order')
            </a></li>
          <li class="breadcrumb-item active">
            {{-- @lang('admin.package.subtitle2') --}}
            @lang('admin.orders.admin_order')
          </li>
        </ol>
      </div>
    </div>
  </div>
@stop

@section('content')
  @include('flash::message')
  <div class="row d-flex justify-content-center ">
    <div class="col-lg-6">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">
            {{-- @lang('admin.unilevel.titlecreate2') --}}
            @lang('admin.orders.admin_order')
          </h3>
        </div>
        <form action=" {{ route('admin.order-admin.payment.admin') }} " method="POST" enctype="multipart/form-data">
          <div class="card-body">
            @csrf
            <div class="form-group">
              <label for="level">
              @lang('admin.orders.username')
                <span class="text-danger">*</span>
              </label>
              <input type="text" class="form-control form-control-lg @error('username') is-invalid @enderror"
                id="username" name="username" value="{{ old('username') }}" required>
              @error('username')
                <span class="error invalid-feedback">{{ $message }}</span>
              @enderror
            </div>

            <div class="form-group">
              <label for="level">
              @lang('admin.orders.package')
                <span class="text-danger">*</span>
              </label>

              <select name="package" id="" required
                class="form-control form-control-lg @error('package') is-invalid @enderror" onchange="getPrice(this)">
                <option value=""  disabled> @lang('admin.orders.choose_package')</option>
                @foreach ($packages as $package)
                  <option value=" {{ $package->id }} " data-value="{{ $package->price }} "

                  @if( $package->price == 0)
                    selected=selected
                  @endif

                  > {{ $package->name }} - $
                    {{ number_format($package->price, 2, ',', '.') }}</option>
                @endforeach
              </select>

              @error('package')
                <span class="error invalid-feedback">{{ $message }}</span>
              @enderror
            </div>


            <div class="form-group" id="price-status">
              <label for="price">
              @lang('admin.orders.new_price')
              </label>
              <input type="number" class="form-control form-control"
                id="price" name="price_new" value="{{ old('price') }}">
              @error('price')
                <span class="error invalid-feedback">{{ $message }}</span>
              @enderror
            </div>


            <div class="form-group">


              <input type='hidden' name="payment" id="" value="USDT">


              @error('payment')
                <span class="error invalid-feedback">{{ $message }}</span>
              @enderror
            </div>

          </div>

      </div>
      <div class="card-footer text-right">
        <button type="submit" class="btn brn-lager btn-success">@lang('admin.unilevel.register')</button>
      </div>
      </form>
    </div>
  </div>


@stop

@section('js')

@stop
