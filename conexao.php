<?php
// Definir as variáveis de conexão
$host = "localhost"; 
$user = "root"; 
$password = ""; 
$database = "bambui3"; 

// Criar a conexão
$conn = new mysqli($host, $user, $password, $database);

$conn->set_charset("utf8");

// Verificar se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}



?>