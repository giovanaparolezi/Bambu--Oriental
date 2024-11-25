<?php
// Iniciar a sessão para recuperar o carrinho
session_start();

// Verificar se o carrinho existe
if (!isset($_SESSION['finalizar_compra']) || empty($_SESSION['finalizar_compra'])) {
    header('Location: finalizar_compra.php'); // Redireciona para o carrinho caso esteja vazio
    exit;
}

// Função para calcular o total do carrinho
function calcularTotalCarrinho() {
    $total = 0;
    foreach ($_SESSION['carrinho'] as $item) {
        $total += $item['quantidade'] * $item['preco'];
    }
    return $total;
}

$totalCarrinho = calcularTotalCarrinho();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Pagamento</title>
</head>
<body>
    <div class="container mt-5">
        <h2>Detalhes da Compra</h2>
        
        <!-- Exibe os itens do carrinho -->
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Produto</th>
                    <th scope="col">Bowl</th>
                    <th scope="col">Quantidade</th>
                    <th scope="col">Preço Unitário</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['carrinho'] as $item): ?>
                    <tr>
                        <td><?= htmlspecialchars($item['id_produto']) ?></td>
                        <td><?= htmlspecialchars($item['id_bowl']) ?></td>
                        <td><?= htmlspecialchars($item['quantidade']) ?></td>
                        <td>R$ <?= number_format($item['preco'], 2, ',', '.') ?></td>
                        <td>R$ <?= number_format($item['quantidade'] * $item['preco'], 2, ',', '.') ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h4>Total: R$ <?= number_format($totalCarrinho, 2, ',', '.') ?></h4>

        <!-- Formulário de pagamento -->
        <form action="finalizar_pedido.php" method="POST">
            <div class="form-group">
                <label for="nome">Nome Completo:</label>
                <input type="text" id="nome" name="nome" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="endereco">Endereço de Entrega:</label>
                <input type="text" id="endereco" name="endereco" class="form-control" required>
            </div>

            <h4>Escolha a forma de pagamento:</h4>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="pagamento" id="pagamento_boleto" value="boleto" required>
                <label class="form-check-label" for="pagamento_boleto">
                    Boleto Bancário
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="pagamento" id="pagamento_cartao" value="cartao" required>
                <label class="form-check-label" for="pagamento_cartao">
                    Cartão de Crédito
                </label>
            </div>

            <button type="submit" class="btn btn-success mt-3">Finalizar Compra</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
