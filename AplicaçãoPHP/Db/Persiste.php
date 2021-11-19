<?php

namespace Db;

use \PDO;
use \PDOException;
use \ReflectionClass;

include('Conexao.php');

class Persiste
{
  public static function Add(Object $obj)
  {
    try {
      $pdo = new PDO(DB, DB_USER, DB_PASS);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);

      $rf = new ReflectionClass($obj);

      $aux = explode("\\", $rf->name);
      $tabela = array_pop($aux);
      $tabela = strtolower($tabela . 's');

      $colunas = "";
      $parametros = "";
      $vetor = [];
      $primeiro = true;

      foreach ($rf->getProperties() as $p) {
        if ($primeiro && $obj->{'get' . 'id'} == 0) {
          $primeiro = false;
          continue;
        }
        $colunas = $colunas . $p->name . ',';
        $parametros = $parametros . ':' . $p->name . ',';
        $vetor[$p->name] = $obj->{'get' . $p->name};
      }

      $colunas = substr($colunas, 0, -1);
      $parametros = substr($parametros, 0, -1);

      $stmt = $pdo->prepare("insert into $tabela ($colunas) values ($parametros)");

      $stmt->execute($vetor);

      $retorno = $pdo->lastInsertId();
    } catch (PDOException $pex) {
      $retorno = $pex;
    } finally {

      $pdo = null;
    }
    return $retorno;
  }

  public static function GetAll($nomeclasse)
  {
    try {
      $pdo = new PDO(DB, DB_USER, DB_PASS);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);

      $rf = new ReflectionClass($nomeclasse);
      $aux = explode("\\", $nomeclasse);
      $tabela = array_pop($aux);
      $tabela = strtolower($tabela . 's');
      $colunas = "";
      foreach ($rf->getProperties() as $p) {
        $colunas = $colunas . $p->name . ',';
      }
      $colunas = substr($colunas, 0, -1);

      $stmt = $pdo->prepare("select $colunas from $tabela order by id");
      $stmt->execute();

      $stmt->setFetchMode(PDO::FETCH_ASSOC);

      $retorno = [];
      $linha = $stmt->fetch();
      while ($linha != null) {
        $obj = $rf->newInstanceWithoutConstructor();
        foreach ($linha as $i => $v) {
          $obj->{'set' . $i} = $v;
        }
        array_push($retorno, $obj);
        $linha = $stmt->fetch();
      }
    } catch (PDOException $pex) {
      $retorno = $pex;
    } finally {
      $pdo = null;
    }

    return $retorno;
  }

  public static function GetById($nomeclasse, $id)
  {
    try {
      $pdo = new PDO(DB, DB_USER, DB_PASS);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
      $rf = new ReflectionClass($nomeclasse);
      $aux = explode("\\", $nomeclasse);
      $tabela = array_pop($aux);
      $tabela = strtolower($tabela . 's');
      $colunas = "";
      foreach ($rf->getProperties() as $p) {
        $colunas = $colunas . $p->name . ',';
      }
      $colunas = substr($colunas, 0, -1);

      $stmt = $pdo->prepare("select $colunas from $tabela where id=:id");

      $stmt->execute([':id' => $id]);
      $stmt->setFetchMode(PDO::FETCH_ASSOC);

      $obj = null;
      $linha = $stmt->fetch();
      if ($linha != null) {
        $obj = $rf->newInstanceWithoutConstructor();
        foreach ($linha as $i => $v) {
          $obj->{'set' . $i} = $v;
        }
      }
    } catch (PDOException $pex) {
      $retorno = null;
    } finally {
      $pdo = null;
    }

    return $obj;
  }

  public static function Update(Object $obj)
  {
    try {
      $pdo = new PDO(DB, DB_USER, DB_PASS);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);

      $rf = new ReflectionClass($obj);
      $aux = explode("\\", $rf->name);
      $tabela = array_pop($aux);
      $tabela = strtolower($tabela . 's');
      $parametros = "";
      $vetor = [];
      foreach ($rf->getProperties() as $p) {
        if ($p->name != 'id') {
          $parametros = $parametros . $p->name . ' = :' . $p->name . ',';
        }
        $vetor[':' . $p->name] = $obj->{'get' . $p->name};
      }
      $parametros = substr($parametros, 0, -1);
      $stmt = $pdo->prepare("update $tabela set $parametros where id=:id");
      $stmt->execute($vetor);
      $retorno = true;
    } catch (PDOException $pex) {
      $retorno = $pex;
    } finally {
      $pdo = null;
    }
    return $retorno;
  }

  public static function Delete($nomeclasse, $id)
  {
    try {
      $pdo = new PDO(DB, DB_USER, DB_PASS);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);

      $aux = explode('\\', $nomeclasse);
      $tabela = array_pop($aux);
      $tabela = strtolower($tabela . 's');

      $stmt = $pdo->prepare("delete from $tabela where id=:id");

      $stmt->execute([':id' => $id]);

      $retorno = true;
    } catch (PDOException $pex) {
      $retorno = false;
    } finally {
      $pdo = null;
    }

    return $retorno;
  }

  public static function GetPaginate($nomeclasse, $inicio, $limit)
  {
    try {
      $pdo = new PDO(DB, DB_USER, DB_PASS);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);

      $rf = new ReflectionClass($nomeclasse);
      $aux = explode("\\", $nomeclasse);
      $tabela = array_pop($aux);
      $tabela = strtolower($tabela . 's');
      $colunas = "";
      foreach ($rf->getProperties() as $p) {
        $colunas = $colunas . $p->name . ',';
      }
      $colunas = substr($colunas, 0, -1);

      $stmt = $pdo->prepare("select $colunas from $tabela order by id limit $inicio, $limit");
      $stmt->execute();

      $stmt->setFetchMode(PDO::FETCH_ASSOC);

      $retorno = [];
      $linha = $stmt->fetch();
      while ($linha != null) {
        $obj = $rf->newInstanceWithoutConstructor();
        foreach ($linha as $i => $v) {
          $obj->{'set' . $i} = $v;
        }
        array_push($retorno, $obj);
        $linha = $stmt->fetch();
      }
    } catch (PDOException $pex) {
      $retorno = $pex;
    } finally {
      $pdo = null;
    }

    return $retorno;
  }
}
