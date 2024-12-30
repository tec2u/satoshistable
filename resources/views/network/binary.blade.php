@extends('layouts.header')
@section('content')
  <style>
    /*Now the CSS*/
    * {
      margin: 0;
      padding: 0;
    }

    .tree ul {
      padding-top: 20px;
      position: relative;

      transition: all 0.5s;
      -webkit-transition: all 0.5s;
      -moz-transition: all 0.5s;
    }

    .tree li {
      float: left;
      text-align: center;
      list-style-type: none;
      position: relative;
      padding: 20px 5px 0 5px;

      transition: all 0.5s;
      -webkit-transition: all 0.5s;
      -moz-transition: all 0.5s;
    }

    /*We will use ::before and ::after to draw the connectors*/

    .tree li::before,
    .tree li::after {
      content: '';
      position: absolute;
      top: 0;
      right: 50%;
      border-top: 1px solid #ccc;
      width: 50%;
      height: 20px;
    }

    .tree li::after {
      right: auto;
      left: 50%;
      border-left: 1px solid #ccc;
    }

    /*We need to remove left-right connectors from elements without
          any siblings*/
    .tree li:only-child::after,
    .tree li:only-child::before {
      display: none;
    }

    /*Remove space from the top of single children*/
    .tree li:only-child {
      padding-top: 0;
    }

    /*Remove left connector from first child and
          right connector from last child*/
    .tree li:first-child::before,
    .tree li:last-child::after {
      border: 0 none;
    }

    /*Adding back the vertical connector to the last nodes*/
    .tree li:last-child::before {
      border-right: 1px solid #ccc;
      border-radius: 0 5px 0 0;
      -webkit-border-radius: 0 5px 0 0;
      -moz-border-radius: 0 5px 0 0;
    }

    .tree li:first-child::after {
      border-radius: 5px 0 0 0;
      -webkit-border-radius: 5px 0 0 0;
      -moz-border-radius: 5px 0 0 0;
    }

    /*Time to add downward connectors from parents*/
    .tree ul ul::before {
      content: '';
      position: absolute;
      top: 0;
      left: 50%;
      border-left: 1px solid #ccc;
      width: 0;
      height: 20px;
    }

    .tree li a {
      border: 1px solid #ccc;
      padding: 5px 10px;
      text-decoration: none;
      color: #666;
      font-family: arial, verdana, tahoma;
      font-size: 11px;
      display: inline-block;

      border-radius: 5px;
      -webkit-border-radius: 5px;
      -moz-border-radius: 5px;

      transition: all 0.5s;
      -webkit-transition: all 0.5s;
      -moz-transition: all 0.5s;
    }

    /*Time for some hover effects*/
    /*We will apply the hover effect the the lineage of the element also*/
    .tree li a:hover,
    .tree li a:hover+ul li a {
      background: #c8e4f8;
      color: #000;
      border: 1px solid #94a0b4;
    }

    /*Connector styles on hover*/
    .tree li a:hover+ul li::after,
    .tree li a:hover+ul li::before,
    .tree li a:hover+ul::before,
    .tree li a:hover+ul ul::before {
      border-color: #94a0b4;
    }

    .tree img {
      width: 50px
    }
  </style>
  <main id="main" class="main">
    <section id="poolcommission" class="content">
      <div class="fade">
        <div class="container-fluid">



          <div class="row">
            <div class="col-lg-6 align-self-center mobile-bottom-fix">
              <h1>BINARY NETWORK</h1>
            </div>
            <h2>
              Leg Preference:
            </h2>
            <form id="binary-position-form"
              class="col-lg-6 d-flex align-items-center justify-content-end align-self-center mobile-bottom-fix">
              <div class="form-check ml-4">
                <input class="form-check-input" type="radio" name="perna_cad" value="L"
                  {{ auth()->user()->perna_cad == 'L' ? 'checked' : '' }} onchange="submitForm()">
                <label class="form-check-label">
                  Left
                </label>
              </div>
              <div class="form-check ml-4">
                <input class="form-check-input" type="radio" name="perna_cad" value="B"
                  {{ auth()->user()->perna_cad == 'B' ? 'checked' : '' }} onchange="submitForm()">
                <label class="form-check-label">
                  Balanced
                </label>
              </div>
              <div class="form-check ml-4">
                <input class="form-check-input" type="radio" name="perna_cad" value="R"
                  {{ auth()->user()->perna_cad == 'R' ? 'checked' : '' }} onchange="submitForm()">
                <label class="form-check-label">
                  Right
                </label>
              </div>
            </form>
            <div class="card shadow my-3" style="overflow: auto;">
              <div class="tree">
                <ul>
                  <li class="reponsive-binary-group">
                    <a href="{{ route('affiliate.binary', $l1['user']->id ?? null) }}">
                      <img src="{{ $l1['image'] }}" alt="User Image">
                      <br>{{ $l1['user']->login ?? 'No Login' }}
                      <br>{{ $l1['user']->qty_total_left ?? 0 }} | {{ $l1['user']->qty_total_right ?? 0 }}
                    </a>
                    <ul class="reponsive-binary-group">
                      <li class="hidde-top-line-border-responsive">
                        <a href="{{ route('affiliate.binary', $l2p1['user']->id ?? null) }}">
                          <img src="{{ $l2p1['image'] }}" alt="User Image">
                          <br>{{ $l2p1['user']->login ?? 'No Login' }}
                          <br>{{ $l2p1['user']->qty_total_left ?? 0 }} | {{ $l2p1['user']->qty_total_right ?? 0 }}
                        </a>
                        <ul class="hidde-top-line-border-responsive">
                          <li>
                            <a href="{{ route('affiliate.binary', $l3p1['user']->id ?? null) }}">
                              <img src="{{ $l3p1['image'] }}" alt="User Image">
                              <br>{{ $l3p1['user']->login ?? 'No Login' }}
                              <br>{{ $l3p1['user']->qty_total_left ?? 0 }} | {{ $l3p1['user']->qty_total_right ?? 0 }}
                            </a>
                            <ul>
                              <li>
                                <a href="{{ route('affiliate.binary', $l4p1['user']->id ?? null) }}">
                                  <img src="{{ $l4p1['image'] }}" alt="User Image">
                                  <br>{{ $l4p1['user']->login ?? 'No Login' }}
                                  <br>{{ $l4p1['user']->qty_total_left ?? 0 }} |
                                  {{ $l4p1['user']->qty_total_right ?? 0 }}
                                </a>
                              </li>
                              <li>
                                <a href="{{ route('affiliate.binary', $l4p2['user']->id ?? null) }}">
                                  <img src="{{ $l4p2['image'] }}" alt="User Image">
                                  <br>{{ $l4p2['user']->login ?? 'No Login' }}
                                  <br>{{ $l4p2['user']->qty_total_left ?? 0 }} |
                                  {{ $l4p2['user']->qty_total_right ?? 0 }}
                                </a>
                              </li>
                            </ul>
                          </li>
                          <li>
                            <a href="{{ route('affiliate.binary', $l3p2['user']->id ?? null) }}">
                              <img src="{{ $l3p2['image'] }}" alt="User Image">
                              <br>{{ $l3p2['user']->login ?? 'No Login' }}
                              <br>{{ $l3p2['user']->qty_total_left ?? 0 }} | {{ $l3p2['user']->qty_total_right ?? 0 }}
                            </a>
                            <ul>
                              <li>
                                <a href="{{ route('affiliate.binary', $l4p3['user']->id ?? null) }}">
                                  <img src="{{ $l4p3['image'] }}" alt="User Image">
                                  <br>{{ $l4p3['user']->login ?? 'No Login' }}
                                  <br>{{ $l4p3['user']->qty_total_left ?? 0 }} |
                                  {{ $l4p3['user']->qty_total_right ?? 0 }}
                                </a>
                              </li>
                              <li>
                                <a href="{{ route('affiliate.binary', $l4p4['user']->id ?? null) }}">
                                  <img src="{{ $l4p4['image'] }}" alt="User Image">
                                  <br>{{ $l4p4['user']->login ?? 'No Login' }}
                                  <br>{{ $l4p4['user']->qty_total_left ?? 0 }} |
                                  {{ $l4p4['user']->qty_total_right ?? 0 }}
                                </a>
                              </li>
                            </ul>
                          </li>
                        </ul>
                      </li>
                      <div class="text-center italic message-responsive-alert mt-4 mb-2">
                        continuation of the network from the first level
                      </div>
                      <li class="hidde-top-line-border-responsive">
                        <a href="{{ route('affiliate.binary', $l2p2['user']->id ?? null) }}">
                          <img src="{{ $l2p2['image'] }}" alt="User Image">
                          <br>{{ $l2p2['user']->login ?? 'No Login' }}
                          <br>{{ $l2p2['user']->qty_total_left ?? 0 }} | {{ $l2p2['user']->qty_total_right ?? 0 }}
                        </a>
                        <ul>
                          <li>
                            <a href="{{ route('affiliate.binary', $l3p3['user']->id ?? null) }}">
                              <img src="{{ $l3p3['image'] }}" alt="User Image">
                              <br>{{ $l3p3['user']->login ?? 'No Login' }}
                              <br>{{ $l3p3['user']->qty_total_left ?? 0 }} | {{ $l3p3['user']->qty_total_right ?? 0 }}
                            </a>
                            <ul>
                              <li>
                                <a href="{{ route('affiliate.binary', $l4p5['user']->id ?? null) }}">
                                  <img src="{{ $l4p5['image'] }}" alt="User Image">
                                  <br>{{ $l4p5['user']->login ?? 'No Login' }}
                                  <br>{{ $l4p5['user']->qty_total_left ?? 0 }} |
                                  {{ $l4p5['user']->qty_total_right ?? 0 }}
                                </a>
                              </li>
                              <li>
                                <a href="{{ route('affiliate.binary', $l4p6['user']->id ?? null) }}">
                                  <img src="{{ $l4p6['image'] }}" alt="User Image">
                                  <br>{{ $l4p6['user']->login ?? 'No Login' }}
                                  <br>{{ $l4p6['user']->qty_total_left ?? 0 }} |
                                  {{ $l4p6['user']->qty_total_right ?? 0 }}
                                </a>
                              </li>
                            </ul>
                          </li>
                          <li>
                            <a href="{{ route('affiliate.binary', $l3p4['user']->id ?? null) }}">
                              <img src="{{ $l3p4['image'] }}" alt="User Image">
                              <br>{{ $l3p4['user']->login ?? 'No Login' }}
                              <br>{{ $l3p4['user']->qty_total_left ?? 0 }} | {{ $l3p4['user']->qty_total_right ?? 0 }}
                            </a>
                            <ul>
                              <li>
                                <a href="{{ route('affiliate.binary', $l4p7['user']->id ?? null) }}">
                                  <img src="{{ $l4p7['image'] }}" alt="User Image">
                                  <br>{{ $l4p7['user']->login ?? 'No Login' }}
                                  <br>{{ $l4p7['user']->qty_total_left ?? 0 }} |
                                  {{ $l4p7['user']->qty_total_right ?? 0 }}
                                </a>
                              </li>
                              <li>
                                <a href="{{ route('affiliate.binary', $l4p8['user']->id ?? null) }}">
                                  <img src="{{ $l4p8['image'] }}" alt="User Image">
                                  <br>{{ $l4p8['user']->login ?? 'No Login' }}
                                  <br>{{ $l4p8['user']->qty_total_left ?? 0 }} |
                                  {{ $l4p8['user']->qty_total_right ?? 0 }}
                                </a>
                              </li>
                            </ul>
                          </li>
                        </ul>
                      </li>
                    </ul>
                  </li>
                </ul>
              </div>

            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <style>
    .message-responsive-alert {
      display: none;
    }

    /*
              @media (max-width: 1405px) {
                  .reponsive-binary-group {
                      bottom: 0;
                      padding: 0 !important;
                      width: 100%;
                      display: flex;
                      flex-direction: column;
                      align-items: center;
                  }

                  .message-responsive-alert {
                      display: block;
                  }

                  .hidde-top-line-border-responsive::before {
                      border-top: none !important;
                  }
                  .hidde-top-line-border-responsive::after {
                      border-top: none !important;
                  }
              } */

    .tree {
      width: 1077px;
    }
  </style>


  <script>
    function submitForm() {
      axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute(
        'content');
      // Captura os dados do formulário
      const form = document.getElementById('binary-position-form');
      const formData = new FormData(form);

      // Envia a requisição GET usando Axios
      axios.post('/update-binary-position', {
          position: formData.get('perna_cad')
        })
        .then(function(response) {
          console.log('Dados enviados com sucesso:', response);
          alert('Leg preference updated successfully');
        })
        .catch(function(error) {
          console.error('Erro ao enviar os dados:', error);
        });
    }
  </script>
@endsection
