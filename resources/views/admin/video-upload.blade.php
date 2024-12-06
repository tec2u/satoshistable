@extends('adminlte::page')

@section('title', 'Upload Video')

@section('content_header')
<h4>@lang('admin.upload.upload_video')</h4>
@stop

@section('content')

<div class="card">
   <div class="card-header">
      <div class="alignPackage">
         <h3>@lang('admin.upload.upload_video')</h3>
      </div>
   </div>
   <div class="panel-body">
      @if ($message = Session::get('success'))
      <div class="alert alert-success alert-block">
         <button type="button" class="close" data-dismiss="alert">×</button>
         <strong>{{ $message }}</strong>
      </div>
      @endif

      @if (count($errors) > 0)
      <div class="alert alert-danger">
      @lang('admin.upload.whoops')
         <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
         </ul>
      </div>
      @endif

      <form action="{{ route('admin.video-upload.store') }}" method="POST" enctype="multipart/form-data">
         @csrf
         <div class="row">

            <div class="col-md-12">
               <div class="col-md-6 form-group">
                  <label>@lang('admin.upload.title'):</label>
                  <input type="text" name="title" class="form-control" />
               </div>
               <div class="col-md-6 form-group">
                  <label>@lang('admin.upload.select_video'):</label>
                  <input type="file" name="video" class="form-control" />
               </div>
               <div class="col-md-6 form-group">
                  <button type="submit" class="btn btn-success">@lang('admin.upload.save')</button>
               </div>
            </div>
         </div>
      </form>
      <div class="card-body table-responsive">
         <table class="table table-hover table-bordered results">
            <thead>
               <tr>
                  <th>@lang('admin.upload.id')</th>
                  <th>@lang('admin.upload.title')</th>
                  <th>@lang('admin.upload.created_at')</th>
                  <th>@lang('admin.upload.download')</th>
                  <th>@lang('admin.upload.edit')</th>
                  <th>@lang('admin.upload.delete')</th>
               </tr>
               <tr class="warning no-result">
                  <td colspan="4"><i class="fa fa-warning"></i>@lang('admin.btn.noresults')</td>
               </tr>
            </thead>
            <tbody>
               @forelse($videos as $video)
               <tr>
                  <td>{{$video->id}}</td>
                  <td>{{$video->title}}</td>
                  <td>{{$video->created_at}}</td>
                  <td><a href="{{ route('admin.video-upload.download', $video->id) }}">@lang('admin.upload.download_button')</a></td>
                  <td><a href="{{route('admin.video-upload.edit', ['id' => $video->id])}}" class="btn bg-teal" title="Edit">
                        <i class="fas fa-edit"></i>
                  </td>
                  <td>
                     <div class="btn-group">
                        <form action="{{route('admin.video-upload.delete', ['id' => $video->id])}}" method="post">
                           @csrf
                           @method('DELETE')
                           <button type="submit" class="btn btn-danger" title="Delete"><i class="fas fa-trash-alt"></i></button>
                        </form>
                     </div>
                  </td>
               </tr>
               @empty
               <p>@lang('admin.upload.empty')</p>
               @endforelse
            </tbody>
         </table>
      </div>
   </div>
</div>
@stop
@section('css')
<link rel="stylesheet" href="{{ asset('/css/admin_custom.css') }}">
@stop
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
@section('js')
<script>
   $(document).ready(function() {
      $(".search").keyup(function() {
         var searchTerm = $(".search").val();
         var listItem = $('.results tbody').children('tr');
         var searchSplit = searchTerm.replace(/ /g, "'):containsi('")

         $.extend($.expr[':'], {
            'containsi': function(elem, i, match, array) {
               return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
            }
         });

         $(".results tbody tr").not(":containsi('" + searchSplit + "')").each(function(e) {
            $(this).attr('visible', 'false');
         });

         $(".results tbody tr:containsi('" + searchSplit + "')").each(function(e) {
            $(this).attr('visible', 'true');
         });

         var jobCount = $('.results tbody tr[visible="true"]').length;
         $('.counter').text(jobCount + ' item');

         if (jobCount == '0') {
            $('.no-result').show();
         } else {
            $('.no-result').hide();
         }
      });
   });
</script>
@stop
