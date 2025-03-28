<!DOCTYPE html>
<html lang="en" style="font-family: Poppins, sans-serif">

<head>
  <meta charset=" utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>Satoshistable</title>
  <link rel="icon" type="image/png" sizes="400x400" href="assetsWelcome/images/fivicon_tiger.png">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&amp;display=swap">
  <link rel="stylesheet" href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css">
  <link rel="stylesheet"
    href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
  <link rel="stylesheet" href="assetsWelcome/css/Navbar-Right-Links-icons.css">
  <link rel="stylesheet" href="assetsWelcome/css/Pricing-Centered-badges.css">
  <link rel="stylesheet" href="assetsWelcome/css/styles.css">
</head>

<body style="overflow-x: hidden;">
  <!-- Start: Navbar Right Links -->
  <nav class="navbar navbar-light navbar-expand-lg fixed-top shadow-sm navbarstyle">
    <div class="container"><a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}"><img
          src="assetsWelcome/images/logoinfinity.png?h=5b2238fd771ad327d130d4f21f09171a" width="56px"></a><button
        data-bs-toggle="collapse" class="navbar-toggler fs-6 fw-light text-white text-bg-warning shadow-lg"
        data-bs-target="#navcol-2"><span class="visually-hidden">Toggle navigation</span><span
          class="navbar-toggler-icon"></span></button>
      <div class="collapse navbar-collapse" id="navcol-2">
        <ul class="navbar-nav navbar-nav-scroll ms-auto">
          <li class="nav-item"><a class="nav-link active anavlink" href="{{ url('/cards') }}">@lang('leadpage.btn.cards')</a></li>
          <li class="nav-item"><a class="nav-link anavlink" href="{{ url('/accounts') }}">@lang('leadpage.btn.accounts')</a></li>
          <li class="nav-item"><a class="nav-link active anavlink" href="{{ url('/concierge') }}">@lang('leadpage.btn.concierge')</a>
          </li>
        </ul>
        @if (Route::has('login'))
          @auth
            <a role="button" class="btn link-warning ms-md-2 btnnavlog"
              href="{{ route('admin.home') }}">@lang('leadpage.btn.dashboard')</a>
          @else
            <a role="button" class="btn link-warning ms-md-2 btnnavlog" href="{{ route('login') }}">@lang('leadpage.btn.login')</a>
            @if (Route::has('register'))
              <a role="button" class="btn btn-warning ms-md-2 btnnav" href="{{ route('register') }}"
                data-aos="zoom-in-down" data-aos-duration="1600" data-aos-delay="1800"
                data-aos-once="true">@lang('leadpage.btn.join')</a>
            @endif
          @endauth
        @endif
      </div>
    </div>
  </nav>
  <!-- End: Navbar Right Links -->
  <section
    style="
                backdrop-filter: blur(0px);
                filter: brightness(120%) grayscale(0%) saturate(120%);
            "
    id="herosection">
    <div data-bss-scroll-zoom="true" data-bss-scroll-zoom-speed="0.5"
      style="
                    width: 100%;
                    height: 100vh;
                    background: linear-gradient(
                            rgba(0, 0, 0, 0.83),
                            rgba(0, 0, 0, 0.78)
                        ),
                        url('assetsWelcome/images/heroimg.png?h=19923c9d1c5b6e5752b86d1ffaf52718')
                            center / cover no-repeat;
                ">
      <div class="container h-100">
        <div class="row justify-content-center align-items-center h-100">
          <div
            class="col-md-10 col-lg-10 col-xl-8 d-flex d-sm-flex d-md-flex justify-content-center align-items-center mx-auto justify-content-md-start align-items-md-center justify-content-xl-center">
            <div class="text-center" style="margin: 0 auto">
              <p data-aos="fade" data-aos-duration="1500" data-aos-delay="400" data-aos-once="true" class="phero">
                @lang('leadpage.home.txt')
              </p>
              <h2 class="text-uppercase fw-bold mb-3 hhero hherosm" data-aos="fade-up" data-aos-duration="1400"
                data-aos-delay="800" data-aos-once="true">
                INFINITY<br />CLUB CARDS
              </h2>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section>
    <div class="espacoy">
      <!-- Start: 2 Rows 1+3 Columns -->
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center mb-5">
            <h6 class="text-black-50 plimit mb-4">
              @lang('leadpage.card.msg')<br />
            </h6>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 text-center hoveraccountcard py-4">
            <img class="img-fluid"
              src="assetsWelcome/images/card%20VIP%20PREMIUM%20MEMBER%20FRONT.png?h=3ca5177d04dd5864de5211750f855fda"
              width="320px" />
            <div class="my-4">
              <h6 class="h6card">@lang('leadpage.card.cards.standardtitle')</h6>
              <p class="text-black-50">
                @lang('leadpage.card.cards.standardsub')
              </p>
            </div>
            <a class="btn btn-dark d-block orderbtn orderbtnmarginsm" role="button"
              href="{{ route('register') }}">@lang('leadpage.card.cards.btn')</a>
          </div>
          <div class="col-md-4 text-center hoveraccountcard py-4">
            <img class="img-fluid"
              src="assetsWelcome/images/card%20platinumelitemember.png?h=3aec57128e4868c47ef6d36c56894189"
              width="320px" />
            <div class="my-4">
              <h6 class="h6card">@lang('leadpage.card.cards.stainlesstitle')</h6>
              <p class="text-black-50">@lang('leadpage.card.cards.stainlesssub')</p>
            </div>
            <a class="btn btn-dark d-block orderbtn orderbtnmarginsm" role="button"
              href="{{ route('register') }}">@lang('leadpage.card.cards.btn')</a>
          </div>
          <div class="col-md-4 text-center hoveraccountcard py-4">
            <img class="img-fluid" src="assetsWelcome/images/card%20elitegold.png?h=0df73af40aa7c388822c74c8e6778dab"
              width="320px" />
            <div class="my-4">
              <h6 class="h6card">@lang('leadpage.card.cards.limitedtitle')</h6>
              <p class="text-black-50">@lang('leadpage.card.cards.limitedsub')</p>
            </div>
            <a class="btn btn-dark d-block orderbtn orderbtnmarginsm" role="button"
              href="{{ route('register') }}">@lang('leadpage.card.cards.btn')</a>
          </div>
        </div>
      </div>
      <!-- End: 2 Rows 1+3 Columns -->
    </div>
  </section>
  <section>
    <!-- Start: Pricing Clean -->
    <div class="container py-4 py-xl-5">
      <div class="row mb-5">
        <div class="col-md-8 col-xl-6 text-center mx-auto">
          <h2>@lang('leadpage.home.pricingtable')</h2>
        </div>
      </div>
      <div class="row gx-3 gy-3 row-cols-md-2 row-cols-xl-4 row-cols-xxl-4">
        @forelse ($packages as $package)
          <div class="col-md-6 col-lg-3">
            <div class="card h-100 shad" data-aos="flip-right" data-aos-duration="800" data-aos-once="true">
              <div class="card-body d-flex flex-column justify-content-between p-4">
                <div>
                  <h5 class="text-uppercase text-muted">{{ $package->name }}</h5>
                  <h6 class="fw-bold">@lang('leadpage.home.fee')</h6>
                  <h1 class="display-5 fw-bold">${{ number_format($package->price, 0) }}</h1>
                  <hr>
                  {{-- {!! $package->description_fees !!} --}}
                  {!! htmlspecialchars($package->description_fees, ENT_QUOTES, 'UTF-8', false) !!}

                  <!-- <ul class="list-unstyled">
                                    <li class="d-flex mb-2"><span> <i class="la la-chevron-circle-right"></i>&nbsp; Fiat Multi-Currency Account&nbsp;<br></span></li>
                                    <li class="d-flex mb-2"><span><i class="la la-chevron-circle-right"></i>&nbsp; Crypto Multi-Currency Account&nbsp;<br></span></li>
                                    <li class="d-flex mb-2"><span><i class="la la-chevron-circle-right"></i>&nbsp; USD, EUR, GBP, CNY, JPY Accounts<br></span></li>
                                    <li class="d-flex mb-2"><span><i class="la la-chevron-circle-right"></i>&nbsp; BTC, ETH, USDT Accounts&nbsp;<br></span></li>
                                    <li class="d-flex mb-2"><span><i class="la la-chevron-circle-right"></i>&nbsp; Classic Membership Card<br></span></li>
                                    <li class="d-flex mb-2"><span><i class="la la-chevron-circle-right"></i>&nbsp; Quick wallet-to-wallet transfers&nbsp;<br></span></li>
                                    <li class="d-flex mb-2"><span><i class="la la-chevron-circle-right"></i>&nbsp; $12 for monthly membership&nbsp;<br></span></li>
                                    <li class="d-flex mb-2"><span><i class="la la-chevron-circle-right"></i>&nbsp; $3.000 Daily card load limit<br></span></li>
                                    <li class="d-flex mb-2"><span><i class="la la-chevron-circle-right"></i>&nbsp; $3.000 Daily Spent limit<br></span></li>
                                    <li class="d-flex mb-2"><span><i class="la la-chevron-circle-right"></i>&nbsp; Not Possible ATM withdrawal limit&nbsp;<br></span></li>
                                    <li class="d-flex mb-2"><span><i class="la la-chevron-circle-right"></i>&nbsp; $100.000 Bank account load limit&nbsp;<br></span></li>
                                    <li class="d-flex mb-2"><span><i class="la la-chevron-circle-right"></i>&nbsp; 24/7 Concierge Team<br></span></li>
                                    <li class="d-flex mb-2"><span><i class="la la-chevron-circle-right"></i>&nbsp; Free transfers to other club members<br></span></li>
                                    <li class="d-flex mb-2"><span><i class="la la-chevron-circle-right"></i>&nbsp; Up to 40% off Travel&nbsp;<br></span></li>
                                    <li class="d-flex mb-2"><span><i class="la la-chevron-circle-right"></i>&nbsp; Dedicated phone hotline support<br></span></li>
                                </ul> -->
                </div><a class="btn btn-dark d-block w-100" role="button" href="{{ route('register') }}">GET
                  {{ $package->name }}</a>
              </div>
            </div>
          </div>
        @empty
        @endforelse
      </div>
    </div><!-- End: Pricing Clean -->
  </section>
  <section class="bg-dark">
    <div>
      <!-- Start: 1 Row 2 Columns -->
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6 py-5" style="text-align: center; min-height: 400px">
            <div class="d-flex align-items-center divimg">
              <img class="img-fluid" data-aos="fade-right" data-aos-duration="1800" data-aos-once="true"
                src="assetsWelcome/images/cardimggirl.png?h=a2c995b0073854a5b6bd4db8c9399f2f" width="600px"
                style="margin: auto" />
            </div>
          </div>
          <div class="col-md-6 columncardr py-5">
            <h2 class="mb-3">
              @lang('leadpage.card.flexible')<br />
            </h2>
            <ul class="list-unstyled text-start my-5">
              <li class="text-black-50 mb-1">
                <i class="la la-chevron-circle-right"></i>&nbsp; @lang('leadpage.card.flexible1')<br />
              </li>
              <li class="text-black-50 mb-1">
                <i class="la la-chevron-circle-right"></i>&nbsp; @lang('leadpage.card.flexible2')&nbsp;<br />
              </li>
              <li class="text-black-50 mb-1">
                <i class="la la-chevron-circle-right"></i>&nbsp; @lang('leadpage.card.flexible3')<br />
              </li>
              <li class="text-black-50 mb-1">
                <i class="la la-chevron-circle-right"></i>&nbsp; @lang('leadpage.card.flexible4')&nbsp;<br />
              </li>
            </ul>
            <a class="btn btn-dark d-block orderbtn orderbtnmarginsm" role="button"
              href="{{ route('register') }}">@lang('leadpage.card.cards.btn')</a>
          </div>
        </div>
      </div>
      <!-- End: 1 Row 2 Columns -->
    </div>
  </section>
  <section class="bg-dark">
    <div>
      <!-- Start: 1 Row 2 Columns -->
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6 order-md-last py-5" style="text-align: center; min-height: 400px">
            <div class="d-flex align-items-center divimg">
              <img class="img-fluid" data-aos="fade-left" data-aos-duration="1800" data-aos-once="true"
                src="assetsWelcome/images/cardmaq.png?h=fed495f0f7405973d010a91bbae969d2" width="400px"
                style="margin: auto" />
            </div>
          </div>
          <div class="col-md-6 columncardr py-5">
            <h2 class="mb-3">
              @lang('leadpage.card.payment')<br />
            </h2>
            <ul class="list-unstyled text-start my-5">
              <li class="text-black-50 mb-1">
                <i class="la la-chevron-circle-right"></i>&nbsp; @lang('leadpage.card.payment1')<br />
              </li>
              <li class="text-black-50 mb-1">
                <i class="la la-chevron-circle-right"></i>&nbsp; @lang('leadpage.card.payment2')&nbsp;<br />
              </li>
              <li class="text-black-50 mb-1">
                <i class="la la-chevron-circle-right"></i>&nbsp; @lang('leadpage.card.payment3')<br />
              </li>
              <li class="text-black-50 mb-1">
                <i class="la la-chevron-circle-right"></i>&nbsp; @lang('leadpage.card.payment4')<br />
              </li>
            </ul>
            <a class="btn btn-dark d-block orderbtn orderbtnmarginsm" role="button"
              href="{{ route('register') }}">@lang('leadpage.card.cards.btn')</a>
          </div>
        </div>
      </div>
      <!-- End: 1 Row 2 Columns -->
    </div>
  </section>
  <section>
    <div>
      <h1 class="mb-0 FAQhead">@lang('leadpage.card.faq.title')</h1>
      <div class="accordion accordion-flush accordionbg" role="tablist" id="accordion-1">
        <div class="accordion-item accordionbg">
          <h2 class="accordion-header" role="tab">
            <button class="accordion-button collapsed fs-3 accordionbg" data-bs-toggle="collapse"
              data-bs-target="#accordion-1 .item-1" aria-expanded="false" aria-controls="accordion-1 .item-1">
              @lang('leadpage.card.faq.question1')
            </button>
          </h2>
          <div class="accordion-collapse collapse item-1" role="tabpanel" data-bs-parent="#accordion-1">
            <div class="accordion-body">
              <p class="mb-0 px-md-5">
                @lang('leadpage.card.faq.resp1')
              </p>
            </div>
          </div>
        </div>
        <div class="accordion-item accordionbg">
          <h2 class="accordion-header" role="tab">
            <button class="accordion-button collapsed fs-3 accordionbg" data-bs-toggle="collapse"
              data-bs-target="#accordion-1 .item-2" aria-expanded="false" aria-controls="accordion-1 .item-2">
              @lang('leadpage.card.faq.question2')
            </button>
          </h2>
          <div class="accordion-collapse collapse item-2" role="tabpanel" data-bs-parent="#accordion-1">
            <div class="accordion-body">
              <p class="mb-0 px-md-5">
                @lang('leadpage.card.faq.resp2')
              </p>
            </div>
          </div>
        </div>
        <div class="accordion-item accordionbg">
          <h2 class="accordion-header" role="tab">
            <button class="accordion-button collapsed fs-3 accordionbg" data-bs-toggle="collapse"
              data-bs-target="#accordion-1 .item-3" aria-expanded="false" aria-controls="accordion-1 .item-3">
              @lang('leadpage.card.faq.question3')
            </button>
          </h2>
          <div class="accordion-collapse collapse item-3" role="tabpanel" data-bs-parent="#accordion-1">
            <div class="accordion-body">
              <p class="mb-2 px-md-5">
                @lang('leadpage.card.faq.resp3')
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Start: Banner Clean -->
  <section>
    <div>
      <!-- Start: Banner Clean -->
      <section class="bg-dark">
        <div class="container">
          <div class="text-center p-4 p-lg-5">
            <h1 class="fw-bold text-light mb-4">@lang('leadpage.footer.ready')</h1>
            <a role="button" class="btn fs-5 link-light me-4 py-2 px-4 btnregist"
              href="{{ route('login') }}">@lang('leadpage.btn.login')</a>
            <a role="button" class="btn btn-primary fs-5 text-bg-light py-2 px-4" href="{{ route('register') }}"
              data-aos="fade" data-aos-duration="1500" data-aos-delay="600"
              data-aos-once="true">@lang('leadpage.btn.join')</a>
            <!--
                        <button class="btn fs-5 link-light me-4 py-2 px-4 btnregist" type="button">REGISTER</button>
                        <button class="btn btn-primary fs-5 text-bg-light py-2 px-4" type="submit" style="border-style: none;">JOIN NOW!</button>
                        -->
          </div>
        </div>
      </section><!-- End: Banner Clean -->
    </div>
  </section>
  <!-- Start: Footer Dark -->
  <footer class="text-center bg-dark">
    <div class="espacoy">
      <!-- Start: 1 Row 1 Column -->
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <p class="text-center text-white"></p>
            <h5 class="text-start text-white mb-3">@lang('leadpage.footer.product')</h5>
            <div class="d-flex align-items-lg-center mb-2"><a class="d-block footerlink" href="#modal-1"
                data-bs-target="#modal-1" data-bs-toggle="modal">@lang('leadpage.footer.productbtn.txt_footer2')</a></div>
            <div class="d-flex align-items-lg-center mb-2"><a class="d-block footerlink" href="#modal-2"
                data-bs-target="#modal-2" data-bs-toggle="modal">@lang('leadpage.footer.productbtn.txt_footer1')</a></div>
            <div class="d-flex align-items-lg-center mb-2"><a class="d-block footerlink"
                href=" {{ url('/accounts') }}" data-bs-target="" data-bs-toggle="">@lang('leadpage.footer.productbtn.txt_footer3')</a></div>
            <div class="d-flex align-items-lg-center mb-2"><a class="d-block footerlink" href="#modal-4"
                data-bs-target="#modal-4" data-bs-toggle="modal">@lang('leadpage.footer.productbtn.txt_footer4')</a></div>
            <div class="d-flex align-items-lg-center mb-2"><a class="d-block footerlink" href="{{ url('/fees') }}"
                data-bs-target="" data-bs-toggle="">@lang('leadpage.footer.productbtn.txt_footer6')</a></div>
            <div class="d-flex align-items-lg-center mb-2"><a class="d-block footerlink"
                href="{{ url('/concierge') }}" data-bs-target="" data-bs-toggle="">@lang('leadpage.footer.productbtn.txt_footer5')</a></div>
          </div>
          <div class="col-md-3 ">
            <p class="text-center text-white"></p>
            <h5 class="text-start text-white mb-3">@lang('leadpage.btn.language')</h5>
            <div class="d-flex align-items-lg-center mb-2"><img class="me-2"
                src="assetsWelcome/images/flaguk.png?h=0c7390cbfbfc9edfeaa340414b8fcccf" width="20px"
                height="20px"><a class="d-block footerlink" href="/setlocale/en">@lang('leadpage.btn.english')</a></div>
            <div class="d-flex align-items-lg-center mb-2"><img class="me-2"
                src="assetsWelcome/images/flagspa.png?h=82b1ec4cf037271f6fac3cb3a83072e5" width="20px"
                height="20px"><a class="d-block footerlink" href="/setlocale/es">@lang('leadpage.btn.spanish')</a></div>
            <div class="d-flex align-items-lg-center mb-2"><img class="me-2"
                src="assetsWelcome/images/flagger.png?h=4e906449aca319bcf7fed73fb806e14f" width="20px"
                height="20px"><a class="d-block footerlink" href="/setlocale/de">@lang('leadpage.btn.german')</a></div>
            <div class="d-flex align-items-lg-center"><img class="me-2"
                src="assetsWelcome/images/flagfr.png?h=af5123cb6532b4278a2cdb445e0a130f" width="20px"
                height="20px"><a class="d-block footerlink" href="/setlocale/fr">@lang('leadpage.btn.french')</a></div>
            <h5 class="text-start text-white"></h5>
            <h5 class="text-start text-white"></h5>
          </div>
          <div class=" col-md-3 text-center d-flex justify-content-center align-items-center">
            <ul class="list-inline d-lg-flex align-items-lg-end margintopsm">
              <li class="list-inline-item me-4"><a href="https://t.me/+drM85fbPywtkNDQ0" class="footerlink"><i
                    class="lab la-telegram iconwid"></i></a></li>
              <li class="list-inline-item me-4"><a href="https://www.instagram.com/Infinityclubcards_official/"
                  class="footerlink"><i class="la la-instagram iconwid"></i></a></li>
              <li class="list-inline-item me-4"><a href="#" class="footerlink"><i
                    class="la la-facebook iconwid"></i></a></li>
              <li class="list-inline-item me-4"><a href="#" class="footerlink"><i
                    class="la la-twitter iconwid"></i></a></li>
            </ul>
          </div>
        </div>
        <div class="row pt-4 mt-5">
          <div class="col">
            <p class="text-center text-white-50 mb-0">@lang('leadpage.footer.please')</p>
            <h1 class="text-white mb-3">@lang('leadpage.footer.disclaimer')</h1>
            <p style="text-align: justify;" class="pfooter">@lang('leadpage.footer.footertxt')<br></p>
            <p class="text-muted mt-5 mb-0">@lang('leadpage.footer.copyright') INFINITY CLUBCARDS</p>
          </div>
        </div>
      </div>
      <!-- End: 1 Row 1 Column -->
    </div>
  </footer>
  <!-- End: Footer Dark -->
  <!-- Start: Modais -->
  <section>
    <div style="overflow-x: hidden !important">
      <div class="modal fade" role="dialog" tabindex="-1" id="modal-1">
        <div class="modal-dialog modal-lg modal-dialog-scrollable modal-fullscreen-md-down" role="document">
          <div class="modal-content">
            <div class="modal-header text-white-50 bg-dark">
              <h3 class="modal-title">
                <span style="color: rgb(150, 150, 150);">
                  Buy Crypto
                </span>
              </h3>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bgmodal">
              <div class="col-md-12 text-center mb-5">
                <h1>@lang('leadpage.accounts.freedom.title')</h1>
                <p class="text-black-50 plimit mb-4">
                  @lang('leadpage.accounts.freedom.text')<br />
                </p>
              </div>
              <div class="col-md-12 text-center">
                <h2 class="mb-3">@lang('leadpage.accounts.cryptocurrencies')<br /></h2>
                <ul class="list-unstyled text-start px-5 my-5">
                  <li class="text-black-50 mb-1">
                    <i class="la la-chevron-circle-right"></i>&nbsp; @lang('leadpage.accounts.cryptocurrencies1')<br />
                  </li>
                  <li class="text-black-50 mb-1">
                    <i class="la la-chevron-circle-right"></i>&nbsp; @lang('leadpage.accounts.cryptocurrencies2')&nbsp;<br />
                  </li>
                  <li class="text-black-50 mb-1">
                    <i class="la la-chevron-circle-right"></i>&nbsp; @lang('leadpage.accounts.cryptocurrencies3')&nbsp;<br />
                  </li>
                  <li class="text-black-50 mb-1">
                    <i class="la la-chevron-circle-right"></i>&nbsp; @lang('leadpage.accounts.cryptocurrencies4')&nbsp;<br />
                  </li>
                  <li class="text-black-50 mb-1">
                    <i class="la la-chevron-circle-right"></i>&nbsp; @lang('leadpage.accounts.cryptocurrencies5')<br />
                  </li>
                  <li class="text-black-50 mb-1">
                    <i class="la la-chevron-circle-right"></i>&nbsp; @lang('leadpage.accounts.cryptocurrencies6')<br />
                  </li>
                  <li class="text-black-50 mb-1">
                    <i class="la la-chevron-circle-right"></i>&nbsp; @lang('leadpage.accounts.cryptocurrencies7')<br />
                  </li>
                  <li class="text-black-50 mb-1">
                    <i class="la la-chevron-circle-right"></i>&nbsp; @lang('leadpage.accounts.cryptocurrencies8')&nbsp;<br />
                  </li>
                  <li class="text-black-50 mb-1">
                    <i class="la la-chevron-circle-right"></i>&nbsp; @lang('leadpage.accounts.cryptocurrencies9')<br />
                  </li>
                  <li class="text-black-50 mb-1">
                    <i class="la la-chevron-circle-right"></i>&nbsp; @lang('leadpage.accounts.cryptocurrencies10')&nbsp;<br />
                  </li>
                  <li class="text-black-50 mb-1">
                    <i class="la la-chevron-circle-right"></i>&nbsp; @lang('leadpage.accounts.cryptocurrencies11')&nbsp;<br />
                  </li>
                  <li class="text-black-50 mb-1">
                    <i class="la la-chevron-circle-right"></i>&nbsp; @lang('leadpage.accounts.cryptocurrencies12')<br />
                  </li>
                </ul>
                <a class="btn btn-dark d-block orderbtn mt-5" role="button"
                  href="{{ route('register') }}">@lang('leadpage.accounts.freedom.btn')</a>
              </div>
            </div>
            <div class="modal-footer text-white-50 bg-dark">
              <button class="btn btn-warning w-25" type="button" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" role="dialog" tabindex="-1" id="modal-2">
        <div class="modal-dialog modal-lg modal-dialog-scrollable modal-fullscreen-md-down" role="document">
          <div class="modal-content">
            <div class="modal-header text-white-50 bg-dark">
              <h3 class="modal-title">
                <span style="color: rgb(150, 150, 150);">
                  Crypto to Cash
                </span>
              </h3>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bgmodal">
              <div class="col-md-12 text-center mb-5">
                <h1>@lang('leadpage.accounts.freedom.title')</h1>
                <p class="text-black-50 plimit mb-4">
                  @lang('leadpage.accounts.freedom.text')<br />
                </p>
              </div>
              <div class="col-md-12 text-center">
                <h2 class="mb-3">@lang('leadpage.accounts.traditional')<br /></h2>
                <ul class="list-unstyled text-start px-5 my-5">
                  <li class="text-black-50 mb-1">
                    <i class="la la-chevron-circle-right"></i>&nbsp; @lang('leadpage.accounts.traditional1')<br />
                  </li>
                  <li class="text-black-50 mb-1">
                    <i class="la la-chevron-circle-right"></i>&nbsp; @lang('leadpage.accounts.traditional2')<br />
                  </li>
                  <li class="text-black-50 mb-1">
                    <i class="la la-chevron-circle-right"></i>&nbsp; @lang('leadpage.accounts.traditional3')<br />
                  </li>
                  <li class="text-black-50 mb-1">
                    <i class="la la-chevron-circle-right"></i>&nbsp; @lang('leadpage.accounts.traditional4')<br />
                  </li>
                  <li class="text-black-50 mb-1">
                    <i class="la la-chevron-circle-right"></i>&nbsp; @lang('leadpage.accounts.traditional5')<br />
                  </li>
                  <li class="text-black-50 mb-1">
                    <i class="la la-chevron-circle-right"></i>&nbsp; @lang('leadpage.accounts.traditional6')&nbsp;<br />
                  </li>
                  <li class="text-black-50 mb-1">
                    <i class="la la-chevron-circle-right"></i>&nbsp; @lang('leadpage.accounts.traditional7')&nbsp;<br />
                  </li>
                  <li class="text-black-50 mb-1">
                    <i class="la la-chevron-circle-right"></i>&nbsp; @lang('leadpage.accounts.traditional8')<br />
                  </li>
                  <li class="fs-6 text-black-50 mb-1 mt-4">
                    @lang('leadpage.accounts.traditional9')<br />
                  </li>
                </ul>
                <a class="btn btn-dark d-block orderbtn mt-5" role="button"
                  href="{{ route('register') }}">@lang('leadpage.accounts.freedom.btn')</a>
              </div>
            </div>
            <div class="modal-footer text-white-50 bg-dark">
              <button class="btn btn-warning w-25" type="button" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
      <!-- <div class="modal fade" role="dialog" tabindex="-1" id="modal-3">
                <div class="modal-dialog modal-lg modal-dialog-scrollable modal-fullscreen-md-down" role="document">
                    <div class="modal-content">
                        <div class="modal-header text-white-50 bg-dark">
                            <h4 class="modal-title">Crypto to Crypto</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Aguardando conteudo</p>
                        </div>
                        <div class="modal-footer text-white-50 bg-dark"><button class="btn btn-warning w-25" type="button" data-bs-dismiss="modal">Close</button></div>
                    </div>
                </div>
            </div> -->
      <div class="modal fade" role="dialog" tabindex="-1" id="modal-4">
        <div class="modal-dialog modal-lg modal-dialog-scrollable modal-fullscreen-md-down" role="document">
          <div class="modal-content">
            <div class="modal-header text-white-50 bg-dark">
              <h4 class="modal-title">Spend Crypto</h4><button type="button" class="btn-close"
                data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bgmodal">
              <div class="col-md-12 text-center mb-5">
                <h1>PAY YOUR WAY, IN STYLE</h1>
                <p class="text-black-50 plimit mb-4">
                  A card that allows you to spend digital and traditional currencies seamlessly anywhere in the world.
                  Spend 150+ currencies at millions of retailers and service providers, in store or online.<br />
                </p>
              </div>
              <div class="col-md-12 text-center">
                <h2 class=""> @lang('leadpage.card.flexible')<br /><br /></h2>
                <ul class="list-unstyled text-start px-5 mb-5">
                  <li class="text-black-50 mb-1">
                    <i class="la la-chevron-circle-right"></i>&nbsp; @lang('leadpage.card.flexible1')<br />
                  </li>
                  <li class="text-black-50 mb-1">
                    <i class="la la-chevron-circle-right"></i>&nbsp; @lang('leadpage.card.flexible2')&nbsp;<br />
                  </li>
                  <li class="text-black-50 mb-1">
                    <i class="la la-chevron-circle-right"></i>&nbsp; @lang('leadpage.card.flexible3')<br />
                  </li>
                  <li class="text-black-50 mb-1">
                    <i class="la la-chevron-circle-right"></i>&nbsp; @lang('leadpage.card.flexible4')&nbsp;<br />
                  </li>
                </ul>
                <!-- <a class="btn btn-dark d-block orderbtn mt-5" role="button" href="#">@lang('leadpage.card.cards.btn')</a> -->
              </div>
              <div class="col-md-12 text-center">
                <h2 class="mb-3"> @lang('leadpage.card.payment')<br /></h2>
                <ul class="list-unstyled text-start px-5 my-5">
                  <li class="text-black-50 mb-1">
                    <i class="la la-chevron-circle-right"></i>&nbsp; @lang('leadpage.card.payment1')<br />
                  </li>
                  <li class="text-black-50 mb-1">
                    <i class="la la-chevron-circle-right"></i>&nbsp; @lang('leadpage.card.payment2')&nbsp;<br />
                  </li>
                  <li class="text-black-50 mb-1">
                    <i class="la la-chevron-circle-right"></i>&nbsp; @lang('leadpage.card.payment3')<br />
                  </li>
                  <li class="text-black-50 mb-1">
                    <i class="la la-chevron-circle-right"></i>&nbsp; @lang('leadpage.card.payment4')<br />
                  </li>
                </ul>
                <a class="btn btn-dark d-block orderbtn mt-5" role="button"
                  href="{{ route('register') }}">@lang('leadpage.card.cards.btn')</a>
              </div>
            </div>
            <div class="modal-footer text-white-50 bg-dark"><button class="btn btn-warning w-25" type="button"
                data-bs-dismiss="modal">Close</button></div>
          </div>
        </div>
      </div>
      <!-- <div class="modal fade" role="dialog" tabindex="-1" id="modal-5">
                <div class="modal-dialog modal-lg modal-dialog-scrollable modal-fullscreen-md-down" role="document">
                    <div class="modal-content">
                        <div class="modal-header text-white-50 bg-dark">
                            <h4 class="modal-title">FEES</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Aguardando conteudo</p>
                        </div>
                        <div class="modal-footer text-white-50 bg-dark"><button class="btn btn-warning w-25" type="button" data-bs-dismiss="modal">Close</button></div>
                    </div>
                </div>
            </div>
            <div class="modal fade" role="dialog" tabindex="-1" id="modal-6">
                <div class="modal-dialog modal-lg modal-dialog-scrollable modal-fullscreen-md-down" role="document">
                    <div class="modal-content">
                        <div class="modal-header text-white-50 bg-dark">
                            <h4 class="modal-title">24/7 Concierge Services</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Aguardando conteudo</p>
                        </div>
                        <div class="modal-footer text-white-50 bg-dark"><button class="btn btn-warning w-25" type="button" data-bs-dismiss="modal">Close</button></div>
                    </div>
                </div>
            </div> -->
    </div>
  </section>
  <!-- End: Modais -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/bs-init.js?h=db5f9301c4983e5b4f628e197406cbdd"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
</body>

</html>
