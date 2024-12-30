@extends('layouts.header')
@section('content')
  <style>
    /*Now the CSS*/
    * {
      margin: 0;
      padding: 0;
    }


    #tree {
      width: 100%;
      height: 100%;
    }

    .profile>line {
      stroke: #99C147 !important;
    }

    .profile>text {
      stroke: #99C147 !important;
    }

    .boc-edit-form.profile .boc-edit-form-header,
    .boc-edit-form.profile .boc-img-button {
      background-color: #99C147 !important;
    }
  </style>
  <main id="main" class="main">
    <section id="poolcommission" class="content">
      <div class="fade">
        <div class="container-fluid">



          <div class="row">
            <div class="col-lg-6 align-self-center mobile-bottom-fix">
              <h1>Network</h1>
            </div>
            {{-- <h2>
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
            </form> --}}

            <div class="card shadow my-3" style="overflow: auto;">
              @if (isset($networks))
                <div id="tree"></div>
              @endif
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
  </style>

  <script src={{ asset('/js/orgchart.js') }}></script>

  <script>
    let chart = new OrgChart(document.getElementById("tree"), {
      template: "ula",

      mouseScrool: OrgChart.none,
      nodeBinding: {
        field_0: "Name",
        field_1: "Title",
        img_0: "Photo"
      },
      editForm: {
        photoBinding: 'Photo',
        buttons: null
      },
      nodeMenu: {
        details: {
          text: "Details",

        }
      },
      nodes: {!! $networks !!}
    });

    chart.on('init', function(sender) {
      // sender.editUI.show(1);
    });

    chart.load({!! $networks !!});
  </script>
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
