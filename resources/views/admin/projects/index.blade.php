@extends('adminlte::page')

@section('title', 'Projects')

@section('content_header')
<h4>Projects</h4>
@stop

@section('content')
@include('flash::message')
<div class="card">
    <div class="card-header">
        <div class="alignPackage">
            <h3>Projects list</h3>
        </div>
    </div>
    <div class="card-body table-responsive">
        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="project_id" value="{{ $project->id ?? '' }}">
            <div class="form-group">
                <label for="name">Project name</label>
                <input type="text" class="form-control" placeholder="name" name="name" value="{{ $project->name ?? '' }}" required>
            </div>

            <div class="form-group">
                <label for="name">Description</label>
                <textarea name="description" class="form-control" required>{{ $project->description ?? '' }}</textarea>
            </div>

            <div class="form-group">
                <label for="logo">Logo</label>
                <input type="file" name="logo"
                    class="form-control form-control-lg @error('logo.*') is-invalid @enderror">
                @error('logo.*')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="registration_bg">Background register image</label>
                <input type="file" name="registration_bg"
                    class="form-control form-control-lg @error('registration_bg.*') is-invalid @enderror">
                @error('registration_bg.*')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="regiatration_fontcolor">Register font color</label>
                <input type="color" class="form-control" name="regiatration_fontcolor" required value="{{ $project->regiatration_fontcolor ?? '' }}">
            </div>

            <div class="form-group">
                <label for="registration_boxbgcolor">Register box background color</label>
                <input type="color" class="form-control" name="registration_boxbgcolor" required value="{{ $project->registration_boxbgcolor ?? '' }}">
            </div>
            <div class="form-group">
                <button class="btn btn-primary">{{ isset($project->id) ? 'UPDATE' : 'SAVE' }}</button>
            </div>

        </form>
        <span class="counter float-right"></span>
        <table class="table table-hover table-bordered results">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Project name</th>
                    <th>Logo</th>
                    <th>Register background image</th>
                    <th>Register box background color</th>
                    <th>Register font color</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                <tr class="warning no-result">
                    <td colspan="4"><i class="fa fa-warning"></i> @lang('admin.btn.noresults')</td>
                </tr>
            </thead>
            <tbody>
                @forelse($projects as $item)
                <tr>
                    <th>{{$item->id}}</th>
                    <td>{{$item->name}}</td>
                    <td>{{$item->logo}}</td>
                    <td>{{$item->registration_bg}}</td>
                    <td style="background-color: {{$item->registration_boxbgcolor}};">{{$item->registration_boxbgcolor}}</td>
                    <td style="color: {{$item->regiatration_fontcolor}};">{{$item->regiatration_fontcolor}}</td>
                    <td>{{$item->created_at}}</td>
                    <td>
                        <a href="{{ route('admin.projects.edit', ['id' => $item->id]) }}" type="button" class="btn btn-primary btn-sm m-0">Edit</a>
                    </td>
                    <td>
                        <a href="{{ route('admin.projects.delete', ['id' => $item->id]) }}" type="button" class="btn btn-primary btn-sm m-0">Delete</a>
                    </td>
                </tr>
                @empty
                <p>@lang('admin.withdrawrequest.request.empty')</p>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@stop
@section('css')
<link rel="stylesheet" href="{{ asset('/css/admin_custom.css') }}">
@stop
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
