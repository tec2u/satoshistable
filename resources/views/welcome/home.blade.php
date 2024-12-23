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
          <li><a href="#intro">Welcome</a></li>
          <li><a href="#one">Who we are</a></li>
          <li><a href="#news">News</a></li>
          <li><a href="#ceo">CEO</a></li>
          <li><a href="#two">What we do</a></li>
          <li><a href="#three">Get in touch</a></li>
          <li><a href="{{ route('login') }}">Login</a></li>
          <li><a href="{{ route('register') }}">Register</a></li>
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
        <h1 class="textStyled">Satoshi
          Square Table</h1>
        <p>Satoshi Group takes a thoughtful approach to innovation, studying the journeys of Hyper Capital, Trage,
          Novatech, WAAS, and Empirex—their successes and challenges alike.</p>
        <ul class="actions">
          <li><a href="#one" class="button scrolly">Learn more</a></li>
        </ul>
      </div>
    </section>

    <!-- One -->
    <section id="one" class="wrapper style2 spotlights fade-up">
      <div class="shape-left"></div>
      <div class="shape-right"></div>

      <h1 class="textStyled" style="padding: 10px 20px">About Us
      </h1>


      <div id="content-one">
        <div class="image-container">
          <img src="{{ asset('images/sectionOne.jpg') }}" alt="">
          {{-- <img src="https://waas.network/assets/homepage/img/our-vision.png" alt=""> --}}
        </div>
        <div class="content-container">
          <div class="content-box">
            <h2>Satoshi Group</h2>
            <p>
              By analyzing what worked and refining what didn’t, we extract the best practices to:
            </p>
            <ul>
              <li>Turbocharge disruptive business models</li>
              <li>Create powerful value distribution mechanisms</li>
              <li>Deliver win-win outcomes for all participants</li>
            </ul>
            <p>
              With this foundation, Satoshi Group is setting a new benchmark for sustainable, inclusive growth in the
              modern economy.
            </p>
          </div>
          <div class="content-box">
            <h2>Our Vision</h2>
            <p>
              To harness the transformative power of blockchain-driven consensus and unlock unparalleled wealth creation
              opportunities.
            </p>
          </div>
          <div class="content-box">
            <h2>Our Mission</h2>
            <p>
              To integrate innovative value distribution models into cutting-edge tokenomics, accelerating the growth
              and success of real-world businesses.

            </p>
          </div>
        </div>
      </div>
    </section>

    <section id="news" class="wrapper style4 fade-up">
      <div class="inner">
        <h1 class="textStyled">Innovation in Action by Our Development Team</h1>
      </div>

      <div class="cards">
        <div class="card"
          style="background-image: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url(/images/blockchain.gif);">
          <div>
            <h2>Blockchain</h2>
            <p>The Foundation of Secure Transactions</p>
            <p class="new-p">Our experts implement blockchain to ensure every transaction is secure, transparent, and
              decentralized, instilling trust and accountability across all digital interaction within the ecosystem.
            </p> <!-- Novo <p> -->
          </div>
        </div>

        <div class="card"
          style="background-image: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url(/images/smart-contracts.gif);">
          <div>
            <h2>Smart Contracts</h2>
            <p>The Future of Automated Efficiency</p>
            <p class="new-p">With precision and innovation, our team develop smart contracts to automate complex
              processes, ensuring efficiency and reliability while reducing dependence on intermediaries</p>
            <!-- Novo <p> -->
          </div>
        </div>

        <div class="card"
          style="background-image: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url(/images/artificial-intelligence.gif);">
          <div>
            <h2>Artificial Intelligence</h2>
            <p>Powering Intelligent, User-Centric Experiences</p>
            <p class="new-p">Crafting intelligent,user-centric solutions,our team uses AI to optimize platform
              performance, delivering personalized tools and actionable insights that empower users to make smarter
              decisions</p> <!-- Novo <p> -->
          </div>
        </div>
      </div>
    </section>



    <section id="ceo" class="wrapper style4 fade-up">
      <div class="left">
        <h1 class="textStyled">CEO</h1>
        <div class="choose-us-box">
          <img src="{{ asset('/images/line-left.png') }}" alt="Owner">
          <p>
            A tech prodigy from India who delved into software development at 17. His expertise lies in DeFi and crypto,
            where he currently spearheads a thriving BTC20 smart chain with over 11 Million active wallets strong user
            community. Beyond his current success, Shavez is driven by a vision to broaden DeFi's reach to untapped
            markets. With a commitment to innovation, he aspires to make decentralized finance accessible to diverse
            segments of society, contributing to the industry's evolution. Shavez's journey is a testament to
            determination and forward-thinking, inspiring tech enthusiasts worldwide.
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
        <h1 class="textStyled">Partners</h1>
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
              <img src="{{ asset('images/molecular.png') }}" alt="Logo">
            </li>

            <li>
              <img src="{{ asset('images/hyperdao.png') }}" alt="Logo">
            </li>

            <li>
              <img src="{{ asset('images/hoo.png') }}" alt="Logo">
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
      <div class="inner">
        <h1 class="textStyled">What we do</h1>
        <p style="width: 100%; text-align: center">Get rewarded faster than ever with our new Accelerated Referral
          Reward System! 🎉</p>
        <div class="features">
          <section>
            <span class="icon solid major fa-user"></span>
            <h3>Refer a friend</h3>
            <p>Share your unique referral link.</p>
          </section>
          <section>
            <span class="icon solid major fa-plus"></span>
            <h3>They join</h3>
            <p>As soon as they sign up and deposit, you start earning.</p>
          </section>
          <section>
            <span class="icon solid major fa-money-bill"></span>
            <h3>Instant rewards</h3>
            <p>
              No waiting! Get your rewards at lightning speed.
              <br>
              💰 Why it's amazing:
            <ul>
              <li>Earn bigger rewards, faster than before.</li>
              <li>No delays – see your earnings grow in real-time.</li>
              <li>It's simple: Share. Earn. Repeat.</li>
            </ul>
            Don’t wait – start referring today and enjoy the most rewarding referral system around! 🌟
            <br>
            👉 Sign up and start earning now!
            </p>
          </section>
        </div>
        <ul class="actions">
          <li style="width: 100%;display:flex;justify-content: center"><a target="_blank"
              href="{{ asset('/images/presentation.pdf') }}"
              style="background-color: white !important;color:#000 !important;" class="button">👉 see presentation!
              🌟</a></li>
        </ul>
      </div>
    </section>

    <!-- Three -->
    <section id="three" class="wrapper style1 fade-up">
      <div class="inner">
        <h1 class="textStyled">Get in touch</h1>
        {{-- <p>Phasellus convallis elit id ullamcorper pulvinar. Duis aliquam turpis mauris, eu ultricies erat malesuada
          quis. Aliquam dapibus, lacus eget hendrerit bibendum, urna est aliquam sem, sit amet imperdiet est velit quis
          lorem.</p> --}}
        <div class="split style1">
          <section>
            <form>
              <div class="fields">
                <div class="field half">
                  <label for="name">Name</label>
                  <input type="text" name="name" id="name" />
                </div>
                <div class="field half">
                  <label for="email">Email</label>
                  <input type="text" name="email" id="email" />
                </div>
                <div class="field">
                  <label for="message">Message</label>
                  <textarea name="message" id="message" rows="5"></textarea>
                </div>
              </div>
              <ul class="actions">
                <li><a href="" class="button submit">Send Message</a></li>
              </ul>
            </form>
          </section>
          <section>
            <ul class="contact">
              <li>
                <h3>Address</h3>
                <span>12345 Somewhere Road #654<br />
                  Nashville, TN 00000-0000<br />
                  USA</span>
              </li>
              <li>
                <h3>Email</h3>
                <a href="#">user@untitled.tld</a>
              </li>
              <li>
                <h3>Phone</h3>
                <span>(000) 000-0000</span>
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
  <footer id="footer" class="wrapper style4 fadeup">
    <div class="content">
      <div class="bg-shape"></div>
      <div class="footer-1">
        <h4>About us</h4>
        <p>We are pioneering a new era in affiliate partnerships, leveraging transparency, trust, and innovation. Our
          mission is to transform traditional affiliate models into an efficient system that empowers businesses and
          affiliates alike. We are committed to building a fairer, more transparent marketplace for sustainable growth
          and reliable results.</p>
      </div>
      <div class="footer-2">
        <h4>Legal Agreements</h4>
        <ul>
          <li><a href="/#two">What we do</a></li>
          <li><a href="/#one">About Us</a></li>
          <li><a href="{{ asset('/images/presentation.pdf') }}" target="_blank">Business Plan</a></li>
          <li><a href="{{ route('login') }}">Login</a></li>
          <li><a href="{{ route('register') }}">Register</a></li>
        </ul>
      </div>
      <div class="footer-3">
        <h4>Connect with us</h4>
        <div>
          <input type="text" placeholder="Email" />
          <button>Subscribe</button>
        </div>
      </div>
    </div>
    <div class="inner">
      <ul class="menu">
        <li>&copy; Untitled. All rights reserved.</li>
      </ul>
    </div>
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
