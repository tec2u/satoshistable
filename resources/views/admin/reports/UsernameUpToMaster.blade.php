@extends('adminlte::page')

@section('title', 'User to Master')

@section('content_header')
<div class="alignHeader">
   <h4>@lang('admin.level.user_to_master')</h4>
</div>
<i class="fa fa-home ml-3"></i> - @lang('admin.level.subtitle')
@stop

@section('content')

<div class="card">
   <div class="card-header">
      <div class="alignPackage">
         <h3>@lang('admin.level.username_to_master')</h3>
      </div>
   </div>
   <div class="card-body table-responsive">
      <div class="row">
         <div class="col-sm-12 col-md-4">
            <form action="{{route('admin.UsernameUpToMaster.searchUserToMaster')}}" method="POST">
               @csrf
               <div class="input-group input-group-lg">
                  <input type="text" name="search" class="form-control @error('search') is-invalid @enderror" placeholder="@lang('admin.btn.search')">
                  </br>

                  <span class="input-group-append">
                     <button type="submit" class="btn btn-info btn-flat">@lang('admin.btn.search')</button>
                  </span>
                  </br>
                  @lang('admin.level.search_blank')
                  </br>
                  @error('search')
                  <span class="error invalid-feedback">{{$message}}</span>
                  @enderror
               </div>
            </form>
         </div>

      <table class="table table-hover table-bordered results">
         <thead>
            <tr>
            <th>@lang('admin.level.login')</th>
            <th>@lang('admin.level.name')</th>
            <th>@lang('admin.level.email')</th>
            <th>@lang('admin.level.country')</th>
            <th>@lang('admin.level.level')</th>

            </tr>

         </thead><br>
         <tbody>



            @forelse($data as $r)


            <tr>
            <th>{{$r["login"]}}</th>
            <th>{{$r["name"]}}</th>
            <th>{{$r["email"]}}</th>
            <th>{{$r["country"]}}</th>
            <th>{{$r["level"]}}</th>

            </tr>
            @empty
            <p>@lang('admin.level.table.empty')</p>
            @endforelse
         </tbody>
      </table>
   </div>

      @stop
