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

<main style="max-width: 98vw;">
  <h1>Tabela de veículos alugados</h1>
  <div style="width: 100%;" class="ui divider"></div>
  <a href="/Views/Carros/carros-create.php">
    <button class="ui right floated button">Novo aluguel</button>
  </a>

  <?php
  if (isset($_GET['page'])) {
    $page = $_GET['page'];
  } else {
    $page = 1;
  }

  if (isset($_GET['limit'])) {
    $limit = $_GET['limit'];
  } else {
    $limit = 10;
  }

  $inicio = $page - 1;
  $inicio = $inicio * $limit;
  ?>
  <select class="ui dropdown" onchange="location = this.value;">
    <option <?php if ($limit == 1) {
              echo "selected";
            } ?> value="?page=<?= $page ?>&limit=1">1</option>
    <option <?php if ($limit == 10) {
              echo "selected";
            } ?> value="?page=<?= $page ?>&limit=10">10</option>
    <option <?php if ($limit == 15) {
              echo "selected";
            } ?> value="?page=<?= $page ?>&limit=15">15</option>
    <option <?php if ($limit == 20) {
              echo "selected";
            } ?> value="?page=<?= $page ?>&limit=20">20</option>
  </select>
  <table class="ui sortable celled table" style="max-width: 100%;">
    <thead style="max-width: 100%;">
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
    <tbody style="max-width: 100%;">
      <?php

      use Db\Persiste;

      $clientes = Persiste::GetPaginate('Models\Cliente', $inicio, $limit);
      $veiculos = Persiste::GetPaginate('Models\Veiculo', $inicio, $limit);
      $pagamentos = Persiste::GetPaginate('Models\Pagamento', $inicio, $limit);

      if (is_array($clientes)) {
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
      }
      ?>
    </tbody>
  </table>
  <?php
  $anterior = $page - 1;
  $proximo = $page + 1;
  $array = Persiste::GetAll('Models\Cliente');
  if (is_array($array)) {
    $limitmax = round((count($array) / $limit));
    if ($limitmax > 1) {
      echo "<div style='margin: 0 auto;'>";
      echo "<div class='ui pagination menu'>";
      if ($page + 1 > $limitmax) {
        $next  = $page;
      } else {
        $next = $page + 1;
      }
      if ($page - 1 == 0) {
        $prev  = 1;
      } else {
        $prev = $page - 1;
      }
      echo "<a aria-current='false' href='?page=$prev&limit=$limit' aria-disabled='false' tabindex='0' class='item'>«</a>";
      for ($i = $page, $j = 0; $i <= $limitmax; ++$i, ++$j) {
        if ($j == 3) {
          break;
        }
        if ($i == $page) {
          echo "<a aria-current='true' aria-disabled='false' tabindex='0' value='$i' type='pageItem' href='?page=$i&limit=$limit' class='item active'>$i</a>";
        } else {
          echo "<a aria-current='false' aria-disabled='false' tabindex='0' value='$i' type='pageItem' href='?page=$i&limit=$limit' class='item'>$i</a>";
        }
      }
      echo "<a aria-current='false' href='?page=$next&limit=$limit' aria-disabled='false' tabindex='0' class='item'>»</a>";
      echo "</div>";
      echo "</div>";
    }
  }
  ?>
</main>

<script src="https://semantic-ui.com/javascript/library/tablesort.js"></script>

<!-- Muda o titulo da página -->
<script>
  document.title = "Tabela de veículos alugados";
  $('table').tablesort();
</script>

<?php include '..\footer.php'; ?>