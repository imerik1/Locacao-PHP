<?php
spl_autoload_register(function ($class_name) {
  include '..\\..\\' . $class_name . '.php';
});

use Db\Persiste;

$result = [];

if (isset($_GET['id']) && isset($_GET['page']) && isset($_GET['limit'])) {
  $clientes = Persiste::GetPaginate('Models\Cliente', isset($_GET['page']), isset($_GET['limit']));
  $veiculos = Persiste::GetPaginate('Models\Veiculo', isset($_GET['page']), isset($_GET['limit']));
  $pagamentos = Persiste::GetPaginate('Models\Pagamento', isset($_GET['page']), isset($_GET['limit']));
  $enderecos = Persiste::GetPaginate('Models\Endereco', isset($_GET['page']), isset($_GET['limit']));
  if (is_array($clientes) && is_array($veiculos) && is_array($pagamentos) && is_array($enderecos)) {
    for ($i = 0; $i < count($clientes); ++$i) {
      $v = $veiculos[$i];
      $c = $clientes[$i];
      $p = $pagamentos[$i];
      $e = $enderecos[$i];
      $vet = [
        'id' => $c->getid,
        'nome' => $c->getnome,
        'cpf' => $c->getcpf,
        'telefone' => $c->gettelefone,
        'logradouro' => $e->getlogradouro,
        'numero' => $e->getnumero,
        'bairro' => $e->getbairro,
        'cidade' => $e->getcidade,
        'estado' => $e->getestado,
        'cep' => $e->getcep,
        'marca' => $v->getmarca,
        'modelo' => $v->getmodelo,
        'preco' => $v->getpreco,
        'placa' => $v->getplaca,
        'ano' => $v->getano,
        'data_pagamento' => $p->getdata_pagamento,
      ];
      $result[$i] = $vet;
    }
    http_response_code(200);
    echo json_encode($result);
  } else {
    http_response_code(500);
    $result = ['error' => "Internal Server Error."];
    echo json_encode($result);
  }
} else if (isset($_GET['id'])) {
  $c = Persiste::GetById('Models\Cliente', $_GET['id']);
  $v = Persiste::GetById('Models\Veiculo', $_GET['id']);
  $e = Persiste::GetById('Models\Endereco', $_GET['id']);
  $p = Persiste::GetById('Models\Pagamento', $_GET['id']);
  if (isset($c) && isset($v) && isset($e) && isset($p)) {
    $result = [
      'id' => $c->getid,
      'nome' => $c->getnome,
      'cpf' => $c->getcpf,
      'telefone' => $c->gettelefone,
      'logradouro' => $e->getlogradouro,
      'numero' => $e->getnumero,
      'bairro' => $e->getbairro,
      'cidade' => $e->getcidade,
      'estado' => $e->getestado,
      'cep' => $e->getcep,
      'marca' => $v->getmarca,
      'modelo' => $v->getmodelo,
      'preco' => $v->getpreco,
      'placa' => $v->getplaca,
      'ano' => $v->getano,
      'data_pagamento' => $p->getdata_pagamento,
    ];
    http_response_code(200);
    echo json_encode($result);
  } else {
    http_response_code(404);
    $result = ['error' => "User not found."];
    echo json_encode($result);
  }
} else {
  $clientes = Persiste::GetAll('Models\Cliente');
  $veiculos = Persiste::GetAll('Models\Veiculo');
  $pagamentos = Persiste::GetAll('Models\Pagamento');
  $enderecos = Persiste::GetAll('Models\Endereco');
  if (is_array($clientes) && is_array($veiculos) && is_array($pagamentos) && is_array($enderecos)) {
    for ($i = 0; $i < count($clientes); ++$i) {
      $v = $veiculos[$i];
      $c = $clientes[$i];
      $p = $pagamentos[$i];
      $e = $enderecos[$i];
      $vet = [
        'id' => $c->getid,
        'nome' => $c->getnome,
        'cpf' => $c->getcpf,
        'telefone' => $c->gettelefone,
        'logradouro' => $e->getlogradouro,
        'numero' => $e->getnumero,
        'bairro' => $e->getbairro,
        'cidade' => $e->getcidade,
        'estado' => $e->getestado,
        'cep' => $e->getcep,
        'marca' => $v->getmarca,
        'modelo' => $v->getmodelo,
        'preco' => $v->getpreco,
        'placa' => $v->getplaca,
        'ano' => $v->getano,
        'data_pagamento' => $p->getdata_pagamento,
      ];
      $result[$i] = $vet;
    }
    http_response_code(200);
    echo json_encode($result);
  } else {
    http_response_code(500);
    $result = ['error' => "Internal Server Error."];
    echo json_encode($result);
  }
}
