<?php

namespace Models;

class Pagamento implements IDados
{

  private $id;
  private $id_cliente;
  private $id_veiculo;
  private $preco;
  private $data_pagamento;

  public function __construct($id, $id_cliente, $id_veiculo, $preco, $data_pagamento)
  {
    $this->id = $id;
    $this->id_cliente = $id_cliente;
    $this->id_veiculo = $id_veiculo;
    $this->preco = $preco;
    $this->data_pagamento = $data_pagamento;
  }

  public function toJson()
  {
    return json_encode($this->toArray());
  }

  public function toArray()
  {
    return ['id' => $this->id, 'id_cliente' => $this->id_cliente, 'id_veiculo' => $this->id_veiculo, 'preco' => $this->preco, 'data_pagamento' => $this->data_pagamento];
  }

  use trait__get;
}
