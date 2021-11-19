<?php
spl_autoload_register(function ($class_name) {
  include '..\\..\\' . $class_name . '.php';
});

use Models\Cliente;
use Models\Veiculo;
use Models\Endereco;
use Models\Pagamento;
use Db\Persiste;

$_POST = json_decode(file_get_contents('php://input'), true);
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
if (
  isset($_POST['nome']) &&
  isset($_POST['cpf']) &&
  isset($_POST['telefone']) &&
  isset($_POST['logradouro']) &&
  isset($_POST['numero']) &&
  isset($_POST['cep']) &&
  isset($_POST['bairro']) &&
  isset($_POST['cidade']) &&
  isset($_POST['estado']) &&
  isset($_POST['marca']) &&
  isset($_POST['modelo']) &&
  isset($_POST['ano']) &&
  isset($_POST['preco']) &&
  isset($_POST['placa']) &&
  isset($_GET["id"])
) {
  $novoCliente = new Cliente($_GET["id"], $_POST['nome'], $_POST['cpf'], $_POST['telefone']);
  Persiste::Update($novoCliente);
  $novoVeiculo = new Veiculo($_GET["id"], $_POST['marca'], $_POST['modelo'], $_POST['ano'], $_POST['placa'], $_POST['preco']);
  Persiste::Update($novoVeiculo);
  $novoEndereco = new Endereco($_GET["id"], $_GET["id"], $_POST['logradouro'], $_POST['numero'], $_POST['bairro'], $_POST['cidade'], $_POST['estado'], $_POST['cep']);
  Persiste::Update($novoEndereco);
  $p = Persiste::GetById('Models\Pagamento', $_GET['id']);
  $novoPagamento = new Pagamento($_GET["id"], $_GET["id"], $_GET["id"], $_POST['preco'], $p->getdata_pagamento);
  Persiste::Update($novoPagamento);
  http_response_code(204);
} else {
  http_response_code(400);
  $result = ['error' => "Bad Request."];
  echo json_encode($result);
}
