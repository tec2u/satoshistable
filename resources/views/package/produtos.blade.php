@extends('layouts.header')
@section('content')
  <main id="main" class="main">
    @include('flash::message')
    <section id="produtos" class="content">
      <div class="fade">
        <div class="container-fluid">
          <h1>@lang('package.products')</h1>
          <div class="container">
            <div class="row">
              @forelse($packages as $package)
                <div class="col-sm-4 card-deck hover ">
                  <div class="card ">
                    <img src='{{ asset($package->img) }}' class="card-img-top" alt="...">
                    <h5 class="card-title">{{ $package->name }}</h5>
                    {{-- <h6 class="card-title">$ {{ $package->price }}</h6> --}}
                    <h6 class="card-body">
                      {!! htmlspecialchars($package->long_description, ENT_QUOTES, 'UTF-8', false) !!}

                      {{-- {!! $package->long_description !!} --}}
                    </h6>
                    <div class="card-body">

                      <a href="{{ route('packages.detail', ['id' => $package->id]) }}"
                        class="btn btn-primary m-4 rounded-pill"> @lang('package.details')</a>
                    </div>
                  </div>
                </div>

              @empty
                <p>@lang('package.any_products_registered')</p>
              @endforelse

            </div>
            <div class="card-footer clearfix py-3">
              {{ $packages->links() }}
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection
