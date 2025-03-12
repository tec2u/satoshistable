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
      <div class="form-group float-right">
         <input type="text" class="search form-control" placeholder="@lang('admin.btn.search')">
      </div>
   </div>
</div>

<div class="card">
   <div class="card-header">
      <div class="alignPackage">
         <h3>Projects list</h3>
      </div>
   </div>
   <div class="card-body table-responsive">
      <div class="form-group float-right">
         <input type="text" class="search form-control" placeholder="@lang('admin.btn.search')">
      </div>
      <span class="counter float-right"></span>
      <table class="table table-hover table-bordered results">
         <thead>
            <tr>
               <th>#</th>
               <th>Project name</th>
               <th>Logo</th>
               <th>Edit</th>
               <th>Delete</th>
            </tr>
            <tr class="warning no-result">
               <td colspan="4"><i class="fa fa-warning"></i> @lang('admin.btn.noresults')</td>
            </tr>
         </thead>
         <tbody>
            @forelse($projects as $project)
            <tr>
               <th>{{$project->id}}</th>
               <td>{{$project->name}}</td>
               <td>{{$project->logo}}</td>
               <td>{{$project->created_at}}</td>
               <td>
                  <button type="button" class="btn btn-primary btn-sm m-0">Edit</button>
               </td>
               <td>
                  <button type="button" class="btn btn-primary btn-sm m-0">Delete</button>
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
