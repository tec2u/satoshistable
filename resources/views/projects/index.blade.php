@extends('layouts.header')
@section('content')
<main id="main" class="main">
    @include('flash::message')
    <section id="produtos" class="content">
        <div class="fade">
            <div class="container-fluid">
                <h1>@lang('package.products')</h1>
                <div class="row d-flex flex-wrap">
                    @forelse($projects as $project)
                    <div class="card w-375px shadow-sm mr-3">
                        <div class="card-body">
                            <div class="row">
                                <!-- Logo e nome do projeto -->
                                <div class="d-flex align-items-center justify-content-center flex-column text-center">
                                    <img src="{{ asset($project->logo) }}" alt="Logo" class="logo-project mb-3" style="max-width: 100px;">
                                    <h5 class="card-title">{{ $project->name }}</h5>
                                </div>

                                <!-- Link de registro -->
                                <div>
                                    <div class="d-flex flex-column align-items-start">
                                        <label class="form-label">Register:</label>
                                        <div class="input-group">
                                            <input type="text" class="input_st w-50" readonly id="register_{{ $project->id }}" value="{{ route('indication', ['project_id' => $project->id, 'id' => auth()->user()->id]) }}">
                                            <div>
                                                <button class="btn btn-outline-primary btn-background-color" type="button" onclick="copyLink('register_{{ $project->id }}')">copy</button>
                                                <button class="btn btn-outline-primary btn-background-color" type="button" onclick="openLink('register_{{ $project->id }}')">open</button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Landing page -->
                                    <div class="d-flex flex-column align-items-start">
                                        <label class="form-label">Landing page:</label>
                                        <div class="input-group">
                                            <input type="text" class="input_st w-50" readonly id="landing_{{ $project->id }}" value="{{ route('landing', ['project_id' => $project->id, 'id' => auth()->user()->id]) }}">
                                            <div>
                                                <button class="btn btn-outline-primary btn-background-color" type="button" onclick="copyLink('landing_{{ $project->id }}')">copy</button>
                                                <button class="btn btn-outline-primary btn-background-color" type="button" onclick="openLink('landing_{{ $project->id }}')">open</button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Perfil do projeto -->
                                    <div class="d-flex flex-column align-items-start">
                                        <label class="form-label">Project profile:</label>
                                        <div class="input-group">
                                            <input type="text" class="input_st w-50" readonly id="profile_{{ $project->id }}" value="{{ route('projects.profile', ['id' => $project->id]) }}">
                                            <div>
                                                <button class="btn btn-outline-primary btn-background-color" type="button" onclick="copyLink('profile_{{ $project->id }}')">copy</button>
                                                <button class="btn btn-outline-primary btn-background-color" type="button" onclick="openLink('profile_{{ $project->id }}')">open</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <p>@lang('package.any_products_registered')</p>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
</main>
<style>
    .logo-project {
        width: 70px;
        background-color: #000000;
        padding: 4px;
        border-radius: 35px;
        margin-left: 15px;
    }

    .input_st {
        background-color: transparent;
        border: none;
        font-size: 8px;
    }

    .input_st::placeholder {
        background-color: transparent;
    }

    .w-375px {
        width: 375px;
    }
    .w-50 {
        width: 50%;
    }

    .w-30 {
        width: 30%;
    }

    .input-group {
        justify-content: space-between;
    }
</style>
<script>
    function copyLink(id) {

        var copyText = document.getElementById(id);
        console.log(copyText)

        copyText.select();
        copyText.setSelectionRange(0, 99999);

        navigator.clipboard.writeText(copyText.value);
    }

    function openLink(id) {

        var copyText = document.getElementById(id);
        window.open(copyText.value)
    }
</script>
@endsection
