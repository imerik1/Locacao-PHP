<?php
spl_autoload_register(function ($class_name) {
  include '..\\..\\' . $class_name . '.php';
});
?>

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
    <button class="ui right floated button">Novo aluguel</button>
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
      <?php

      use Db\Persiste;

      $clientes = Persiste::GetAll('Models\Cliente');
      $veiculos = Persiste::GetAll('Models\Veiculo');
      $pagamentos = Persiste::GetAll('Models\Pagamento');
      for ($i = 0; $i < count($clientes); ++$i) {
        $v = $veiculos[$i];
        $c = $clientes[$i];
        $p = $pagamentos[$i];
        echo "<tr>
                <td data-label='Cliente'>$c->getnome</td>
                <td data-label='Placa'>$v->getplaca</td>
                <td data-label='Carro'>$v->getmarca $v->getmodelo</td>
                <td data-label='Ano'>$v->getano</td>
                <td data-label='Valor'>$v->getpreco</td>
                <td data-label='Data de pagamento'>$p->getdata_pagamento</td>
                <td data-label='' style='width: 1%; white-space: nowrap;'>
                  <a title='Editar' href='carros-edit.php?id=$p->getid'><img src='https://img.icons8.com/external-becris-lineal-becris/22/000000/external-edit-mintab-for-ios-becris-lineal-becris.png' /></a>
                  <a title='Excluir' href='carros-delete.php?id=$p->getid'><img src='https://img.icons8.com/ios-glyphs/22/000000/delete-sign.png' /></a>
                </td>
              </tr>";
      }
      ?>
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