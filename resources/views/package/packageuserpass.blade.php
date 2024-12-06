@extends('layouts.header')
@section('content')
  <main id="main" class="main">
    @include('flash::message')
    <section id="password" class="content">
      <div class="fade">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <h1>@lang('package.mt4_server_config')</h1>
              @if (session('error'))
                <div class="alert alert-danger">
                  {{ session('error') }}
                </div>
              @endif
              <div class="card shadow my-3">
                <div class="card-header bbcolorp">
                  <h3 class="card-title">@lang('package.input_login_details')</h3>
                </div>
                @php
                  $user_id = ucwords(auth()->user()->id);
                  $pedido = Illuminate\Support\Facades\DB::select(
                      'SELECT *  FROM orders_package where id=? and user_id=?',
                      [$orderpackage->id, $user_id],
                  );

                  if (!isset($pedido)) {
                      echo '<script>
                        window.location = "/home";
                      </script>';
                  }
                @endphp
                <form class="row gx-3 gy-2 align-items-center p-5"
                  action="{{ route('packages.change_userpassword', ['id' => $orderpackage->id]) }}" method="POST"
                  enctype="multipart/form-data">
                  @csrf
                  @method('POST')
                  <div class="col-md-4">
                    <input type="text" class="form-control" id="old_password" name="login_number"
                      placeholder="@lang('package.login_number')" value="{{ $pedido[0]->{'user'} }}">
                  </div>
                  <div class="col-md-4">
                    <div class="input-group">
                      <input type="text" class="form-control" id="password" name="login_password"
                        placeholder="@lang('package.login_password')" value="{{ $pedido[0]->{'pass'} }}">
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="input-group">
                      <input type="text" class="form-control" id="server" name="server"
                        placeholder="@lang('package.server')" value="{{ $pedido[0]->{'server'} }}">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="input-group">
                      PrintScreen of the server configuration email: </br>
                      <input type="file" name="image" id="image" class="form-control" accept="image/*">
                    </div>
                  </div>
                  </br></br>
                  <div class="col-md-12">
                    <img src="/images/printscreen/{{ $pedido[0]->{'printscreen'} }}" alt="@lang('package.profile')"
                      style='max-width:500px'>
                  </div>
                  <div class="col-md-12 mt-5">
                    <button type="submit" class="btn btn-primary rounded-pill">
                      @lang('package.update_mt4_account')
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <script>
    $(window).load(function() {
      $('#flash-overlay-modal').modal('show');
    });

    $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
  </script>
@endsection
