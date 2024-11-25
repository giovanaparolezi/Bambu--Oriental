<?php 
include("header.php");
include("conexao.php");

// Verificar se o formulário foi enviado via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coletar os dados do formulário
    $login = $_POST['login'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $senha = $_POST['senha'];
    $confirmar_senha = $_POST['senhac'];

    // Verificar se a senha e a confirmação são iguais
    if ($senha === $confirmar_senha) {
        // Criptografar a senha para armazenamento seguro
        $senha_criptografada = password_hash($senha, PASSWORD_DEFAULT);

        // Preparar a consulta SQL para inserção
        $sql = "INSERT INTO login (nome, email, senha, telefone) VALUES (?, ?, ?, ?)";

        // Preparar a instrução para evitar injeção de SQL
        if ($stmt = $conn->prepare($sql)) {
            // Vincular os parâmetros à consulta SQL
            $stmt->bind_param("ssss", $login, $email, $senha_criptografada, $telefone);

            // Executar a consulta
            if ($stmt->execute()) {
                $sucesso_mensagem = "Conta criada com sucesso!";
            } else {
                $erro_mensagem = "Erro ao criar conta: " . $stmt->error;
            }

            // Fechar a declaração
            $stmt->close();
        } else {
            $erro_mensagem = "Erro ao preparar a consulta: " . $conn->error;
        }
    } else {
        $erro_mensagem = "As senhas não coincidem!";
    }
}


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            background-image: url('img/fundo-login.png'); 
            background-size: cover;
            background-position: center; 
            background-repeat: no-repeat; 
            height: 150vh; 
            margin: 0; 
            justify-content: space-between;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        /* Formulário de login/cadastro */
        .tst {
            margin: 50px auto; /* Aumenta a margem superior e inferior */
            padding: 40px 30px;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: rgba(0, 0, 0, 0.9);
            border-radius: 15px;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.2);
            max-width: 800px; /* Ajuste a largura máxima conforme necessário */
            flex-direction: column; /* Para empilhar os elementos verticalmente */
        }

        .entrada h3 {
            font-size: 1.2em;
            color: #ffffff;
            margin-bottom: 10px;   
        }

        .form-container {
            display: grid;
            justify-content: space-between;
            flex-wrap: wrap; 
            width: 100%; 
            justify-items: center;
        }

        .entrada {
            width: 90%; /* Ajusta a largura dos campos */
            margin-bottom: 20px;  
        }

        .entrada input[type="text"],
        .entrada input[type="password"],
        .entrada input[type="email"] {
            width: 100%;
            padding: 10px; 
            margin-top: 5px;
            margin-bottom: 15px; /* Adiciona espaço abaixo de cada caixa de entrada */
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1em;
        }

        #entrarButton {
            width: 50%; /* Ajuste a largura do botão */
            padding: 10px; /* Ajuste o padding para deixá-lo menor */
            margin: 20px auto; /* Centraliza o botão */
            border: none;
            border-radius: 5px;
            font-size: 1em;
            cursor: pointer;
            background-color: #a62103;
            color: white;
            transition: background-color 0.3s ease;
            display: block; /* Para centralizar */
        }

        #entrarButton:hover {
            background-color: #f25c05;
        }

        footer {
            margin-top: 20px; 
            padding: 10px;
            text-align: center;
            background-color: #333; /* Exemplo de cor de fundo */
            color: #fff; /* Exemplo de cor do texto */
        }

        /* Formulário de login/cadastro */
.tst {
    margin: 50px auto; 
    padding: 40px 30px;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: rgba(0, 0, 0, 0.9);
    border-radius: 15px;
    box-shadow: 0 10px 15px rgba(0, 0, 0, 0.2);
    max-width: 400px; 
    flex-direction: column; 
}


.entrada h3 {
    font-size: 1.2em;
    color: #ffffff;
    margin-bottom: 10px;
}

.nome h3 {
    color: white;
}

.erro-mensagem, .sucesso-mensagem {
    font-size: 1.1em;
    margin: 10px auto;
    padding: 10px;
    border-radius: 5px;
    max-width: 400px;
    text-align: center;
}

.erro-mensagem {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

.sucesso-mensagem {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

    </style>
</head>

<body>


    <form id="formulariodeavaliacaoonline" method="POST" action="cadastrar.php" class="tst">
        <div class="form-container">
            <section class="entrada">
                <label for="login">
                    <h3>Nome de usuário:</h3>
                </label>
                <input type="text" placeholder="Nome de Usuario" name="login" required>

                <label for="email">
                    <h3>Insira seu e-mail:</h3>
                </label>
                <input type="email" placeholder="E-mail" name="email" required>

                <label for="telefone">
                    <h3>Insira seu telefone:</h3>
                </label>
                <input type="text" placeholder="Telefone" name="telefone" required>

                <label for="criarsenha">
                    <h3>Crie sua senha:</h3>
                </label>
                <input type="password" placeholder="Inserir senha" name="senha" required>

                <label for="confirmarsenha">
                    <h3>Confirme sua senha:</h3>
                </label>
                <input type="password" placeholder="Confirmar senha" name="senhac" required>
            </section>
        </div>

        <input type="submit" id="entrarButton" value="Criar Conta">
    </form>

    
<!-- Exibe mensagens de erro ou sucesso -->
<?php
  if (isset($erro_mensagem)) {
      echo "<div class='erro-mensagem'>$erro_mensagem</div>";
  }

  if (isset($sucesso_mensagem)) {
      echo "<div class='sucesso-mensagem'>$sucesso_mensagem</div>";
  }
?>

<?php
include_once "footer.php";
?>

