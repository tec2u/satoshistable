@extends('layouts.header')
@section('content')
  <style>
    .modal-backdrop {
      display: none !important;
    }
  </style>
  <main id="main" class="main">
    @include('flash::message')
    <section id="userpackageinfo" class="content">
      <div class="fade">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <h1>@lang('package.order_payment')</h1>
              <div class="card shadow my-3">
                <div class="card-header bbcolorp">
                  <h3 class="card-title"></h3>
                </div>

                <div class="col-6">
                  <br>
                  @if ($orderpackage->payment_status == 1)
                    <p>@lang('package.paid')</p>
                  @endif
                </div>

                <br>
                <br>

                <div class="col-12">
                  @if (count($banks) > 0)
                    @if (isset($orderpackage->id_transaction_banks))
                      <p>Bank choosed to payment: <img src="{{ asset($orderpackage->transactionBank->logo) }}"
                          alt="" width="100px"> <strong> {{ $orderpackage->transactionBank->name }}</strong></p>
                    @else
                      <p>Choose bank to payment:</p>
                    @endif
                    <select class="form-select" name="method" id="bankSelect" required>
                      <option value="" disabled selected>Select for details</option>
                      @if (isset($orderpackage->id_transaction_banks))
                        <option value="{{ $orderpackage->transactionBank }}"
                          data-name="{{ $orderpackage->transactionBank->name }}"
                          data-logo="{{ asset($orderpackage->transactionBank->logo) }}"
                          data-description="{{ htmlspecialchars($orderpackage->transactionBank->description) }}">
                          <img src="{{ asset($orderpackage->transactionBank->logo) }}" alt="" width="100px">
                          {{ $orderpackage->transactionBank->name }}
                        </option>
                      @else
                        <option value="" disabled selected>Select a bank</option>
                        @foreach ($banks as $item)
                          <option value="{{ $item->id }}" data-name="{{ $item->name }}"
                            data-logo="{{ asset($item->logo) }}"
                            data-description="{{ htmlspecialchars($item->description) }}">
                            {{ $item->name }}
                          </option>
                        @endforeach
                      @endif
                    </select>

                    <!-- Botão que aparece somente após selecionar -->
                    <button type="button" class="btn btn-primary mt-3" id="openModalButton" data-bs-toggle="modal"
                      data-bs-target="#exampleModal" style="display: none;">
                      View Details
                    </button>

                    <!-- Modal -->
                  @else
                    Coming soon
                  @endif
                </div>


                </br></br>


              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="modalTitle">Bank Details</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <img id="imgBank" src="" alt="" style="width: 250px;margin:0 auto;">
        <div class="modal-body" id="modalBody">
          Please select a bank to view its details.
        </div>


        <form action="{{ route('packages.payCryptoNode') }}" method="POST" id="formChooseBank">
          @csrf
          <input type="hidden" value="{{ $orderpackage->id }}" name="id">
          <input type="hidden" value="{{ $orderpackage->price }}" name="price">
          <!-- Este campo será atualizado com o banco selecionado -->
          <input type="hidden" id="bankInput" value="" name="bank">
        </form>

        <div class="modal-footer">
          <div class="alert alert-danger" role="alert">
            Please use the reference code on your deposit:

            <strong>{{ $orderpackage->id }}+{{ $user->login }}</strong>
          </div>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          @if (!isset($orderpackage->id_transaction_banks))
            <button type="submit" class="btn btn-success" form="formChooseBank">Confirm</button>
          @endif
        </div>
      </div>
    </div>
  </div>

  <script>
    // Captura o botão e o select
    const bankSelect = document.getElementById('bankSelect');
    const openModalButton = document.getElementById('openModalButton');
    const modalTitle = document.getElementById('modalTitle');
    const modalBody = document.getElementById('modalBody');
    const bankInput = document.getElementById('bankInput');
    const imgBank = document.getElementById('imgBank');

    // Evento ao alterar o select
    bankSelect.addEventListener('change', () => {
      const selectedOption = bankSelect.options[bankSelect.selectedIndex];

      // Mostra o botão somente se houver um banco selecionado
      if (selectedOption && selectedOption.value) {
        openModalButton.style.display = 'block';
      } else {
        openModalButton.style.display = 'none';
      }
    });

    // Evento ao clicar no botão
    openModalButton.addEventListener('click', () => {
      const selectedOption = bankSelect.options[bankSelect.selectedIndex];

      if (selectedOption && selectedOption.value) {
        // Atualiza o título e o corpo do modal com as informações do item selecionado
        const bankName = selectedOption.getAttribute('data-name');
        const bankDescription = selectedOption.getAttribute('data-description');
        const banklogo = selectedOption.getAttribute('data-logo');

        modalTitle.textContent = `Bank Details: ${bankName}`;
        modalBody.innerHTML = bankDescription; // Processa o HTML do description

        // Atualiza o campo oculto no formulário com o ID do banco selecionado
        bankInput.value = selectedOption.value;

        imgBank.src = banklogo;
      } else {
        // Caso nada esteja selecionado
        modalTitle.textContent = 'No bank selected';
        modalBody.textContent = 'Please select a bank to view its details.';
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
  </script>
@endsection
