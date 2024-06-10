<?php

require_once __DIR__ . '/../configuracao/cruddb.php';
require_once __DIR__ . '/../src/Models/User.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

if (isset($_GET['id'])) {
    $user->id = $_GET['id'];
    
    if ($user->delete()) {
        echo "Usuário apagado!";
    } else {
        echo "Usuário não deletado.";
    }
} else {
    echo "ID do usuário não selecionado.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Deletar Usuário</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 50%;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
            text-align: center;
        }
        h2 {
            color: #333;
        }
        a {
            color: #5cb85c;
            text-decoration: none;
            display: block;
            margin-top: 20px;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Deletado!</h2>
        <a href="list_users.php">Retornar para a lista de usuários</a>
    </div>
</body>
</html>
