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
$stmt = $user->read();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lista de Usuários</title>
    <link rel="stylesheet" type="text/css" href="user.css">
</head>
<body>
    <div class="container">
        <h2>Lista de Usuários</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Nome Completo</th>
                <th>Email</th>
                <th>Ações</th>
            </tr>
            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['nome']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td>
                        <a href="edit_user.php?id=<?php echo $row['id']; ?>">Editar</a>
                        <a href="delete_user.php?id=<?php echo $row['id']; ?>">Excluir</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
        <a href="user_create.php">Cadastrar Novo Usuário</a>
    </div>
</body>
</html>