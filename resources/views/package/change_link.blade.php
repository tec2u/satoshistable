@extends('layouts.header')
@section('content')

<main id="main" class="main">
    @include('flash::message')
    <section id="password" class="content">
        <div class="fade">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <h1>@lang('package.link_saved')</h1>
                        <div class="card shadow my-3">
                            <div class="card-header bbcolorp">
                                <h3 class="card-title"></h3>
                            </div>

                            <div class="col-12">

                                @lang('package.link_saved_on_order') </BR>
                                @lang('package.analysts_analyzing_account')

                            </div>


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
