<?php
session_start();

// Destrua a sessão
session_unset();
session_destroy();

// Redirecione para a página inicial ou login após o logout
header("Location: index.php");
exit;
?>
