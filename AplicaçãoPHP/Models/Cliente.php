<?php

namespace Models;

class Cliente implements IDados
{

  private $id;
  private $nome;
  private $cpf;
  private $telefone;

  public function __construct($id, $nome, $cpf, $telefone)
  {
    $this->id = $id;
    $this->nome = $nome;
    $this->cpf = $cpf;
    $this->telefone = $telefone;
  }

  public function toJson()
  {
    return json_encode($this->toArray());
  }

  public function toArray()
  {
    return ['id' => $this->id, 'nome' => $this->nome, 'cpf' => $this->cpf, 'telefone' => $this->telefone];
  }

  use trait__get;
}
