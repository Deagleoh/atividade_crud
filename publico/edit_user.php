<?php
require_once __DIR__ . '/../configuracao/cruddb.php';
require_once __DIR__ . '/../src/Models/User.php';

$database = new Database();
$db = $database->getConnection();

if ($db === null) {
    echo "Falha ao conectar ao banco de dados.";
    exit;
}

$user = new User($db);

if (isset($_GET['id'])) {
    $user->id = $_GET['id'];
    $user->readOne();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user->id = $_POST['id'];
    $user->nome = $_POST['nome'];
    $user->email = $_POST['email'];

    if (!empty($_POST['senha'])) {
        $user->senha = password_hash($_POST['senha'], PASSWORD_BCRYPT);
    }

    if ($user->update()) {
        echo "Usuário atualizado!.";
    } else {
        echo "Usuário não atualizado.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Usuário</title>
    <link rel="stylesheet" type="text/css" href="user.css">
</head>
<body>
    <div class="container">
        <h2>Editar Usuário</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="hidden" name="id" value="<?php echo $user->id; ?>">
            
            <label for="nome">Nome Completo:</label>
            <input type="text" id="nome" name="nome" value="<?php echo $user->nome; ?>" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $user->email; ?>" required>
            
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha">
            
            <input type="submit" value="Atualizar">
        </form>
        <a href="list_users.php">Retornar para a lista de usuários</a>
    </div>
</body>
</html>
