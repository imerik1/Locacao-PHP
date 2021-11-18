<?php include '..\header.php'; ?>

<style>
  form {
    justify-self: center;
    align-self: center;
    width: 100%;
    max-width: 800px !important;
  }

  form * {
    width: 100%;
  }

  .fields-divided {
    display: flex;
    flex-flow: row wrap;
    gap: 1rem;
  }

  .fields-divided>div {
    flex: 1;
  }
</style>
<main>
  <h1>Formulário de aluguel de veículo</h1>
  <form class="ui form">
    <h4 class="ui dividing header">Cliente</h4>
    <div class="required field">
      <label>Nome completo</label>
      <input id="nome-completo" type="text" placeholder="Nome completo" required>
    </div>
    <div class="required field">
      <label>CPF</label>
      <input type="text" inputmode="numeric" id="CPF" placeholder="Seu CPF" required>
    </div>
    <div class="required field">
      <label>Telefone</label>
      <input type="text" inputmode="numeric" id="telefone" placeholder="Seu telefone" required>
    </div>
    <h4 class="ui dividing header">Endereço</h4>
    <div class="disabled required none endereco-fields field">
      <label>Logradouro</label>
      <input type="text" id="logradouro" placeholder="Seu logradouro" disabled="" tabindex="-1" required>
    </div>
    <div class="fields-divided">
      <div class="required none endereco-fields field">
        <label>Número</label>
        <input type="text" inputmode="numeric" id="número" placeholder="Seu número" required>
      </div>
      <div class="required field">
        <label>CEP</label>
        <input type="text" inputmode="numeric" id="CEP" placeholder="Seu CEP" required>
      </div>
    </div>
    <p class="cep-error none">Por favor, digite um CEP válido.</p>
    <div class="disabled required none endereco-fields field">
      <label>Bairro</label>
      <input type="text" id="bairro" placeholder="Seu bairro" disabled="" tabindex="-1" required>
    </div>
    <div class="fields-divided">
      <div class="disabled required none endereco-fields field">
        <label>Cidade</label>
        <input type="text" id="localidade" placeholder="Sua cidade" disabled="" tabindex="-1" required>
      </div>
      <div class="disabled required none endereco-fields field">
        <label>UF</label>
        <input type="text" id="uf" placeholder="Seu estado" disabled="" tabindex="-1" required>
      </div>
    </div>
    <h4 class="ui dividing header">Veículo</h4>
    <div class="fields-divided">
      <div class="required field">
        <label>Marca</label>
        <input type="text" id="marca" placeholder="Marca do veículo">
      </div>
      <div class="required field">
        <label>Modelo</label>
        <input type="text" id="modelo" placeholder="Modelo do veículo">
      </div>
      <div class="required field">
        <label>Ano</label>
        <input type="number" step="1" min="1900" max="2022" value="2021" inputmode="numeric" id="ano" placeholder="Ano do veículo">
      </div>
    </div>
    <div class="fields-divided">
      <div class="required field">
        <label>Preço</label>
        <input type="text" data-affixes-stay="true" data-prefix="R$ " data-thousands="." data-decimal="," inputmode="decimal" id="preco" placeholder="Preço do veículo">
      </div>
      <div class="required field">
        <label>Placa</label>
        <input type="text" id="placa" placeholder="Placa do veículo">
      </div>
    </div>
  </form>
</main>

<!-- Muda o titulo da página -->
<script>
  document.title = "Formulário de aluguel de veículo";
</script>

<!-- Bibliotecas para mascára -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js" integrity="sha512-Rdk63VC+1UYzGSgd3u2iadi0joUrcwX0IWp2rTh6KXFoAmgOjRS99Vynz1lJPT8dLjvo6JZOqpAHJyfCEZ5KoA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- As máscaras dos inputs -->
<script>
  $(document).ready(function() {

    // Mascára do CPF
    const $CPF = $("#CPF");
    $CPF.mask('000.000.000-00', {
      reverse: true
    });

    // Mascára do telefone
    const $telefone = $("#telefone");
    const SPMaskBehavior = (val) => {
        return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
      },
      spOptions = {
        onKeyPress: function(val, e, field, options) {
          field.mask(SPMaskBehavior.apply({}, arguments), options);
        }
      };
    $telefone.mask(SPMaskBehavior, spOptions);

    // Mascára do CEP
    const $CEP = $("#CEP");
    $CEP.mask('00000-000', {
      reverse: true
    });

    // Mascára do preço
    const $price = $("#preco");
    $price.maskMoney();

    // Mascára da placa
    const $placa = $("#placa");
    $placa.mask('AAA 0U00', {
      translation: {
        'A': {
          pattern: /[A-Za-z]/
        },
        'U': {
          pattern: /[A-Za-z0-9]/
        },
      },
      onKeyPress: function(value, e, field, options) {
        // Convert to uppercase
        e.currentTarget.value = value.toUpperCase();

        // Get only valid characters
        let val = value.replace(/[^\w]/g, '');

        // Detect plate format
        let isNumeric = !isNaN(parseFloat(val[4])) && isFinite(val[4]);
        let mask = 'AAA 0U00';
        if (val.length > 4 && isNumeric) {
          mask = 'AAA-0000';
        }
        $(field).mask(mask, options);
      }
    });
  });
</script>

<!-- CEP Informações -->
<script>
  const CEP = document.getElementById("CEP");
  const cepError = document.querySelector(".cep-error");
  CEP.oninput = async (e) => {
    const value = e.target.value.replace(/[^0-9]/g, "")
    if (value.length === 8) {
      const request = await fetch(`https://viacep.com.br/ws/${value}/json/`);
      const result = await request.json();
      const fields = ["bairro", "localidade", "logradouro", "uf"];
      if (result["localidade"]) {
        fields.map((field) => {
          const input = document.getElementById(field);
          input.value = result[field];
        })
        document.querySelectorAll(".endereco-fields").forEach((element) => element.classList.remove("none"));
        cepError.classList.add("none");
      } else {
        cepError.classList.remove("none");
      }
    } else {
      document.querySelectorAll(".endereco-fields").forEach((element) => element.classList.add("none"));
      cepError.classList.add("none");
    }
  }
</script>

<?php include '..\footer.php'; ?>