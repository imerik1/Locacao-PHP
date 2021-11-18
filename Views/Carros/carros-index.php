<?php include '..\header.php'; ?>

<!-- Estilização única -->
<style>
  main>a {
    margin-left: auto;
  }
</style>

<main>
  <h1>Tabela de veículos alugados</h1>
  <div style="width: 100%;" class="ui divider"></div>
  <a href="/Views/Carros/carros-create.php">
    <button class="ui right floated button">Novo veículo</button>
  </a>
  <table class="ui sortable celled table">
    <thead>
      <tr>
        <th class="sorted ascending">Cliente</th>
        <th>Placa</th>
        <th>Carro</th>
        <th>Ano</th>
        <th>Valor</th>
        <th>Data de pagamento</th>
        <th class="no-sort" style="width: auto;"></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td data-label="Cliente">James</td>
        <td data-label="Placa">FGC7J52</td>
        <td data-label="Carro">Uno</td>
        <td data-label="Ano">2007</td>
        <td data-label="Valor">R$ 270,00</td>
        <td data-label="Data de pagamento">14/07/2002</td>
        <td data-label="" style="width: 1%; white-space: nowrap;">
          <a title="Editar" href=""><img src="https://img.icons8.com/external-becris-lineal-becris/22/000000/external-edit-mintab-for-ios-becris-lineal-becris.png" /></a>
          <a title="Excluir" href=""><img src="https://img.icons8.com/ios-glyphs/22/000000/delete-sign.png" /></a>
        </td>
      </tr>
      <tr>
        <td data-label="Cliente">Rodrigo</td>
        <td data-label="Placa">FGC7J52</td>
        <td data-label="Carro">Uno</td>
        <td data-label="Ano">2007</td>
        <td data-label="Valor">R$ 270,00</td>
        <td data-label="Data de pagamento">14/07/2004</td>
        <td data-label="" style="width: 1%; white-space: nowrap;">
          <a title="Editar" href=""><img src="https://img.icons8.com/external-becris-lineal-becris/22/000000/external-edit-mintab-for-ios-becris-lineal-becris.png" /></a>
          <a title="Excluir" href=""><img src="https://img.icons8.com/ios-glyphs/22/000000/delete-sign.png" /></a>
        </td>
      </tr>
    </tbody>
  </table>
</main>
<!-- Muda o titulo da página -->

<script src="https://semantic-ui.com/javascript/library/tablesort.js"></script>
<script>
  document.title = "Tabela de veículos alugados";
  $('table').tablesort();
</script>

<?php include '..\footer.php'; ?>