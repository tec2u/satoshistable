@extends('adminlte::page')
@section('title', 'Packages')

@section('content_header')
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Banks</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('admin.package.subtitle')</a></li>
        </ol>
      </div>
    </div>
  </div>
@stop

@section('content')
  @include('flash::message')
  <div class="card card-solid">
    <div class="card-header">
      <div class="row">
        <div class="col-sm-12 col-md-4">
          <div class="text-left">
            <a href="{{ route('admin.banks.create') }}" class="btn btn-lg bg-success">
              <i class="fas fa-plus-circle"></i> Create
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="card-body pb-0">
      <div class="row">
        @forelse($banks as $bank)
          <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
            <div class="card bg-light d-flex flex-fill">
              <div class="card-header text-muted border-bottom-0">
                {{ $bank->name }}
              </div>
              <div class="card-body pt-0">
                <img src="{{ asset($bank->logo) }}" alt="package-cover" class="img-fluid">
                <hr>
                {{-- {!! $bank->long_description !!} --}}
                {!! htmlspecialchars($bank->description, ENT_QUOTES, 'UTF-8', false) !!}

                <div class="row pt-2">
                  <div class="col-12">
                    <p class="text-muted">
                      @if ($bank->activated)
                      <span class="badge badge-success right"> @lang('admin.package.statusAc') </span> @else<span
                          class="badge badge-danger right"> @lang('admin.package.statusDe') </span>
                      @endif
                    </p>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <div class="row justify-content-between">
                  <div class="text-right">
                    <form action="{{ route('admin.banks.delete', ['id' => $bank->id]) }}" method="post">
                      <a href="{{ route('admin.banks.edit', ['id' => $bank->id]) }}" class="btn bg-teal"
                        title="@lang('admin.package.edit')">
                        <i class="fas fa-edit"></i>
                      </a>
                      @csrf
                      <button type="submit" class="btn btn-danger" title="@lang('admin.package.delete')"><i
                          class="fas fa-trash-alt"></i></button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @empty
          <p>@lang('admin.package.empty')</p>
        @endforelse
      </div>
    </div>
    <div class="row d-flex justify-content-center ">
      {{ $banks->links() }}
    </div>
  </div>
@stop

@section('js')
  <script>
    $('#flash-overlay-modal').modal();
  </script>
  <script>
    $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
  </script>
@stop
