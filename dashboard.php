<?php
// Incluir o arquivo de conexão
include 'conexao.php'; 
include 'header.php'; 

// Consulta SQL corrigida para incluir ingredientes dos bowls
$query = "
  SELECT p.id_pedido, 
         DATE_FORMAT(p.data_pedido, '%d/%m/%Y') AS data_pedido, 
         COALESCE(GROUP_CONCAT(DISTINCT bp.nome_bowl SEPARATOR ', '), 'Nenhum') AS bowls,
         GROUP_CONCAT(DISTINCT bi.ingrediente SEPARATOR ', ') AS ingredientes,
         GROUP_CONCAT(DISTINCT i.quantidade SEPARATOR ', ') AS quantidades,
         GROUP_CONCAT(DISTINCT FORMAT(i.preco_und, 2) SEPARATOR ', ') AS precos,
         SUM(i.subtotal) AS total
  FROM pedido p
  LEFT JOIN itens_pedido i ON p.id_pedido = i.id_pedido
  LEFT JOIN bowl bp ON i.id_bowl = bp.id_bowl
  LEFT JOIN bowl_ingredientes bi_rel ON bp.id_bowl = bi_rel.id_bowl
  LEFT JOIN bowl_ing bi ON bi_rel.id_ing_bowl = bi.id_ing_bowl
  GROUP BY p.id_pedido, p.data_pedido
";

// Executar a consulta
$result = $conn->query($query);

// Verificar se a consulta retornou resultados
$pedidos = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pedidos[] = $row;
    }
}

// Fechar a conexão
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Gerenciar Pedidos</title>
</head>
<body>
    <div id="main-container">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Gerenciar Pedidos</h2>
                </div>
                <div class="col-md-12 table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Pedido</th>
                                <th scope="col">Data do Pedido</th>
                                <th scope="col">Bowls</th>
                                <th scope="col">Ingredientes</th>
                               
                                <th scope="col">Preço Unitário</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($pedidos)): ?>
                                <?php foreach ($pedidos as $pedido): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($pedido['id_pedido']) ?></td>
                                        <td><?= htmlspecialchars($pedido['data_pedido']) ?></td>
                                        <td><?= htmlspecialchars($pedido['bowls']) ?></td>
                                        <td><?= htmlspecialchars($pedido['ingredientes']) ?></td>
                                     
                                        <td><?= htmlspecialchars($pedido['precos']) ?></td>
                                        <td>
                                            <form action="finalizar_pedido.php" method="POST" class="form-group">
                                                <input type="hidden" name="id_pedido" value="<?= htmlspecialchars($pedido['id_pedido']) ?>">
                                                <button type="submit" class="btn btn-success">Finalizar Compra</button>
                                            </form>
                                            <form action="excluir_pedido.php" method="POST" class="form-group d-inline">
                                            <input type="hidden" name="id_pedido" value="<?= htmlspecialchars($pedido['id_pedido']) ?>">
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza de que deseja excluir este pedido?')">Excluir Pedido</button>
                                             </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center">Nenhum pedido encontrado.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
