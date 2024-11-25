<?php
include("header.php");


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contato</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        body {
            background-image: url('img/fundo-contato.jpeg');
            background-size: cover;
            background-position: center;
            height: 140vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .tst {
    margin: 50px auto;
    padding: 40px 30px;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: rgba(0, 0, 0, 0.9);
    border-radius: 15px;
    box-shadow: 0 10px 15px rgba(0, 0, 0, 0.2);
    max-width: 500px;
    flex-direction: column;
    width: 60%; 
}

        .entrada h3 {
            font-size: 1.2em;
            color: #ffffff;
            margin-bottom: 10px;
        }

        .form-container {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap; 
            max-width: 800px; 
            margin: 0 auto; 
        }

        .entrada {
            width: 100%; 
            margin-bottom: 20px;
        }

        .entrada input[type="text"],
.entrada input[type="password"],
.entrada input[type="email"],
.entrada input[type="tel"],
.entrada textarea {
    width: 100%; 
    padding: 12px;
    margin-top: 5px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 1em;
}

.entrada textarea {
    height: 120px;
}

        #entrarButton {
            width: 100%;
            padding: 12px;
            margin-top: 20px;
            border: none;
            border-radius: 5px;
            font-size: 1em;
            cursor: pointer;
            background-color: #a62103;
            color: white;
            transition: background-color 0.3s ease;
        }

        #entrarButton:hover {
            background-color: #f25c05;
        }

        input[type="button"] {
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            border: 2px solid #f25c05;
            border-radius: 5px;
            font-size: 1em;
            cursor: pointer;
            background-color: #ffffff;
            color: #f25c05;
            transition: background-color 0.3s ease;
        }

        input[type="button"]:hover {
            background-color: #f25c05;
            color: white;
        }

        .tst h2{
color: white;
text-align: center;
margin-bottom:30px
        }
    </style>
</head>
<body>

<div class="tst">
    <h2>Entre em contato conosco!</h2>
    <form id="formulariodeavaliacaoonline" method="POST">
        <section class="entrada">
            <label for="nome">
                <h3>Seu Nome:</h3>
            </label>
            <input type="text" name="nome" placeholder="Seu Nome" required>
        </section>
        
        <section class="entrada">
            <label for="email">
                <h3>Seu Email:</h3>
            </label>
            <input type="email" name="email" placeholder="Seu Email" required>
        </section>

        <section class="entrada">
            <label for="telefone">
                <h3>Seu Telefone:</h3>
            </label>
            <input type="tel" name="telefone" placeholder="Seu Telefone">
        </section>

        <section class="entrada">
            <label for="mensagem">
                <h3>Escreva sua Mensagem:</h3>
            </label>
            <textarea name="mensagem" placeholder="Escreva sua mensagem aqui" rows="5" required></textarea>
        </section>

        <input type="submit" id="entrarButton" value="Enviar">

    </form>
</div>

<?php 
include_once 'whats.php'; 
include_once "footer.php";
?>

</body>
</html>
