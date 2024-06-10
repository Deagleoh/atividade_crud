<?php
require_once __DIR__ . '/../configuracao/cruddb.php';
require_once __DIR__ . '/../src/Models/User.php';

$database = new Database();
$db = $database->getConnection();

if ($db === null) {
    echo "Não foi possivel conectar ao banco de dados.";
} else {
    echo "Conectado ao banco de dados!";
}

$user = new User($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user->nome = $_POST['nome'];
    $user->email = $_POST['email'];
    $user->senha = password_hash($_POST['senha'], PASSWORD_BCRYPT);

    if ($user->create()) {
        echo "Usuário cadastrado!Bora Bill!"; 
    } else {
        echo "Falha ao cadastrar o usuário.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cadastrar Usuário</title>
    <link rel="stylesheet" type="text/css" href="user.css">
</head>
<body>
    <div class="container">
        <h2>Cadastrar Usuário</h2>
        <?php if (isset($message)): ?>
            <div class="message <?php echo strpos($message, 'sucesso') !== false ? 'success' : 'error'; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="nome">Nome Completo:</label>
            <input type="text" id="nome" name="nome" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>
            
            <input type="submit" value="Cadastrar">
        </form>
        <a href="list_users.php">Retornar para a lista de usuários</a>
    </div>
</body>
</html>