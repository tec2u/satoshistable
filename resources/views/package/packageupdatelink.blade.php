@extends('layouts.header')
@section('content')

<main id="main" class="main">
    @include('flash::message')
    <section id="password" class="content">
        <div class="fade">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <h1>@lang('package.update_link')</h1>
                        <div class="card shadow my-3">
                            <div class="card-header bbcolorp">
                                <h3 class="card-title">@lang('package.input_link')</h3>
                            </div>
                            <form class="row gx-3 gy-2 align-items-center p-5" action="{{route('packages.change_link', ['id' => $orderpackage->id])}}" method="POST">
                                @csrf
                                @method('POST')
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="old_password" name="link" placeholder="link reference">
                                </div>


                                <div class="col-md-4 mt-5">
                                    <button type="submit" class="btn btn-primary rounded-pill">
                                    @lang('package.update_link')
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
