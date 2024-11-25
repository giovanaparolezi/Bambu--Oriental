<?php
  session_start(); // Inicia a sessão no início do arquivo
  // Verifica se o usuário está logado
  if (!isset($_SESSION['id_cliente'])) {
      header("Location: login.php"); // Redireciona para o login se não estiver logado
      exit();
  }
  include("header.php");

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva de Horário</title>
    <link rel="stylesheet" href="css/styles.css"> 
    <style>
        body {
    background-image: url('img/img-reserva.jpeg'); 
    background-size: cover;
    background-position: center; 
    background-repeat: no-repeat; 
    height: 150vh; 
    margin: 0; 
    z-index: 100;
}

h3 {
    color: #d94e4e;
    text-align: center;
}

.entrada input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    margin-bottom: 15px;
    background-color: #f9f9f9;
    color: #333;
}

#entrarButton, #criarContaButton {
    width: 100%;
    padding: 10px;
    background-color: #a62103;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

#entrarButton:hover {
    background-color: #c43e3e;
}

.tst {
    margin: 50px auto; 
    padding: 30px 70px; 
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: rgba(0, 0, 0, 0.9);
    border-radius: 15px;
    box-shadow: 0 10px 15px rgba(0, 0, 0, 0.2);
    max-width: 800px; 
    flex-direction: column; 
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


h2 {
    color:white;
    text-align: center;
}

.entrada {
    width: 100%; 
    margin-bottom: 20px;
}


    </style>
</head>

<body>
    
<div class="tst">
    <form id="formulariodeavaliacaoonline" method="POST">
        <section class="entrada">
            <label for="nome">
                <h2>Faça sua Reserva:</h2> 
            </label>
            <br>
            <label for="nome">
                <h3>Insira seu nome:</h3> 
            </label>

            <input type="text" placeholder="Seu Nome" name="nome" required><br>

            <label for="nome">
                <h3>Insira seu email:</h3>
            </label>

            <input type="email" placeholder="Seu Email" name="email" required><br>

            <label for="nome">
                <h3>Insira seu telefone:</h3>
            </label>

            <input type="tel" placeholder="Seu Telefone" name="telefone" required><br>

            <label for="nome">
                <h3>Data da reserva:</h3>
            </label>

            <input type="date" name="data_reserva" required><br>
            <label for="nome">
                <h3>Hora da reserva:</h3>
            </label>

            <input type="time" name="horario_reserva" required><br>


            <label for="nome">
                <h3>Número de pessoas:</h3>
            </label>

            <input type="number" placeholder="Número de Pessoas" name="num_pessoas" min="1" required><br>
        </section>
    
        <input type="submit" id="entrarButton" value="Reservar">
    </form>
</div>

<?php
  // Verifica se o formulário foi enviado
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Obtém os dados do formulário
      $nome = $_POST['nome'];
      $email = $_POST['email'];
      $telefone = $_POST['telefone'];
      $data_reserva = $_POST['data_reserva'];
      $horario_reserva = $_POST['horario_reserva'];
      $num_pessoas = $_POST['num_pessoas'];
      
      // Conexão com o banco
      include_once("conexao.php");
      
      // Verifica se o cliente já existe no banco de dados (por email)
      $sql = "SELECT id_client FROM login WHERE email = ?";
      if ($stmt = $conn->prepare($sql)) {
          $stmt->bind_param("s", $email);
          $stmt->execute();
          $stmt->store_result();

          if ($stmt->num_rows > 0) {
              // Cliente já existe, pega o ID
              $stmt->bind_result($id_cliente);
              $stmt->fetch();
          } else {
              // Cliente não existe, insere no banco e pega o ID
              $sql_insert_cliente = "INSERT INTO login (nome, email, telefone) VALUES (?, ?, ?)";
              if ($stmt_insert = $conn->prepare($sql_insert_cliente)) {
                  $stmt_insert->bind_param("sss", $nome, $email, $telefone);
                  $stmt_insert->execute();
                  $id_cliente = $stmt_insert->insert_id;
                  $stmt_insert->close();
              }
          }

          $stmt->close();
      }

      
      $status_reserva = 'Pendente';  
      

      $sql_reserva = "INSERT INTO reserva (id_cliente, data_reserva, horario_reserva, numero_pessoas, status_reserva)
                      VALUES (?, ?, ?, ?, ?)";

      if ($stmt_reserva = $conn->prepare($sql_reserva)) {
        $stmt_reserva->bind_param("issis", $id_cliente, $data_reserva, $horario_reserva, $num_pessoas, $status_reserva);


          if ($stmt_reserva->execute()) {
              $sucesso_mensagem = "Reserva realizada com sucesso!";
          } else {
              $erro_mensagem = "Erro ao realizar a reserva. Tente novamente.";
          }

          $stmt_reserva->close();
      } else {
          $erro_mensagem = "Erro na preparação da consulta.";
      }
  }
?>

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
include_once 'whats.php'; 
include_once "footer.php";
?> 
