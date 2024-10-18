<?php
include '../conexao/config.php';

if (isset($_POST['vender'])) {
    $medicamentoId = $_POST['medicamento_id'];
    $quantidadeVendida = $_POST['quantidade_vendida'];

    $stmt = $conn->prepare("SELECT quantidade FROM medicamentos WHERE id = ?");
    $stmt->bind_param("i", $medicamentoId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $quantidadeAtual = $row['quantidade'];

        if ($quantidadeAtual >= $quantidadeVendida) {
            $novaQuantidade = $quantidadeAtual - $quantidadeVendida;
            $updateStmt = $conn->prepare("UPDATE medicamentos SET quantidade = ? WHERE id = ?");
            $updateStmt->bind_param("ii", $novaQuantidade, $medicamentoId);
            $updateStmt->execute();

            $mensagem = "Venda realizada com sucesso!";
            $alertClass = "alert-success";
        } else {
            $mensagem = "Quantidade em estoque insuficiente!";
            $alertClass = "alert-danger";
        }
    } else {
        $mensagem = "Medicamento não encontrado!";
        $alertClass = "alert-danger";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venda de Medicamentos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
<header>
        <nav class="navbar navbar-expand-lg navbar-light fixed-top">
            <div class="container">
                <a class="navbar-brand" href="">
                <img src="farmacia.png" alt="Logo Vacinas" style="height: 60px;">                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="listagem.php">Listagem</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cadastro.php">Cadastro</a>
                        </li>
                        </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="btn btn-outline-dark btn-login" href="../index.php">SAIR</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <br>
    <br>
    <br>
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-info text-white">
                <h2 class="text-center mb-0">Venda de Medicamentos</h2>
            </div>
            <div class="card-body">
                <?php if (isset($mensagem)): ?>
                    <div class="alert <?php echo $alertClass; ?> alert-dismissible fade show" role="alert">
                        <?php echo htmlspecialchars($mensagem); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <form method="post">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="medicamento_id" class="form-label">Medicamento:</label>
                            <select id="medicamento_id" name="medicamento_id" class="form-select" required>
                                <option value="">Selecione...</option>
                                <?php
                                $medicamentos = $conn->query("SELECT id, nome FROM medicamentos");
                                while ($medicamento = $medicamentos->fetch_assoc()) {
                                    echo "<option value=\"{$medicamento['id']}\">{$medicamento['nome']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="quantidade_vendida" class="form-label">Quantidade:</label>
                            <input type="number" id="quantidade_vendida" name="quantidade_vendida" class="form-control" placeholder="Digite a quantidade" required>
                        </div>
                    </div>
                    <div class="d-grid mb-3">
                        <button type="submit" name="vender" class="btn btn-warning btn-lg">Vender</button>
                    </div>
                </form>

                <div class="text-center">
                    <a href="listagem.php" class="btn btn-danger btn-lg">Voltar à Listagem</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
