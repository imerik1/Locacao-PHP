<?php
spl_autoload_register(function ($class_name) {
  include '..\\..\\' . $class_name . '.php';
});

use Db\Persiste;

if (isset($_GET['id'])) {
  $c = Persiste::GetById('Models\Cliente', $_GET['id']);
  $v = Persiste::GetById('Models\Veiculo', $_GET['id']);
  $e = Persiste::GetById('Models\Endereco', $_GET['id']);
  $p = Persiste::GetById('Models\Pagamento', $_GET['id']);
  if (isset($c) && isset($v) && isset($e) && isset($p)) {
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
    echo json_encode($vet);
  } else {
    $msg = ['mensagem' => "Nenhum usuário encontrado."];
    echo json_encode($msg);
  }
} else {
  $clientes = Persiste::GetAll('Models\Cliente');
  $veiculos = Persiste::GetAll('Models\Veiculo');
  $pagamentos = Persiste::GetAll('Models\Pagamento');
  $enderecos = Persiste::GetAll('Models\Endereco');
  $result = [];
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
  echo json_encode($result);
}
