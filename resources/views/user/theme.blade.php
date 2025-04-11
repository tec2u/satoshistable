@extends('layouts.header')
@section('content')
  <main id="main" class="main">
    @include('flash::message')
    <section id="password" class="content">
      <div class="fade">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <h1 class="up font">Change theme</h1>
              <div class="card shadow my-3">
                <div class="card-header bbcolorp">
                  <h3 class="card-title up font">Theme</h3>
                </div>
                <form class="row gx-3 gy-2 align-items-center p-5" action="{{ route('users.change.theme') }}"
                  method="POST">
                  @csrf
                  @method('PUT')
                    <select name="theme">
                        @foreach($themes as $theme)
                            <option value="{{ $theme->project_id }}" {{ $theme->project_id == $themeUser->project_id ? 'selected' : ''}}> {{ $theme->project->name }}</option>
                        @endforeach
                    </select>
                  <div class="col-md-4 mt-5">
                    <button type="submit" class="btn btn-primary rounded-pill up font">
                      Change
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
