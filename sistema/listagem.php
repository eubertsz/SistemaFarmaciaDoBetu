<?php
include '../conexao/config.php';

$searchTerm = '';
$orderBy = 'nome';

if (isset($_POST['search'])) {
    $searchTerm = $_POST['searchTerm'];
}

if (isset($_POST['orderBy'])) {
    $orderBy = $_POST['orderBy'];
}

$query = "SELECT * FROM medicamentos WHERE nome LIKE ? ORDER BY $orderBy";
$stmt = $conn->prepare($query);
$searchTermParam = '%' . $searchTerm . '%';
$stmt->bind_param("s", $searchTermParam);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Medicamentos</title>
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
                            <a class="nav-link" href="cadastro.php">Cadastro</a>
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
        <div class="card bg-dark text-white">
            <div class="card-body">
                <h2 class="text-center mb-4">Listagem de Medicamentos</h2>
                <form method="post" class="mb-4">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="searchTerm" placeholder="Buscar medicamento pelo nome" value="<?php echo htmlspecialchars($searchTerm); ?>">
                        <button class="btn btn-warning" type="submit" name="search">Buscar</button>
                    </div>

                    <div class="mb-3">
                        <label for="orderBy" class="form-label">Ordenar por:</label>
                        <select id="orderBy" name="orderBy" class="form-select" onchange="this.form.submit()">
                            <option value="nome" <?php echo ($orderBy === 'nome') ? 'selected' : ''; ?>>Nome</option>
                            <option value="preco" <?php echo ($orderBy === 'preco') ? 'selected' : ''; ?>>Preço</option>
                            <option value="quantidade" <?php echo ($orderBy === 'quantidade') ? 'selected' : ''; ?>>Quantidade</option>
                            <option value="categoria" <?php echo ($orderBy === 'categoria') ? 'selected' : ''; ?>>Categoria</option>
                        </select>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead class="table-danger">
                            <tr>
                                <th>Nome</th>
                                <th>Preço</th>
                                <th>Quantidade</th>
                                <th>Categoria</th>
                                <th>Validade</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($result->num_rows > 0): ?>
                                <?php while ($row = $result->fetch_assoc()): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($row['nome']); ?></td>
                                        <td><?php echo 'R$ ' . number_format($row['preco'], 2, ',', '.'); ?></td>
                                        <td><?php echo htmlspecialchars($row['quantidade']); ?></td>
                                        <td><?php echo htmlspecialchars($row['categoria']); ?></td>
                                        <td><?php echo htmlspecialchars(date('d/m/Y', strtotime($row['validade']))); ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center">Nenhum medicamento encontrado.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
