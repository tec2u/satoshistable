@extends('layouts.header')
@section('content')
<main id="main" class="main">
    @include('flash::message')
    <section id="produtos" class="content">
        <div class="fade">
            <div class="container-fluid">
                <h1>@lang('package.products')</h1>
                <div class="">
                    <div class="row">
                        @forelse($projects as $project)
                        <div class="row">
                            <div class="col-3 d-flex align-items-center justify-content-center flex-column">
                                <img src="{{ asset($project->logo) }}" alt="" class="logo-project">
                                <div>
                                    <h2 class="my-4">{{ $project->name }}</h2>
                                </div>
                            </div>
                            <div class="col-3 d-flex align-items-center">
                                <label for="" class="mb-0 mr-2">Register: </label><input type="text" class="input_st" readonly id="register_{{ $project->id }}" value="{{ route('indication', ['project_id' => $project->id, 'id' => auth()->user()->id]) }}"> <button class="btn btn-outline-primary btn-small" onclick="copyLink('register_{{ $project->id }}')">Copy</button>
                            </div>
                            <div class="col-3 d-flex align-items-center">
                                <label for="" class="mb-0 mr-2">Landing page: </label><input type="text" class="input_st" readonly id="landing_{{ $project->id }}" value="{{ route('landing', ['project_id' => $project->id, 'id' => auth()->user()->id]) }}"> <button class="btn btn-outline-primary btn-small" onclick="copyLink('landing_{{ $project->id }}')">Copy</button>
                            </div>
                            <div class="col-3 d-flex align-items-center">
                                <label for="" class="mb-0 mr-2">Project profile: </label><input type="text" class="input_st" readonly id="profile_{{ $project->id }}" value="{{ route('projects.profile', ['id' => $project->id]) }}"> <button class="btn btn-outline-primary btn-small" onclick="copyLink('profile_{{ $project->id }}')">Copy</button>
                            </div>
                        </div>
                        @empty
                        <p>@lang('package.any_products_registered')</p>
                        @endforelse
                    </div>
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
        border: none;
    }

    .input_st::placeholder {
        background-color: transparent;
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
</script>
@endsection
