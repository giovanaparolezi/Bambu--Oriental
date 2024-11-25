<?php
session_start();

// Incluir a conexão com o banco de dados
include 'conexao.php';

// Verificar se o formulário foi enviado via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coletar os dados do formulário
    $username = $_POST['UN'];
    $password = $_POST['PW'];

    // Preparar a consulta para buscar o usuário no banco
    $sql = "SELECT * FROM login WHERE nome = ?";
    
    // Preparar a instrução para evitar injeção de SQL
    if ($stmt = $conn->prepare($sql)) {
        // Vincular o nome de usuário como parâmetro
        $stmt->bind_param("s", $username);

        // Executar a consulta
        $stmt->execute();
        $result = $stmt->get_result();

        // Verificar se o usuário existe
        if ($result->num_rows > 0) {
            // Obter os dados do usuário
            $user = $result->fetch_assoc();

            // Verificar se a senha fornecida corresponde à senha armazenada (usando password_verify)
            if (password_verify($password, $user['senha'])) {
                // Login bem-sucedido: iniciar sessão
                $_SESSION['id_cliente'] = $user['id_client']; // Armazena o ID do usuário na sessão
                $_SESSION['nome'] = $user['nome']; // Armazena o nome do usuário na sessão

                
                if ($user['nome'] === 'admin') {
                    header("Location: dashboard.php"); // Redireciona para a página da dashboard
                    exit(); // Adiciona o exit() para garantir que o código não continue após o redirecionamento
                } else {
                    header("Location: index.php"); // Redireciona para a página inicial
                    exit(); // Adiciona o exit() para garantir que o código não continue após o redirecionamento
                }
            } else {
                // Senha incorreta
                echo "<script>alert('Senha incorreta!');</script>";
            }
        } else {
            // Usuário não encontrado
            echo "<script>alert('Usuário não encontrado!');</script>";
        }

        // Fechar a declaração
        $stmt->close();
    } else {
        echo "<script>alert('Erro ao preparar a consulta: " . $conn->error . "');</script>";
    }

    // Fechar a conexão com o banco de dados
    $conn->close();
}
?>

<?php
include("header.php");
?>

<!DOCTYPE html>
<html lang="Pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/styles.css"> 
    <style>
        body {
            background-image: url('img/fundo-login.png'); 
            background-size: cover;
            background-position: center; 
            background-repeat: no-repeat; 
            height: 100vh; 
            margin: 0; 
        }
    </style>
</head>

<body>
<div class="tst">
    <form id="formulariodeavaliacaoonline" method="POST">
        <section class="entrada">
            <label for="nome">
                <h3>Insira seu nome:</h3>
            </label>
            <input type="text" placeholder="Nome de Usuario" name="UN" required><br>
    
            <p>
                <label for="">
                    <h3>Insira sua Senha:</h3>
                </label>
                <input type="password" id="iemail" placeholder="Senha" name="PW" required>
            </p>
        </section>
    
        <input type="submit" id="entrarButton" value="Entrar">
    
        <a href="cadastrar.php"><input type="button" value="Criar Conta"></a>
    </form>
</div>

<?php 
include_once 'whats.php'; 
?>

<?php
include_once "footer.php";
?>
