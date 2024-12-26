<style>
  #footer {
    background-color: #000600;
    overflow: hidden;
  }

  #footer .content {
    width: 100%;
    display: flex;
    padding: 5rem 1rem;
    flex-wrap: wrap;
    position: relative;
  }

  #footer .content h4 {
    font-family: "b0563e35d30b3d4c - subset of Pepi";
    font-size: 25px;
    font-style: normal;
    font-weight: 600;
    color: #f6f6f7;
    line-height: 40px;
    letter-spacing: -0.75px;
    margin-bottom: 20px;
  }

  #footer .content>div {
    flex: 1;
  }

  #footer li {
    list-style: none;
  }

  #footer li a {
    color: rgba(255, 255, 255, 0.55) !important
  }

  #footer .footer-1 {
    font-size: 14px !important;
  }

  .bg-shape {
    width: 200px;
    height: 200px;
    top: 0;
    left: 43%;
    background: #b1ff0e;
    z-index: 1;
    fill: #b1ff0e;
    opacity: 1;
    filter: blur(250px);
    position: absolute;
  }

  @media (max-width: 768px) {
    #footer .content {
      width: 100%;
      display: flex;
      flex-direction: column;
    }

    .bg-shape {
      max-width: 100%;
      left: 0;
      overflow: hidden;
    }
  }

  #footer .content .footer-1 {
    flex: 2;
    position: relative;
    z-index: 2;
  }

  #footer .content .footer-2,
  #footer .content .footer-3 {
    flex: 1;
    position: relative;
    z-index: 2;
  }

  #footer .content .footer-3 div {
    display: flex;
    height: 35px;
    flex-wrap: wrap;
  }

  #footer .content .footer-3 div input {
    flex: 3;
    height: 100%;
    border: 1px solid #94be3d !important;
    border-radius: 0 !important;
    background-color: transparent !important;
    padding-left: 10px;
  }

  #footer .content .footer-3 div button {
    flex: 1;
    border-radius: 0 !important;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 1rem !important;
    background-color: #94be3d !important;
    color: #000 !important;
  }

  @media (max-width: 1024px) {}
</style>

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
</footer>
