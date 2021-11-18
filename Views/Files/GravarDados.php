<?php
header('location: /Views/Carros/carros-index.php');
spl_autoload_register(function ($class_name) {
  include '..\\..\\' . $class_name . '.php';
});

use Db\Persiste;
use Models\Cliente;
use Models\Endereco;
use Models\Pagamento;
use Models\Veiculo;

$erro = array();

if ($_FILES) {

  if ($_FILES["arq1"]["tmp_name"] != null) {
    $status = move_uploaded_file(
      $_FILES["arq1"]["tmp_name"],
      "arquivo/" . $_FILES["arq1"]["name"]
    );
    if ($status) {
      $a = fopen("arquivo/" . $_FILES["arq1"]["name"], "r");
      if ($a) {
        $lin = fgetcsv($a, 100, ";");
        $lin = fgetcsv($a, 100, ";");
        while ($lin != null) {
          $ID = $lin[0];
          $NOME = $lin[1];
          $CPF = $lin[2];
          $TELEFONE = $lin[3];
          $novoCliente = new Cliente($ID, $NOME, $CPF, $TELEFONE);
          Persiste::Add($novoCliente);
          $lin = fgetcsv($a, 100, ";");
        }
        fclose($a);
      }
    }
  }

  if ($_FILES["arq2"]["tmp_name"] != null) {
    $status = move_uploaded_file(
      $_FILES["arq2"]["tmp_name"],
      "arquivo/" . $_FILES["arq2"]["name"]
    );
    if ($status) {
      $a = fopen("arquivo/" . $_FILES["arq2"]["name"], "r");
      if ($a) {
        $lin = fgetcsv($a, 100, ";");
        $lin = fgetcsv($a, 100, ";");
        while ($lin != null) {
          $ID = $lin[0];
          $MARCA = $lin[1];
          $MODELO = $lin[2];
          $ANO = $lin[3];
          $PLACA = $lin[4];
          $PRECO = $lin[5];
          $novoVeiculo = new Veiculo($ID, $MARCA, $MODELO, $ANO, $PLACA, $PRECO);
          Persiste::Add($novoVeiculo);
          $lin = fgetcsv($a, 100, ";");
        }
        fclose($a);
      }
    }
  }

  if ($_FILES["arq3"]["tmp_name"] != null) {
    $status = move_uploaded_file(
      $_FILES["arq3"]["tmp_name"],
      "arquivo/" . $_FILES["arq3"]["name"]
    );

    if ($status) {
      $a = fopen("arquivo/" . $_FILES["arq3"]["name"], "r");
      if ($a) {
        $lin = fgetcsv($a, 100, ";");
        $lin = fgetcsv($a, 100, ";");
        while ($lin != null) {
          $ID = $lin[0];
          $ID_CLIENTE = $lin[1];
          $LOGRADOURO = $lin[2];
          $NUMERO = $lin[3];
          $BAIRRO = $lin[4];
          $CIDADE = $lin[5];
          $ESTADO = $lin[6];
          $CEP = $lin[7];
          $novoEndereco = new Endereco($ID, $ID_CLIENTE, $LOGRADOURO, $NUMERO, $BAIRRO, $CIDADE, $ESTADO, $CEP);
          Persiste::Add($novoEndereco);
          $lin = fgetcsv($a, 100, ";");
        }
        fclose($a);
      }
    }
  }

  if ($_FILES["arq4"]["tmp_name"] != null) {
    $status = move_uploaded_file(
      $_FILES["arq4"]["tmp_name"],
      "arquivo/" . $_FILES["arq4"]["name"]
    );

    if ($status) {
      $a = fopen("arquivo/" . $_FILES["arq4"]["name"], "r");
      if ($a) {
        $lin = fgetcsv($a, 100, ";");
        $lin = fgetcsv($a, 100, ";");
        while ($lin != null) {
          $ID = $lin[0];
          $ID_CLIENTE = $lin[1];
          $ID_VEICULO = $lin[2];
          $PRECO = $lin[3];
          $DATA_PAGAMENTO = $lin[4];
          $novoPagamento = new Pagamento($ID, $ID_CLIENTE, $ID_VEICULO, $PRECO, $DATA_PAGAMENTO);
          Persiste::Add($novoPagamento);
          $lin = fgetcsv($a, 100, ";");
        }
        fclose($a);
      }
    }
  }
}
