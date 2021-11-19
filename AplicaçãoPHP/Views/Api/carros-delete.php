<?php
spl_autoload_register(function ($class_name) {
  include '..\\..\\' . $class_name . '.php';
});

use Db\Persiste;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
if (isset($_GET['id'])) {
  Persiste::Delete('Models\Cliente', $_GET['id']);
  Persiste::Delete('Models\Pagamento', $_GET['id']);
  Persiste::Delete('Models\Endereco', $_GET['id']);
  Persiste::Delete('Models\Veiculo', $_GET['id']);
  http_response_code(204);
} else {
  http_response_code(500);
  $result = ['error' => "Internal Server Error."];
  echo json_encode($result);
}
