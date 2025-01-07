<!DOCTYPE HTML>
<!--
 Hyperspace by HTML5 UP
 html5up.net | @ajlkn
 Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>

<head>
  <title>Satoshi Square Table</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
  <link rel="stylesheet" href="assets/css/main.css" />
  <noscript>
    <link rel="stylesheet" href="assets/css/noscript.css" />
  </noscript>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head>




<body class="is-preload">

  <!-- Sidebar -->
  <section id="sidebar">
    <div class="inner">
    
      <nav>
        <ul>
          <li><a href="#intro">@lang('site.welcome')</a></li>
          <li><a href="#one">@lang('site.who_we_are')</a></li>
          <li><a href="#news">@lang('site.news')</a></li>
          <li><a href="#ceo">@lang('site.ceo')</a></li>
         
         
          <li><a href="#two">@lang('site.what_we_do1')</a></li>
          <li><a href="#three">@lang('site.get_in_touch')</a></li>
          <li><a href="#footer">@lang('site.languages')</a></li>
          <li><a href="{{ route('login') }}">@lang('site.login')</a></li>
          <li><a href="{{ route('register') }}">@lang('site.register')</a></li>
        </ul>
      </nav>
    </div>
    
              
             

  </section>

  <!-- Wrapper -->
  <div id="wrapper">

    <!-- Intro -->
    <section id="intro" class="wrapper style4 fullscreen fade-up">
      <div class="background-video">
        <video autoplay loop muted playsinline>
          <source src={{ asset('videos/wave-video.mp4') }} type="video/mp4">
        </video>
      </div>

      <div class="inner" style="display: flex;justify-content: center;flex-direction: column;text-align: center">
        <img src='/images/logo.png' style='width: 200px; margin:0 auto;'>
        @lang('site.banner_main')
      </div>
    </section>

    <!-- One -->
    <section id="one" class="wrapper style2 spotlights fade-up">
      <div class="shape-left"></div>
      <div class="shape-right"></div>

      <h1 class="textStyled" style="padding: 10px 20px">@lang('site.about_us')
      </h1>


      <div id="content-one">
        <div class="image-container">
          <img src="{{ asset('images/sectionOne.jpg') }}" alt="">
          {{-- <img src="https://waas.network/assets/homepage/img/our-vision.png" alt=""> --}}
        </div>
        <div class="content-container">
@lang('site.about_content')
        </div>
      </div>
    </section>

    <section id="news" class="wrapper style4 fade-up">
      <div class="inner">
        <h1 class="textStyled">@lang('site.news_title')</h1>
      </div>

      @include('components.cards')
    </section>



    <section id="ceo" class="wrapper style4 fade-up">
      <div class="left">
        <h1 class="textStyled">CEO, Sam Lee</h1>
        <div class="choose-us-box">
          <img src="{{ asset('/images/line-left.png') }}" alt="Owner">
          <p>
            @lang('site.ceo_content')
            <img src="{{ asset('/images/line-right.png') }}" alt="Owner">
          </p>
        </div>
      </div>
      <div class="right">
        <div class="choose-us-img">
          <img src="{{ asset('images/ceo.png') }}" alt="owner">
          <div class="glow-bg"></div>
        </div>
      </div>
    </section>

    <section id="partners" class="wrapper style4 fade-up">
      <div class="left">
        <h1 class="textStyled">@lang('site.partners_title')</h1>
      </div>


      <div id="ourclients">
        <div class="clients-wrap">
          <ul id="clientlogo" class="clearfix">
            <li>
              <img src="{{ asset('images/binance.png') }}" alt="Logo">
            </li>

            <li>
              <img src="{{ asset('images/okex.png') }}" alt="Logo">
            </li>

            <li>
              <img src="{{ asset('images/huobi.png') }}" alt="Logo">
            </li>

            <li>
              <img src="{{ asset('images/zb.png') }}" alt="Logo">
            </li>

            <li>
              <img src="{{ asset('images/bit.png') }}" alt="Logo">
            </li>

           

            <li>
              <img src="{{ asset('images/hyperdao.png') }}" alt="Logo">
            </li>

           

            <li>
              <img src="{{ asset('images/hyperpay.svg') }}" alt="Logo">
            </li>

            <li>
              <img src="{{ asset('images/hyperland.png') }}" alt="Logo">
            </li>
          </ul>
        </div>
      </div>
    </section>

    <!-- Two -->
    <section id="two" class="wrapper style4 fade-up">
      @lang('site.what_we_do')
          </section>
        </div>
        <ul class="actions">
          <li style="width: 100%;display:flex;justify-content: center"><a target="_blank"
              href="{{ asset('/images/presentation.pdf') }}"
              style="background-color: white !important;color:#000 !important;" class="button">👉 @lang('site.presentation_link')
              🌟</a></li>
        </ul>
      </div>
    </section>

    <!-- Three -->
    <section id="three" class="wrapper style1 fade-up">
      @lang('site.get_in_touch_form')
          </section>
          <section>
            <ul class="contact">
              <li>
                <h3>@lang('site.contact_address')</h3>
                <span>Dubai<br />
        </span>
              </li>
              <li>
                <h3>@lang('site.contact_email')</h3>
                <a href="#">contact@satoshistable.com</a>
              </li>
              <li>
                <h3>@lang('site.contact_phone')</h3>
                <span>Soon whatsapp support</span>
              </li>
              <li>
                <h3>Social</h3>
                <ul class="icons">
                  <li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
                  <li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a>
                  </li>
                  <li><a href="#" class="icon brands fa-github"><span class="label">GitHub</span></a></li>
                  <li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a>
                  </li>
                  <li><a href="#" class="icon brands fa-linkedin-in"><span class="label">LinkedIn</span></a>
                  </li>
                </ul>
              </li>
            </ul>
          </section>
        </div>
      </div>
    </section>


  </div>

  <!-- Footer -->
  <footer id="footer">
    @include('components.footer')
  </footer>

  <!-- Scripts -->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/jquery.scrollex.min.js"></script>
  <script src="assets/js/jquery.scrolly.min.js"></script>
  <script src="assets/js/browser.min.js"></script>
  <script src="assets/js/breakpoints.min.js"></script>
  <script src="assets/js/util.js"></script>
  <script src="assets/js/main.js"></script>

  <script>
    $(function() {
      var $clientslider = $('#clientlogo');
      var clients = $clientslider.children().length;
      var clientwidth = (clients * 220);
      $clientslider.css('width', clientwidth);
      var rotating = true;
      var clientspeed = 0;
      var seeclients = setInterval(rotateClients, clientspeed);
      $(document).on({
        mouseenter: function() {
          rotating = false;
        },
        mouseleave: function() {
          rotating = true;
        }
      }, '#ourclients');

      function rotateClients() {
        if (rotating != false) {
          var $first = $('#clientlogo li:first');
          $first.animate({
            'margin-left': '-220px'
          }, 2000, function() {
            $first.remove().css({
              'margin-left': '0px'
            });
            $('#clientlogo li:last').after($first);
          });
        }
      }
    });
  </script>
</body>

</html>
