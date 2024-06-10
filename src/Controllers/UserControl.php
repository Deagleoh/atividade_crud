<?php
require_once __DIR__ . '/../../configuracao/cruddb.php';
require_once __DIR__ . '/../Models/User.php';

$database = new Database();
$db = $database->getConnection();

if ($db === null) {
    echo "Falha ao conectar ao banco de dados.";
}
?>
