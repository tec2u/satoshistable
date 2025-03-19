@extends('layouts.header')
@section('content')
<main id="main" class="main">
    @include('flash::message')
    <section id="produtos" class="content">
        <div class="fade">
            <div class="container-fluid">
                <h1>Project profile</h1>
                <div class="">
                    <div class="row">
                        <div class="row">
                            <div class="col-12 d-flex align-items-center justify-content-center flex-column">
                                <img src="{{ asset($project->logo) }}" alt="" class="logo-project">
                                <div>
                                    <h2 class="my-4">{{ $project->name }}</h2>
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-center align-items-center">
                                <div style="width: 70%;">{{ $project->description }}</div>
                            </div>
                            <div class="col-12">
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Title</th>
                                                <th>Download</th>
                                                <th>@lang('withdraw.date')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($documents as $document)
                                            <tr>
                                                <td>{{$document->id}}</td>
                                                <td>{{$document->title}}</td>
                                                <td><a class="btn btn-success btn-sm m-0" href="{{ route('documents.download', $document->id) }}">Download</a></td>
                                                <td>{{date('d/m/Y ', strtotime($document->created_at))}}</td>
                                            </tr>
                                            @empty
                                            <p class="m-4 fst-italic">No document registered</p>
                                            @endforelse

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
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
