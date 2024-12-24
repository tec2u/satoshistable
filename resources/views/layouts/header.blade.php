<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="font-family: Poppins, sans-serif;">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>SATOSHI SQUARE TABLE</title>
  <link rel="icon" type="image/png" href="/images/logo.png" />

  <!-- Fonts -->
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">
  <!-- Icons -->
  <link rel="stylesheet" href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  <link rel="stylesheet"
    href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flipclock/0.7.7/flipclock.css">
  <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flipclock/0.7.7/flipclock.js"></script>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;800&display=swap" rel="stylesheet">

  <style>
    nav,
    aside,
    ul,
    li,
    li a,
    h5,
    h2,
    h3,
    h4,
    h5,
    h6 {
      font-family: "Montserrat", sans-serif !important;
      font-weight: 200;
    }

    .sidebar,
    .nav-link span {
      text-transform: capitalize !important;
    }

    .up {
      text-transform: uppercase;
    }

    .font {
      font-family: "Montserrat", sans-serif !important;
      font-weight: 200;
    }
  </style>
</head>

<body>
  <!-- ======= Header ======= -->
  @include('sweetalert::alert')
  <header id="header" class="header font fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
      <i class="bi bi-list toggle-sidebar-btn" style="color: #ffffff;"></i>
    </div><!-- End Logo -->
    <nav class="header-nav ms-auto">

      <ul class="d-flex align-items-center">

        <li class=" pe-4"><a href="https://t.me/+CrAniOfZICU1MzI0" target="_blank" class=""><i
              class="lab la-telegram iconhead" style="color: #ffffff;"></i> </a> </li>
        <li class=" pe-4"><a href="https://t.me/+CrAniOfZICU1MzI0" target="_blank" class="">
            <h6 class="text-dark-50 joinhead" style="color: #ffffff;">@lang('header.join_our') </br>@lang('header.telegram_channel')</h6>
          </a> </li>

        <li class="nav-item dropdown pe-3">
          <div class="btn-group">
            <button class="btn dropdown-toggle btn-lang " type="button" data-bs-toggle="dropdown"
              data-bs-auto-close="true" aria-expanded="false">
              @lang('header.language')
            </button>
            <ul class="dropdown-menu">
              <li>
                <a class="dropdown-item" href="/setlocale/en"><img src="{{ asset('assetsWelcome/images/flaguk.png') }}"
                    style="width: 18px;margin-right:10px" alt="...">@lang('header.english')</a>
              </li>
              <li>
                <a class="dropdown-item" href="/setlocale/es"><img src="{{ asset('assetsWelcome/images/flagspa.png') }}"
                    style="width: 18px;margin-right:10px" alt="...">@lang('header.spanish')</a>
              </li>
              <li>
                <a class="dropdown-item" href="/setlocale/de"><img src="{{ asset('assetsWelcome/images/flagger.png') }}"
                    style="width: 18px;margin-right:10px" alt="...">@lang('header.german')</a>
              </li>
              <li>
                <a class="dropdown-item" href="/setlocale/fr"><img src="{{ asset('assetsWelcome/images/flagfr.png') }}"
                    style="width: 18px;margin-right:10px" alt="...">@lang('header.french')</a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">

            @if (!empty(auth()->user()->image_path))
              <img src="{{ asset('storage/' . auth()->user()->image_path) }}" alt="Profile" class="rounded-circle">
            @else
              <img src="../../../assetsWelcome/images/favicon.png" alt="Profile" class="rounded-circle">
            @endif

            <span class="d-none d-md-block dropdown-toggle ps-2"
              style="color: #ffffff;">{{ ucwords(auth()->user()->name) }}</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>{{ ucwords(auth()->user()->name) }}</h6>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center alog" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right iconlog"></i>
                <span>@lang('header.sign_out')</span>
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>
            </li>
          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->
      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar font" style="background-color: #fff;">
    <a href="{{ route('home.home') }}">
      <img class="imagetest2" style="width: 250px" src="{{ asset('images/tigle_logo2.png') }}" alt="">
    </a>
    </br></br>

    <ul class="sidebar-nav" id="sidebar-nav">
      {{-- @if (auth()->user()->payFirstOrder()) --}}
      <li class="nav-item">
        <a class="nav-link " href="{{ route('home.home') }}">
          <i class="bi bi-grid"></i>
          <span>Home</span>
        </a>
      </li><!-- End Dashboard Nav -->
      {{-- @endif --}}

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#minting-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-clipboard2-minus"></i><span>@lang('header.purchase')</span><i
            class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="minting-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('packages.index') }}">
              <i class="bi bi-circle"></i><span>@lang('header.products')</span>
            </a>
          </li>

          {{-- <li>
            <a href="{{ route('packages.packagelog') }}">
              <i class="bi bi-circle"></i><span>BOT ORDERS</span>
            </a>
          </li> --}}
          {{-- <li>
            <a href="{{ route('packages.packagesprofit') }}">
              <i class="bi bi-circle"></i><span>PROFIT SHARE</span>
            </a>
          </li> --}}
        </ul>
      </li>

      <li class="nav-item">
        <a class="nav-link " href="{{ route('packages.packagelog') }}">
          <i class="bi bi-clipboard2-minus"></i><span>@lang('header.my_accounts')</span>

        </a>
      </li>
      {{-- @if (auth()->user()->payFirstOrder()) --}}

      {{-- <!-- End Products Nav --> --}}

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#networks-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-people"></i><span>@lang('header.referral_program')</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="networks-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('networks.mytree', Auth::id()) }}">
              <i class="bi bi-circle"></i><span>Visualização Rede</span>
            </a>
          </li>
          <li>
            <a href="{{ route('networks.associatesReport') }}">
              <i class="bi bi-circle"></i><span>@lang('header.my_team')</span>
            </a>
          </li>
          <li>
            <a href="{{ route('withdraws.withdrawRequests') }}">
              <i class="bi bi-circle"></i><span>@lang('header.withdraw_request')</span>
            </a>
          </li>
          <li>
            <a href="{{ route('withdraws.withdrawLog') }}">
              <i class="bi bi-circle"></i><span>@lang('header.withdraw_log')</span>
            </a>
          </li>
          <li>
            <a href="{{ route('reports.transactions') }}">
              <i class="bi bi-circle"></i><span>@lang('header.transaction')</span>
            </a>
          </li>
          <!--<li>
                    <a href="{{ route('networks.associatesReport') }}">
                        <i class="bi bi-circle"></i><span>@lang('header.associates')</span>
                    </a>
                </li>-->
        </ul>
      </li>

      <li class="nav-item">
        <a class="nav-link " href="{{ route('supports.supporttickets') }}">
          <i class="bi bi-question-octagon"></i>
          <span>@lang('header.support')</span>
        </a>
      </li>

      {{-- <li class="nav-item">
            <a class="nav-link " href="{{ url('/marketing') }}">
        <i class="bi bi-bag"></i>
        <span>@lang('header.marketing')</span>
        </a>
        </li> --}}
      {{-- @if (auth()->user()->isAllowed()) --}}
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#report-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-bar-chart"></i><span>@lang('header.report')</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="report-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <!-- <li>
               <a href="{{ route('reports.signupcommission') }}">
                  <i class="bi bi-circle"></i><span>@lang('header.signup_commission')</span>
               </a>
            </li> -->
          <!-- <li>
               <a href="{{ route('reports.levelIncome') }}">
                  <i class="bi bi-circle"></i><span>@lang('header.level_income')</span>
               </a>
            </li> -->
          <!-- <li>
                    <a href="{{ route('reports.signupcommission') }}">
                        <i class="bi bi-circle"></i><span>@lang('header.referral_comission')</span>
                    </a>
                </li> -->

          <li>
            <a href="{{ route('reports.bonusdaily') }}">
              <i class="bi bi-circle"></i><span>
                {{-- @lang('header.referral_comission') --}}
                DAILY PROFIT
              </span>
            </a>
          </li>
          <!-- <li>
                    <a href="{{ route('reports.poolcommission') }}">
                        <i class="bi bi-circle"></i><span>@lang('header.pool_commission')</span>
                    </a>
                </li> -->




          {{-- <li>
               <a href="{{ route('reports.stakingRewards') }}">
                <i class="bi bi-circle"></i><span>@lang('header.stacking_rewards')</span>
                </a>
        </li>
        <li>
            <a href="{{ route('reports.monthlyCoins') }}">
                <i class="bi bi-circle"></i><span>@lang('header.monthly_coins')</span>
            </a>
        </li> --}}
          <!-- <li>
               <a href="{{ route('reports.rankReward') }}">
                  <i class="bi bi-circle"></i><span>@lang('header.rank_reward')</span>
               </a>
            </li> -->
          {{-- <li>
                <a href="{{ route('reports.transactions') }}">
                  <i class="bi bi-circle"></i><span>@lang('header.transaction')</span>
                </a>
              </li> --}}
        </ul>
      </li>
      {{-- @endif --}}
      {{-- @endif --}}
      <!--<li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#daily-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-calendar-day"></i><span>DAILY MAIN REPORT</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="daily-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('documents.index') }}">
                        <i class="bi bi-circle"></i><span>DOCUMENTS</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('videos.index') }}">
                        <i class="bi bi-circle"></i><span>VIDEOS</span>
                    </a>
                </li>
            </ul>
        </li>-->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#settings-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-gear"></i><span>@lang('header.settings')</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="settings-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('users.index') }}">
              <i class="bi bi-circle"></i><span>@lang('header.my_info')</span>
            </a>
          </li>

          <li>
            <a href="{{ route('users.password') }}">
              <i class="bi bi-circle"></i><span>@lang('header.password')</span>
            </a>
          </li>
        </ul>
      </li>
      {{-- @if (auth()->user()->rule === 'RULE_ADMIN' || 'RULE_SUPPORT')
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('admin.home') }}">
        <i class="bi bi-lock-fill"></i>
        <span>@lang('header.admin')</span>
        </a>
        </li>
        @endif --}}

      <li class="nav-item">

        <a class="nav-link collapsed" href="{{ route('logout') }}"
          onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
          <i class="bi bi-box-arrow-left"></i>
          <span>@lang('header.logout')</span>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
          @csrf
        </form>
      </li>
    </ul>
  </aside>

  <main id="main" class="main p-0">
    <!-- <section style="backdrop-filter: blur(0px);filter: brightness(120%) grayscale(0%) saturate(120%);" id="herosection">
            <div data-bss-scroll-zoom="true" data-bss-scroll-zoom-speed="0.5" style="width: 100%;height: 50vh;background: linear-gradient(rgba(0,0,0,0.83), rgba(0,0,0,0.78)), url(&quot;../assets/img/heroimg.png?h=19923c9d1c5b6e5752b86d1ffaf52718&quot;) center / cover no-repeat;">
                <div class="container h-100">
                    <div class="row justify-content-center align-items-center h-100">
                        <div class="col-md-10 col-lg-10 col-xl-8 d-flex d-sm-flex d-md-flex justify-content-center align-items-center mx-auto justify-content-md-start align-items-md-center justify-content-xl-center">
                            <div class="text-center" style="margin: 0 auto;">
                                <p data-aos="fade" data-aos-duration="1500" data-aos-delay="400" data-aos-once="true" class="phero">@lang('leadpage.home.txt')</p>
                                <h2 class="text-uppercase fw-bold mb-3 hhero hherosm" data-aos="fade-up" data-aos-duration="1400" data-aos-delay="800" data-aos-once="true">
                                    TIGER<br>INVESTMENT</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->
  </main>
  @yield('content')
  @include('components.footer')
  {{-- <script src="{{ mix('js/app.js') }}" defer></script> --}}
</body>

<script>
  (function() {
    "use strict";
    const select = (el, all = false) => {
      el = el.trim()
      if (all) {
        return [...document.querySelectorAll(el)]
      } else {
        return document.querySelector(el)
      }
    }
    const on = (type, el, listener, all = false) => {
      if (all) {
        select(el, all).forEach(e => e.addEventListener(type, listener))
      } else {
        select(el, all).addEventListener(type, listener)
      }
    }
    const onscroll = (el, listener) => {
      el.addEventListener('scroll', listener)
    }
    if (select('.toggle-sidebar-btn')) {
      on('click', '.toggle-sidebar-btn', function(e) {
        select('body').classList.toggle('toggle-sidebar')
      })
    }
  })();
</script>

</html>
