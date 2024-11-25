<?php
// Inclua a conexão com o banco
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_pedido'])) {
    $id_pedido = intval($_POST['id_pedido']);

    // Excluir os itens do pedido
    $query_itens = "DELETE FROM itens_pedido WHERE id_pedido = ?";
    $stmt_itens = $conn->prepare($query_itens);
    if ($stmt_itens) {
        $stmt_itens->bind_param('i', $id_pedido);
        if (!$stmt_itens->execute()) {
            echo "Erro ao excluir itens do pedido: " . $stmt_itens->error;
            exit();
        }
        $stmt_itens->close();
    } else {
        echo "Erro ao preparar a exclusão dos itens: " . $conn->error;
        exit();
    }

    // Excluir o pedido
    $query_pedido = "DELETE FROM pedido WHERE id_pedido = ?";
    $stmt_pedido = $conn->prepare($query_pedido);
    if ($stmt_pedido) {
        $stmt_pedido->bind_param('i', $id_pedido);
        if (!$stmt_pedido->execute()) {
            echo "Erro ao excluir pedido: " . $stmt_pedido->error;
            exit();
        }
        $stmt_pedido->close();
    } else {
        echo "Erro ao preparar a exclusão do pedido: " . $conn->error;
        exit();
    }

    // Redirecionar para a dashboard com mensagem de sucesso
    header("Location: dashboard.php?msg=Pedido excluído com sucesso!");
    exit();
} else {
    // Redirecionar caso a requisição seja inválida
    header("Location: dashboard.php?msg=Requisição inválida.");
    exit();
}
