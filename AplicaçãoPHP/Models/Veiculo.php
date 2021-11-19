<?php

namespace Models;

class Veiculo implements IDados
{

  private $id;
  private $marca;
  private $modelo;
  private $ano;
  private $placa;
  private $preco;

  public function __construct($id, $marca, $modelo, $ano, $placa, $preco)
  {
    $this->id = $id;
    $this->marca = $marca;
    $this->modelo = $modelo;
    $this->ano = $ano;
    $this->placa = $placa;
    $this->preco = $preco;
  }

  public function toJson()
  {
    return json_encode($this->toArray());
  }

  public function toArray()
  {
    return ['id' => $this->id, 'marca' => $this->marca, 'modelo' => $this->modelo, 'ano' => $this->ano, 'placa' => $this->placa, 'preco' => $this->preco];
  }

  use trait__get;
}
