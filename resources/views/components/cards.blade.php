<style>
  #news .container-cards {
    display: flex !important;
    width: 100% !important;
    gap: 1rem !important;
    justify-content: center !important;
    padding: 1rem !important;
    flex-wrap: wrap;
    /* Permite quebra de linha em telas menores */
  }

  #news .card-div {
    flex: 1;
    height: 450px;
    /* Altura fixa para desktop */
    width: 100%;
    background-position: center;
    position: relative;
    display: flex;
    align-items: end;
    padding: 20px 33px;
    justify-content: start;
    background-size: cover;
    border-radius: 12px;
    overflow: hidden;
    flex-wrap: wrap;
    transition: background 0.3s ease;
  }

  #news .card-div::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 255, 0, 0);
    z-index: 0;
    transition: background-color 0.3s ease;
  }

  #news .card-div:hover::before {
    background-color: #203d0b;
    cursor: pointer;
  }

  #news .card-div div {
    position: relative;
    z-index: 1;
    display: flex;
    height: 100% !important;
    flex-direction: column;
    justify-content: start;
    width: 100%;
  }

  #news .card-div div h2 {
    color: white;
    font-size: 2em;
    margin: 0;
  }

  #news .card-div div p {
    color: white;
    font-size: 1.2em;
    margin: 0;
  }

  #news .card-div div .new-p {
    position: absolute;
    bottom: -50px;
    color: white;
    font-size: 1em;
    opacity: 0;
    transition: bottom 0.3s ease, opacity 0.3s ease;
  }

  #news .card-div:hover .new-p {
    bottom: 20px;
    opacity: 1;
    cursor: pointer;
  }

  /* Responsividade para telas menores */
  @media (max-width: 768px) {
    #news .container-cards {
      flex-direction: column;
    }

    #news .card-div {
      min-height: 90vh !important;
      /* Altura mínima para mobile */
      height: auto;
      /* Permite que cresça com o conteúdo */
    }

    #news .card-div div {
      height: 500px !important;
      /* Ajusta dinamicamente ao conteúdo */
    }
  }

  /* Ajuste para telas grandes */
  @media (min-width: 1024px) {
    #news .card-div {
      height: 450px;
      /* Altura maior para desktop */
    }
  }
</style>
<div id="news">

  <div class="container-cards">
    <div class="card-div"
      style="background-image: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url(/images/blockchain.gif);">
      <div>
        <h2>Blockchain</h2>
        <p>The Foundation of Secure Transactions</p>
        <p class="new-p">Our experts implement blockchain to ensure every transaction is secure, transparent, and
          decentralized, instilling trust and accountability across all digital interaction within the ecosystem.
        </p> <!-- Novo <p> -->
      </div>
    </div>

    <div class="card-div"
      style="background-image: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url(/images/smart-contracts.gif);">
      <div>
        <h2>Smart Contracts</h2>
        <p>The Future of Automated Efficiency</p>
        <p class="new-p">With precision and innovation, our team develop smart contracts to automate complex
          processes, ensuring efficiency and reliability while reducing dependence on intermediaries</p>
        <!-- Novo <p> -->
      </div>
    </div>

    <div class="card-div"
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

</div>