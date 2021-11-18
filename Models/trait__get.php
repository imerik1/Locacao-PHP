<?php

namespace Models;

trait trait__get
{

  public function __get($property)
  {
    return $this->{substr($property, 3)};
  }

  public function __set($property, $value)
  {
    $this->{substr($property, 3)} = $value;
  }
}
