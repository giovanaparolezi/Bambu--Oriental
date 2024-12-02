<?php
// Iniciar a sessão para armazenar o carrinho
session_start();


// Verifica se a sessão já foi iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once("conexao.php");

// Verifique se o usuário está logado e pegue o nome
$nomeUsuario = isset($_SESSION['nome']) ? $_SESSION['nome'] : null;

// Calcula o total de itens no carrinho
function calcularQuantidadeItensCarrinho() {
    if (!isset($_SESSION['carrinho'])) {
        return 0; // Se o carrinho estiver vazio, retorna 0
    }
    $total = 0;
    foreach ($_SESSION['carrinho'] as $item) {
        $total += $item['quantidade'];
    }
    return $total;
}

// Obtém o total de itens no carrinho
$quantidadeItens = calcularQuantidadeItensCarrinho();




// Verificar se o carrinho já está iniciado
if (!isset($_SESSION['finalizar_compra'])) {
    $_SESSION['finalizar_compra'] = [];
}

// Função para adicionar o item ao carrinho
function adicionarAoCarrinho($id_produto, $id_bowl, $quantidade, $preco) {
    // Verifica se o item já existe no carrinho
    $encontrado = false;
    foreach ($_SESSION['finalizar_compra'] as &$item) {
        if ($item['id_produto'] == $id_produto && $item['id_bowl'] == $id_bowl) {
            $item['quantidade'] += $quantidade; // Atualiza a quantidade
            $encontrado = true;
            break;
        }
    }

    // Se o item não foi encontrado, adicionar novo item ao carrinho
    if (!$encontrado) {
        $_SESSION['carrinho'][] = [
            'id_produto' => $id_produto,
            'id_bowl' => $id_bowl,
            'quantidade' => $quantidade,
            'preco' => $preco
        ];
    }
}

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_produto = $_POST['id_produto'];
    $id_bowl = $_POST['id_bowl'];
    $quantidade = $_POST['quantidade'];
    $preco = $_POST['preco']; // Pode ser o preço unitário do produto

    // Adicionar ao carrinho
    adicionarAoCarrinho($id_produto, $id_bowl, $quantidade, $preco);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Carrinho de Compras</title>
</head>
<body>
    <div class="container mt-5">
        <h2>Carrinho de Compras</h2>
        <?php if (!empty($_SESSION['carrinho'])): ?>
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
                            <td>R$ <?= htmlspecialchars($item['preco']) ?></td>
                            <td>R$ <?= htmlspecialchars($item['quantidade'] * $item['preco']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Seu carrinho está vazio.</p>
        <?php endif; ?>

       
    </div>

   

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>



