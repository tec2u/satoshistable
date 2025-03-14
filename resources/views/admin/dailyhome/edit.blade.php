@extends('adminlte::page')

@section('title', 'Update Image')

@section('content_header')
<h4>@lang('admin.unilevel.table.update_image')</h4>
@stop

@section('content')

<div class="card">
  <div class="card-header">
    <div class="alignPackage">
      <h3>@lang('admin.unilevel.table.update_image')</h3>
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
        @lang('admin.unilevel.table.whoops')
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif

    <form action="{{ route('admin.dailyhome.update', ['id' => $images->id]) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="row">

        <div class="col-md-12">
          <div class="col-md-6 form-group">
            <label>@lang('admin.unilevel.table.title'):</label>
            <input type="text" name="title" value="{{ $images->title }}" class="form-control" />
          </div>
          <div class="col-md-6 form-group">
            <label>@lang('admin.unilevel.table.date'):</label>
            <input type="text" name="date" class="form-control" value="{{ $images->date }}" pattern="(0[1-9]|1[0-2])\/(0[1-9]|[12][0-9]|3[01])\/\d{4}" placeholder="MM/DD/YYYY" required>
          </div>
          <div class="col-md-6 form-group">
            <label>@lang('admin.unilevel.table.select_image'):</label>
            <input type="file" name="video" value="{{ $images->path }}" class="form-control" required />
          </div>
          <div class="col-md-6 form-group">
            <button type="submit" class="btn btn-success">@lang('admin.unilevel.table.save')</button>
          </div>
        </div>
      </div>
    </form>
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
