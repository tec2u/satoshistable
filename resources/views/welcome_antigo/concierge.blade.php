<!DOCTYPE html>
<html lang="en" style="font-family: Poppins, sans-serif;">

<head>
    meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>infinityclubcards</title>
    <link rel="icon" type="image/png" href="../assetsWelcome/images/favicon.png" />
    <link rel="stylesheet" href="assetsWelcome/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assetsWelcome/css/Poppins.css" />
    <link rel="stylesheet" href="assetsWelcome/fonts/line-awesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="assetsWelcome/css/Navbar-Right-Links-icons.css" />
    <link rel="stylesheet" href="assetsWelcome/css/Pricing-Centered-badges.css" />
    <link rel="stylesheet" href="assetsWelcome/css/styles.css" />
</head>

<body style="overflow-x: hidden;font-family: Poppins, sans-serif;">
    <!-- Start: Navbar Right Links -->
    <nav class="navbar navbar-light navbar-expand-lg fixed-top shadow-sm navbarstyle">
        <div class="container"><a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}"><img src="./assetsWelcome/images/nolimitslogo.png" width="56px"></a><button data-bs-toggle="collapse" class="navbar-toggler fs-6 fw-light text-white text-bg-warning shadow-lg" data-bs-target="#navcol-2"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-2">
                <ul class="navbar-nav navbar-nav-scroll ms-auto">
                    <li class="nav-item"><a class="nav-link active anavlink" href="{{ url('/cards') }}">@lang('leadpage.btn.cards')</a></li>
                    <li class="nav-item"><a class="nav-link active anavlink" href="{{ url('/accounts') }}">@lang('leadpage.btn.accounts')</a></li>
                    <li class="nav-item"><a class="nav-link active anavlink" href="{{ url('/concierge') }}">@lang('leadpage.btn.concierge')</a></li>
                </ul>
                @if (Route::has('login'))
                @auth
                <a href="{{ route('admin.home') }}" role="button" data-aos="zoom-in-down" data-aos-duration="1500" data-aos-delay="2600" data-aos-once="true"><button class="btn btn-warning ms-md-2 btnnav">@lang('leadpage.btn.dashboard')</button></a>
                @else
                <a class="btn link-warning ms-md-2 btnnavlog" role="button" href="{{ route('login') }}">@lang('leadpage.btn.login')</a>
                @if (Route::has('register'))
                <a class="btn btn-warning ms-md-2 btnnav" role="button" data-aos="zoom-in-down" data-aos-duration="1500" data-aos-delay="2600" data-aos-once="true" href="{{ route('register') }}">@lang('leadpage.btn.join')</a>
                @endif
                @endauth
                @endif
            </div>
        </div>
    </nav><!-- End: Navbar Right Links -->
    <section style="backdrop-filter: blur(0px);filter: brightness(120%) grayscale(0%) saturate(120%);" id="herosection">
        <div data-bss-scroll-zoom="true" data-bss-scroll-zoom-speed="0.5" style="width: 100%;height: 100vh;background: linear-gradient(rgba(0,0,0,0.83), rgba(0,0,0,0.78)), url(&quot;assets/img/heroimg.png&quot;) center / cover no-repeat;">
            <div class="container h-100">
                <div class="row justify-content-center align-items-center h-100">
                    <div class="col-md-10 col-lg-10 col-xl-8 d-flex d-sm-flex d-md-flex justify-content-center align-items-center mx-auto justify-content-md-start align-items-md-center justify-content-xl-center">
                        <div class="text-center" style="margin: 0 auto;">
                            <p data-aos="fade" data-aos-duration="1500" data-aos-delay="400" data-aos-once="true" class="phero">WELCOME TO THE WORLD OF</p>
                            <h2 class="text-uppercase fw-bold mb-3 hhero hherosm" data-aos="fade-up" data-aos-duration="1400" data-aos-delay="800" data-aos-once="true">INFINITY<br>CLUB CARDS</h2>
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
                        <h1>Heading</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-lg-4 text-center">
                        <div class="my-4">
                            <h6 class="h6card">STANDARD PLASTIC CARD</h6><i class="la la-briefcase text-warning iconv" data-aos="fade" data-aos-duration="800" data-aos-delay="200"></i>
                        </div>
                        <p class="text-black-50">Starter &amp; Premier membership</p>
                    </div>
                    <div class="col-md-6 col-lg-4 text-center">
                        <div class="my-4">
                            <h6 class="h6card">STANDARD PLASTIC CARD</h6><i class="la la-briefcase text-warning iconv" data-aos="fade" data-aos-duration="800" data-aos-delay="200"></i>
                            <p class="text-black-50">Starter &amp; Premier membership</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 text-center">
                        <div class="my-4">
                            <h6 class="h6card">STANDARD PLASTIC CARD</h6><i class="la la-briefcase text-warning iconv" data-aos="fade" data-aos-duration="800" data-aos-delay="200"></i>
                            <p class="text-black-50">Starter &amp; Premier membership</p>
                        </div>
                    </div>
                </div>
            </div><!-- End: 2 Rows 1+3 Columns --><a class="btn btn-warning d-block orderbtn mt-5" role="button" href="#"><span style="color: var(--bs-btn-hover-color); background-color: var(--bs-btn-hover-bg);">ORDER CARD</span></a>
        </div>
    </section>
    <section style="background: var(--bs-black);">
        <!-- Start: 1 Row 2 Columns -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-auto col-md-6 section50vh" style="padding-right: 0;padding-left: 0;background: #25292F;">
                    <div style="width: 100%;overflow: hidden;"></div><img src="assets/img/praia.jpg" height="100%">
                </div>
                <div class="col-md-6" style="background: #ffffff;padding-top: 40px;padding-bottom: 40px;">
                    <h1>@lang('leadpage.concierge.cards.luxurytitle')</h1>
                    <p>@lang('leadpage.concierge.cards.luxurysub')</p>
                </div>
            </div>
        </div><!-- End: 1 Row 2 Columns -->
    </section>
    <section>
        <div>
            <!-- Start: Features Cards -->
            <div class="container py-4 py-xl-5">
                <div class="row mb-5">
                    <div class="col-md-8 col-xl-6 text-center mx-auto">
                        <h2>Heading</h2>
                        <p class="w-lg-50">Curae hendrerit donec commodo hendrerit egestas tempus, turpis facilisis nostra nunc. Vestibulum dui eget ultrices.</p>
                    </div>
                </div>
                <div class="row gy-4 row-cols-1 row-cols-md-2 row-cols-xl-3">
                    <div class="col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body text-center p-4"><img>
                                <h4 class="card-title">Title</h4>
                                <p class="card-text">Erat netus est hendrerit, nullam et quis ad cras porttitor iaculis. Bibendum vulputate cras aenean.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body text-center p-4"><img>
                                <h4 class="card-title">Title</h4>
                                <p class="card-text">Erat netus est hendrerit, nullam et quis ad cras porttitor iaculis. Bibendum vulputate cras aenean.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body text-center p-4"><img>
                                <h4 class="card-title">Title</h4>
                                <p class="card-text">Erat netus est hendrerit, nullam et quis ad cras porttitor iaculis. Bibendum vulputate cras aenean.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body text-center p-4"><img>
                                <h4 class="card-title">Title</h4>
                                <p class="card-text">Erat netus est hendrerit, nullam et quis ad cras porttitor iaculis. Bibendum vulputate cras aenean.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body text-center p-4"><img>
                                <h4 class="card-title">Title</h4>
                                <p class="card-text">Erat netus est hendrerit, nullam et quis ad cras porttitor iaculis. Bibendum vulputate cras aenean.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body text-center p-4"><img>
                                <h4 class="card-title">Title</h4>
                                <p class="card-text">Erat netus est hendrerit, nullam et quis ad cras porttitor iaculis. Bibendum vulputate cras aenean.</p>
                            </div>
                        </div>
                    </div>
                </div><a class="btn btn-warning d-block orderbtn mt-5" role="button" href="#"><span style="color: var(--bs-btn-hover-color); background-color: var(--bs-btn-hover-bg);">ORDER CARD</span></a>
            </div><!-- End: Features Cards -->
        </div>
    </section>
    <section>
        <div>
            <div class="accordion accordionbg" role="tablist" id="accordion-1">
                <div class="accordion-item accordionbg">
                    <h2 class="accordion-header" role="tab"><button class="accordion-button accordionbg" data-bs-toggle="collapse" data-bs-target="#accordion-1 .item-1" aria-expanded="true" aria-controls="accordion-1 .item-1" style="background: rgb(255,193,7);">@lang('leadpage.concierge.faq.question1')</button></h2>
                    <div class="accordion-collapse collapse show item-1" role="tabpanel" data-bs-parent="#accordion-1">
                        <div class="accordion-body">
                            <p class="mb-0">@lang('leadpage.concierge.faq.resp1')</p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item accordionbg">
                    <h2 class="accordion-header" role="tab"><button class="accordion-button accordionbg" data-bs-toggle="collapse" data-bs-target="#accordion-1 .item-1" aria-expanded="true" aria-controls="accordion-1 .item-1" style="background: rgb(255,193,7);">@lang('leadpage.concierge.faq.question2')</button></h2>
                    <div class="accordion-collapse collapse show item-1" role="tabpanel" data-bs-parent="#accordion-1">
                        <div class="accordion-body">
                            <p class="mb-0">@lang('leadpage.concierge.faq.resp2')</p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item accordionbg">
                    <h2 class="accordion-header" role="tab"><button class="accordion-button collapsed accordionbg" data-bs-toggle="collapse" data-bs-target="#accordion-1 .item-2" aria-expanded="false" aria-controls="accordion-1 .item-2" style="background: rgb(255,193,7);">@lang('leadpage.concierge.faq.question3')</button></h2>
                    <div class="accordion-collapse collapse item-2" role="tabpanel" data-bs-parent="#accordion-1">
                        <div class="accordion-body">
                            <p class="mb-0">@lang('leadpage.concierge.faq.resp3')</p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item accordionbg">
                    <h2 class="accordion-header" role="tab"><button class="accordion-button collapsed accordionbg" data-bs-toggle="collapse" data-bs-target="#accordion-1 .item-3" aria-expanded="false" aria-controls="accordion-1 .item-3" style="background: rgb(255,193,7);">@lang('leadpage.concierge.faq.question4')</button></h2>
                    <div class="accordion-collapse collapse item-3" role="tabpanel" data-bs-parent="#accordion-1">
                        <div class="accordion-body">
                            <p class="mb-0">@lang('leadpage.concierge.faq.resp4')</p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item accordionbg">
                    <h2 class="accordion-header" role="tab"><button class="accordion-button collapsed accordionbg" data-bs-toggle="collapse" data-bs-target="#accordion-1 .item-3" aria-expanded="false" aria-controls="accordion-1 .item-3" style="background: rgb(255,193,7);">@lang('leadpage.concierge.faq.question5')</button></h2>
                    <div class="accordion-collapse collapse item-3" role="tabpanel" data-bs-parent="#accordion-1">
                        <div class="accordion-body">
                            <p class="mb-0">@lang('leadpage.concierge.faq.resp5')</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- Start: Footer Dark -->
    <footer class="text-center bg-dark">
        <div class="espacoy">
            <!-- Start: 1 Row 1 Column -->
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <p class="text-center text-white"></p>
                        <h5 class="text-start text-white mb-3">@lang('leadpage.footer.product')</h5>
                        <div class="d-flex align-items-lg-center mb-2"><a class="d-block footerlink" href="#">@lang('leadpage.footer.productbtn.txt_footer1')</a></div>
                        <div class="d-flex align-items-lg-center mb-2"><a class="d-block footerlink" href="#">@lang('leadpage.footer.productbtn.txt_footer2')</a></div>
                        <div class="d-flex align-items-lg-center mb-2"><a class="d-block footerlink" href="#">@lang('leadpage.footer.productbtn.txt_footer3')</a></div>
                        <div class="d-flex align-items-lg-center mb-2"><a class="d-block footerlink" href="#">@lang('leadpage.footer.productbtn.txt_footer4')</a></div>
                        <div class="d-flex align-items-lg-center mb-2"><a class="d-block footerlink" href="#">@lang('leadpage.footer.productbtn.txt_footer5')</a></div>
                        <div class="d-flex align-items-lg-center mb-2"><a class="d-block footerlink" href="#">@lang('leadpage.footer.productbtn.txt_footer6')</a></div>
                    </div>
                    <div class="col-sm-6 col-lg-6">
                        <p class="text-center text-white"></p>
                        <h5 class="text-start text-white mb-3">@lang('leadpage.btn.language')</h5>
                        <div class="d-flex align-items-lg-center mb-2"><img class="me-2" src="assets/img/flaguk.png" width="20px" height="20px"><a class="d-block footerlink" href="/setlocale/en">@lang('leadpage.btn.english')</a></div>
                        <div class="d-flex align-items-lg-center mb-2"><img class="me-2" src="assets/img/flagspa.png" width="20px" height="20px"><a class="d-block footerlink" href="/setlocale/es">@lang('leadpage.btn.spanish')</a></div>
                        <div class="d-flex align-items-lg-center mb-2"><img class="me-2" src="assets/img/flagger.png" width="20px" height="20px"><a class="d-block footerlink" href="/setlocale/de">@lang('leadpage.btn.german')</a></div>
                        <div class="d-flex align-items-lg-center"><img class="me-2" src="assets/img/flagfr.png" width="20px" height="20px"><a class="d-block footerlink" href="/setlocale/fr">@lang('leadpage.btn.french')</a></div>
                    </div>
                </div>
                <div class="row py-4 mt-5">
                    <div class="col">
                        @lang('leadpage.footer.copyright')
                    </div>
                </div>
            </div><!-- End: 1 Row 1 Column -->
        </div>
    </footer><!-- End: Footer Dark -->
    <script src="assetsWelcome/bootstrap/js/bootstrap.min.js"></script>
    <script src="assetsWelcome/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script><!-- End: Footer Dark -->
    <script src="assetsWelcome/bootstrap/js/bootstrap.min.js"></script>
    <script src="assetsWelcome/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
</body>

</html>