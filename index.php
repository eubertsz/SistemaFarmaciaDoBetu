<?php
include 'conexao/config.php';

if (isset($_POST['login'])) {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    if (!$conn) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT * FROM adm WHERE usuario = ? AND senha = ?");
    if ($stmt === false) {
        die("Erro na preparação da consulta: " . $conn->error);
    }

    $stmt->bind_param("ss", $usuario, $senha);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        header('Location: sistema/cadastro.php');
        exit();
    } else {
        echo "<div class='alert alert-danger text-center'>Usuário ou senha incorretos</div>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - FVS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark d-flex align-items-center justify-content-center" style="height: 100vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-lg">
                    <div class="card-header bg-warning text-dark text-center">
                        <h4>Login</h4>
                    </div>
                    <div class="card-body p-4">
                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="usuario" class="form-label text-primary">Usuário:</label>
                                <input type="text" id="usuario" name="usuario" class="form-control border-primary" placeholder="Digite seu usuário" required>
                            </div>
                            <div class="mb-3">
                                <label for="senha" class="form-label text-primary">Senha:</label>
                                <input type="password" id="senha" name="senha" class="form-control border-primary" placeholder="Digite sua senha" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" name="login" class="btn btn-warning text-dark">Entrar</button>
                            </div>
                        </form>
                    </div>
                </div>
                <?php if (isset($error)) { ?>
                    <div class="alert alert-danger text-center mt-3">
                        <?= $error ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
