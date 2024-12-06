@extends('layouts.header')
@section('content')
<main id="main" class="main">
    <div class="card">
        <div class="card-header">
            <h3>@lang('reports.investment_log')</h3>
        </div>
            <div class="card-body table-responsive">
                        <div class="form-group float-right">
                            <input type="text" class="search form-control" placeholder="Search">
                        </div>
                    <span class="counter float-right"></span>
                <table class="table table-hover table-bordered results">
                    <thead>
                        <tr>
                        <th>@lang('reports.name')</th>
                        <th>@lang('reports.amount')</th>
                        <th>@lang('reports.from_user')</th>
                        <th>@lang('reports.description')</th>
                        <th>@lang('reports.created_at')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($scores as $score)
                        <tr>
                        <th>{{$score->user_name}}</th>
                        <td>{{$score->score}}</td>
                        <td>{{$score->order_packages_id}}</td>
                        <td>{{$score->description}}</td>
                        <td>{{$score->created_at}}</td>
                        </tr>
                        @empty
                        <p>@lang('reports.no_package_registered')</p>
                        @endforelse
                    </tbody>
                </table>
            </div>
    </div>
</main>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
  $(".search").keyup(function () {
    var searchTerm = $(".search").val();
    var listItem = $('.results tbody').children('tr');
    var searchSplit = searchTerm.replace(/ /g, "'):containsi('")

  $.extend($.expr[':'], {'containsi': function(elem, i, match, array){
        return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
    }
  });

  $(".results tbody tr").not(":containsi('" + searchSplit + "')").each(function(e){
    $(this).attr('visible','false');
  });

  $(".results tbody tr:containsi('" + searchSplit + "')").each(function(e){
    $(this).attr('visible','true');
  });

  var jobCount = $('.results tbody tr[visible="true"]').length;
    $('.counter').text(jobCount + ' item');

  if(jobCount == '0') {$('.no-result').show();}
    else {$('.no-result').hide();}
		  });
});
    </script>
@stop
