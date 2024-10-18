<?php
include '../conexao/config.php';

if (isset($_POST['cadastrar'])) {
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $quantidade = $_POST['quantidade'];
    $categoria = $_POST['categoria'];
    $validade = $_POST['validade'];

    $query = "INSERT INTO medicamentos (nome, preco, quantidade, categoria, validade) VALUES ('$nome', '$preco', '$quantidade', '$categoria', '$validade')";
    $conn->query($query);

    header('Location: listagem.php');
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Medicamentos - FVS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to bottom, #d1e8ff, #c6e3f3);
        }
    </style>
</head>

<body>
<header>
        <nav class="navbar navbar-expand-lg navbar-light fixed-top">
            <div class="container">
                <a class="navbar-brand" href="">
                    <img src="farmacia.png" alt="Logo Vacinas" style="height: 60px;">
                </a>
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
                            <a class="nav-link" href="venda.php">Vendas</a>
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
        <div class="card shadow-lg p-4 mx-auto" style="max-width: 600px; background-color: #e7f3fe;">
            <h2 class="text-center mb-4 text-primary">Cadastro de Medicamentos</h2>
            <form action="" method="post">
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome do Medicamento</label>
                    <input type="text" id="nome" name="nome" class="form-control" placeholder="Digite o nome do medicamento" required>
                </div>
                <div class="mb-3">
                    <label for="preco" class="form-label">Preço</label>
                    <input type="number" id="preco" name="preco" class="form-control" placeholder="Digite o preço" required>
                </div>
                <div class="mb-3">
                    <label for="quantidade" class="form-label">Quantidade</label>
                    <input type="number" id="quantidade" name="quantidade" class="form-control" placeholder="Digite a quantidade" required>
                </div>
                <div class="mb-3">
                    <label for="categoria" class="form-label">Categoria</label>
                    <select id="categoria" name="categoria" class="form-select" required>
                        <option value="" disabled selected>Selecione a categoria</option>
                        <option value="Analgésico">Analgésico</option>
                        <option value="Antibiótico">Antibiótico</option>
                        <option value="Anti-inflamatório">Anti-inflamatório</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="validade" class="form-label">Validade</label>
                    <input type="date" id="validade" name="validade" class="form-control" required>
                </div>
                <div class="d-grid">
                    <input type="submit" value="Cadastrar" name="cadastrar" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
