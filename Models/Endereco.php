<?php

namespace Models;

class Endereco implements IDados
{

  private $id;
  private $id_cliente;
  private $logradouro;
  private $numero;
  private $bairro;
  private $cidade;
  private $estado;
  private $cep;

  public function __construct($id, $id_cliente, $logradouro, $numero, $bairro, $cidade, $estado, $cep)
  {
    $this->id = $id;
    $this->id_cliente = $id_cliente;
    $this->logradouro = $logradouro;
    $this->numero = $numero;
    $this->bairro = $bairro;
    $this->cidade = $cidade;
    $this->estado = $estado;
    $this->cep = $cep;
  }

  public function toJson()
  {
    return json_encode($this->toArray());
  }

  public function toArray()
  {
    return ['id' => $this->id, 'id_cliente' => $this->id_cliente, 'logradouro' => $this->logradouro, 'numero' => $this->numero, 'bairro' => $this->bairro, 'cidade' => $this->cidade, 'estado' => $this->estado, 'cep' => $this->cep];
  }

  use trait__get;
}
