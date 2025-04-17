@extends('layouts.header')
@section('content')
  <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
  <style>
    .swal2-popup,
    .swal2-modal,
    .swal2-show {
      /* max-height: 40vh !important; */
      width: fit-content !important;
      padding: 0;
    }

    .swal2-container img {
      width: 400px !important;
      max-height: 300px !important;
    }
  </style>
  @php

    $user_id = ucwords(auth()->user()->id);

    $diretos_qr = Illuminate\Support\Facades\DB::select(
        'SELECT count(distinct(user_id_from)) as total FROM historic_score where user_id=? and level_from=1;',
        [$user_id],
    );
    $diretos = isset($diretos_qr[0]->{'total'}) ? $diretos_qr[0]->{'total'} : 0;

    $indiretos_qr = Illuminate\Support\Facades\DB::select(
        "SELECT count(distinct(user_id_from)) as total FROM historic_score where user_id=? and level_from>1 and level_from<'6';",
        [$user_id],
    );
    $indiretos = isset($indiretos_qr[0]->{'total'}) ? $indiretos_qr[0]->{'total'} : 0;

    $totalMembros = $diretos + $indiretos;

    $directVolume = Illuminate\Support\Facades\DB::select(
        'SELECT sum(score) as total FROM historic_score where user_id=? and level_from=1',
        [$user_id],
    );
    $directVolume = isset($directVolume[0]->{'total'}) ? $directVolume[0]->{'total'} : 0;

    $indirectVolume = Illuminate\Support\Facades\DB::select(
        "SELECT sum(score) as total FROM historic_score where user_id=? and level_from>1 and level_from<'6'   ",
        [$user_id],
    );
    $indirectVolume = isset($indirectVolume[0]->{'total'}) ? $indirectVolume[0]->{'total'} : 0;

    $totalVolume = $indirectVolume + $directVolume;

    $personalVolume = Illuminate\Support\Facades\DB::select(
        'SELECT sum(score) as total FROM historic_score where user_id=? and level_from=0',
        [$user_id],
    );
    $personalVolume = isset($personalVolume[0]->{'total'}) ? $personalVolume[0]->{'total'} : 0;

    $totalComissionInvested = Illuminate\Support\Facades\DB::select('select sum(price) from orders_package where user_id=? and status=1', [$user_id]);
    $totalComissionInvested = isset($totalComissionInvested[0]->{'sum(price)'}) ? $totalComissionInvested[0]->{'sum(price)'} : 0;

    $totalComissionReward = Illuminate\Support\Facades\DB::select(
        'select sum(price) from banco where user_id=? and price>0 and description=2', [$user_id]);
    $totalComissionReward = isset($totalComissionReward[0]->{'sum(price)'}) ? $totalComissionReward[0]->{'sum(price)'} : 0;

    $availableComission = Illuminate\Support\Facades\DB::select('select sum(price) from banco where user_id=?', [
        $user_id,
    ]);
    $availableComission = isset($availableComission[0]->{'sum(price)'}) ? $availableComission[0]->{'sum(price)'} : 0;

  @endphp

    @php
    use App\Models\Theme;

    $theme = Theme::find(auth()->user()->theme_id);

    @endphp
  <script>
    $(function() {
      'use strict'
      var salesChartCanvas = $('#salesChart').get(0).getContext('2d')
      var salesChartData = {
        labels: {
          !!$label!!
        },
        datasets: [{
            label: 'Balance Entries',
            backgroundColor: 'rgba(255,160,25,0.9)',
            borderColor: 'rgba(255,160,25,0.8)',
            pointRadius: false,
            pointColor: '#ffa019',
            pointStrokeColor: 'rgba(255,160,25,1)',
            pointHighlightFill: '#ffa019',
            pointHighlightStroke: 'rgba(255,160,25,1)',
            data: {
              !!$data!!
            }
          },
          {
            label: 'Balance Out',
            backgroundColor: 'rgba(210, 214, 222, 1)',
            borderColor: 'rgba(210, 214, 222, 1)',
            pointRadius: false,
            pointColor: 'rgba(210, 214, 222, 1)',
            pointStrokeColor: '#c1c7d1',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgba(220,220,220,1)',
            data: {
              !!$datasaida!!
            }
          }
        ]
      }
      var salesChartOptions = {
        maintainAspectRatio: false,
        responsive: true,
        legend: {
          display: false
        },
        scales: {
          xAxes: [{
            gridLines: {
              display: false
            }
          }],
          yAxes: [{
            gridLines: {
              display: false
            }
          }]
        }
      }
      var salesChart = new Chart(
        salesChartCanvas, {
          type: 'line',
          data: salesChartData,
          options: salesChartOptions
        }
      )
      var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
      var pieData = {
        labels: ['Chrome', 'IE', 'FireFox', 'Safari', 'Opera', 'Navigator'],
        datasets: [{
          data: [700, 500, 400, 600, 300, 100],
          backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de']
        }]
      }
      var pieOptions = {
        legend: {
          display: false
        }
      }
      var pieChart = new Chart(pieChartCanvas, {
        type: 'doughnut',
        data: pieData,
        options: pieOptions
      })

      $('#world-map-markers').mapael({
        map: {
          name: 'usa_states',
          zoom: {
            enabled: true,
            maxLevel: 10
          }
        }
      })
    })

    $(function() {

      $('#carouselEcommerc img:eq(0)').addClass("ativo").show();
      setInterval(slide, 5000);

      function slide() {

        //Se a proxima imagem existir
        if ($('.ativo').next().length) {

          $('.ativo').removeClass("ativo").next().addClass("ativo");

        } else { //Se for a ultima img do carrosel

          $('.ativo').removeClass("ativo");
          $('#carouselEcommerc img:eq(0)').addClass("ativo");

        }

      }
    });
  </script>

  <script>
    function FunctionCopy1() {

      var copyText = document.getElementById("landing");


      copyText.select();
      copyText.setSelectionRange(0, 99999); // For mobile devices

      navigator.clipboard.writeText(copyText.value);

      // alert("Copied the text: " + copyText.value);
    }

    function FunctionCopy2() {

      var copyText = document.getElementById("referral");


      copyText.select();
      copyText.setSelectionRange(0, 99999); // For mobile devices

      navigator.clipboard.writeText(copyText.value);

      // alert("Copied the text: " + copyText.value);
    }
    function FunctionCopy(input_id) {

      var copyText = document.getElementById(input_id);


      copyText.select();
      copyText.setSelectionRange(0, 99999); // For mobile devices

      navigator.clipboard.writeText(copyText.value);

      // alert("Copied the text: " + copyText.value);
    }
  </script>

  <style>
    .txtcolor {
      color: #fff;
    }


    .card_text {
      color: #fff;
    }

    .txt-video {
      font-size: 20px !important;
      text-transform: uppercase;
      font-weight: bold !important;
    }


    @media (max-width: 575px) {
      .respon {
        display: block;
        margin-left: auto;
        margin-right: auto;
      }
    }

    .video {
      aspect-ratio: 16 / 9;
      width: 80%;
      display: block;

    }

    @media (max-width: 420px) {
      .video {
        width: 100%;
      }
    }

    .img-home {
      max-width: 80%;
      border-radius: 50%;
    }

    .img-home-1 {
      max-width: 90%;
      border-radius: 50%;
    }
  </style>

  <main id="main" class="main mt-0">

    <section id="home" class="content">
      <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="d-block w-100" src="{{ asset($theme->banner) }}" alt="First slide" style="height: 100%">
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>

      <div class="col-12">
        <div class="info-box mb-4 shadow mt-4" style="padding: 1em 0.6em;">
          <div class="info-box-content font">
            <span class="info-box-text up font">@lang('home.referral_link')</span>
            <div class="row">
              <div class="col-12">
                <div class="input-group mb-3 font">
                  <input type="text" class="form-control" id="referral"
                    value="{{ route('indication', ['project_id' => 1, 'id' => auth()->user()->id]) }}">
                  <button class="up btn  orderbtn linkcopy px-4 btn-background-color" type="button" onclick=" FunctionCopy2()">@lang('home.copy')</button>
                </div>
              </div>
              @foreach($projects as $project)
              <!-- <div class="col-12">
                <div class="font">{{ $project->name }}</div>
                <div class="input-group mb-3 font">
                  <input type="text" class="form-control" id="referral_{{$project->id}}"
                    value="{{ route('landing', ['project_id' => $project->id, 'id' => auth()->user()->id]) }}">
                  <button class="up btn  orderbtn linkcopy px-4" type="button"
                    style="background-color: #99c147;color:white" onclick="FunctionCopy('referral_{{$project->id}}')">@lang('home.copy')</button>
                </div>
              </div> -->
              @endforeach
            </div>
          </div>
        </div>
      </div>

      <div class="container-fluid">
        <div class="row mb-3">
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-4 shadow c1 card_color">
              <span class="info-box-icon"><i class="bi bi-arrow-down-up card_text"></i></span>
              <div class="info-box-content font">
                <span class="info-box-text card_text" style="white-space: normal !important;">Total Daily Reward</span>
                <span class="info-box-number card_text">{{ number_format($totalComissionReward, 2, ',', '.') }}</span>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-4 shadow c1 card_color">
              <span class="info-box-icon"><i class="bi bi-trophy-fill card_text"></i></span>
              <div class="info-box-content font">
                <span class="info-box-text card_text" style="white-space: normal !important;">@lang('home.total_referrals')</span>
                <span class="info-box-number card_text">{{ $diretos }}</span>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-4 shadow elevation c1 card_color">
              <span class="info-box-icon "><i class="bi bi-caret-up card_text"></i></span>
              <div class="info-box-content font">
                <span class="info-box-text card_text" style="white-space: normal !important;text-transform: uppercase">@lang('home.total_indirect_referral')</span>
                <span class="info-box-number card_text">{{ $indiretos }}</span>
              </div>
            </div>
          </div>



        </div>
      </div>
      <div class="container-fluid">
        <div class="row mb-3">
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-4 shadow c1 card_color">
              <span class="info-box-icon"><i class="bi bi-arrow-down-up card_text"></i></span>
              <div class="info-box-content font">
                <span class="info-box-text card_text" style="white-space: normal !important;text-transform: uppercase">Total Amount Invested In Projects</span>
                <span class="info-box-number card_text">{{ number_format($totalComissionInvested, 2, ',', '.') }}</span>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-4 shadow c1 card_color">
              <span class="info-box-icon"><i class="bi bi-trophy-fill card_text"></i></span>
              <div class="info-box-content font">
                <span class="info-box-text card_text" style="white-space: normal !important;text-transform: uppercase">@lang('home.group_volume')</span>
                <span class="info-box-number card_text">{{ number_format($totalVolume, 2, ',', '.') }}</span>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-4 shadow elevation c1 card_color">
              <span class="info-box-icon "><i class="bi bi-caret-up card_text"></i></span>
              <div class="info-box-content font">
                <span class="info-box-text card_text" style="white-space: normal !important;text-transform: uppercase">@lang('home.rank')</span>
                <span class="info-box-number card_text">@lang('home.no_rank')</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>

      @include('components.cards')
    </section>
    <!-- Modal para exibir a imagem em tela cheia -->
    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <img src="" alt="Image" class="img-fluid" id="modalImage" style="width: 100%;">
          </div>
        </div>
      </div>
    </div>
  </main>
  <script>

    // Quando o usuário clica na imagem, exibe o modal com a imagem em tela cheia
    $('.image-modal').click(function() {
      var imageUrl = $(this).attr('src');
      $('#modalImage').attr('src', imageUrl);
      $('#imageModal').modal('show');
    });
  </script>
  <script>
    if (screen.width > 810) {
      var widthImage = 810;
      var heightImage = widthImage / 1.787;
    } else {
      var widthImage = screen.width;
      var heightImage = screen.width / 1.787;
    }
  </script>

  @php

    $user_id = ucwords(auth()->user()->id);

    $diretos_qr = Illuminate\Support\Facades\DB::select(
        'SELECT count(*) as total FROM orders_package where user_id=? and package_id=20 and status=0 limit 1',
        [$user_id],
    );
    $diretos = isset($diretos_qr[0]->{'total'}) ? $diretos_qr[0]->{'total'} : 0;

    if ($diretos > 0) {
    }

  @endphp


  @if (isset($n_pago) && $n_pago == true)
   <!-- <script>
      setTimeout(() => {
        Swal.fire({
          "title": "",
          "text": "",
          "width": widthImage,
          "heightAuto": true,
          "padding": "1.25rem",
          "showConfirmButton": true,
          "showCloseButton": false,
          "timerProgressBar": false,
          "customClass": {
            "container": null,
            "popup": null,
            "header": null,
            "title": null,
            "closeButton": null,
            "icon": null,
            "image": null,
            "content": null,
            "input": null,
            "actions": null,
            "confirmButton": null,
            "cancelButton": null,
            "footer": null
          },
          "imageUrl": "/images/alert.jpg",

          "imageAlt": "",
          "animation": false
        });
      }, 7000);
    </script>-->
  @endif
@endsection
