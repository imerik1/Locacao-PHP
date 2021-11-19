<?php
header('location: carros-index.php');

spl_autoload_register(function ($class_name) {
  include '..\\..\\' . $class_name . '.php';
});

use Db\Persiste;

if (isset($_GET['id'])) {
  Persiste::Delete('Models\Cliente', $_GET['id']);
  Persiste::Delete('Models\Pagamento', $_GET['id']);
  Persiste::Delete('Models\Endereco', $_GET['id']);
  Persiste::Delete('Models\Veiculo', $_GET['id']);
}
