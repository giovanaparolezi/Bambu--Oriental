<?php

include_once("conexao.php");

$sql = "SELECT * FROM produto where nome_categoria = 'mais vendidos'";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
  
    $mais_vendidos = [];
    while ($row = $result->fetch_assoc()) {
        $mais_vendidos[] = $row;
    }
} else {
    echo "Nenhum produto encontrado.";
}

$sql = "SELECT * FROM produto where nome_categoria = 'entradas'";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    // Criar um array para armazenar os produtos
    $entradas = [];
    while ($row = $result->fetch_assoc()) {
        $entradas[] = $row;
    }
} else {
    echo "Nenhum produto encontrado.";
}

// Consulta SQL para obter os produtos
$sql = "SELECT * FROM produto where nome_categoria = 'acompanhamentos'";
$result = $conn->query($sql);

// Verificar se há produtos
if ($result->num_rows > 0) {
    // Criar um array para armazenar os produtos
    $acompanhamentos = [];
    while ($row = $result->fetch_assoc()) {
        $acompanhamentos[] = $row;
    }
} else {
    echo "Nenhum produto encontrado.";
}

// Consulta SQL para obter os produtos
$sql = "SELECT * FROM produto where nome_categoria = 'bebidas'";
$result = $conn->query($sql);

// Verificar se há produtos
if ($result->num_rows > 0) {
    // Criar um array para armazenar os produtos
    $bebidas = [];
    while ($row = $result->fetch_assoc()) {
        $bebidas[] = $row;
    }
} else {
    echo "Nenhum produto encontrado.";
}

// Consulta SQL para obter os produtos
$sql = "SELECT * FROM produto where nome_categoria = 'sobremesas'";
$result = $conn->query($sql);

// Verificar se há produtos
if ($result->num_rows > 0) {
    // Criar um array para armazenar os produtos
    $sobremesas = [];
    while ($row = $result->fetch_assoc()) {
        $sobremesas[] = $row;
    }
} else {
    echo "Nenhum produto encontrado.";
}

$conn->close();

include("header.php");
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="latin1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>

    <style>
      /* Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Body styling */
body {
    font-family: 'Agrandir';
    background-color: #222;
    color: white;
    
}


.conheca h1 {
    font-family: 'Adumu', sans-serif;
    font-size: 3em;
    color: white;
    margin-top: 20px;
    text-align: center;
}

.conheca nav {
    display: flex;
    justify-content: center; 
    gap: 15px; 
    margin-top: 10px; 
}

.conheca nav a {
    color: white;
    text-decoration: none;
    font-weight: bold;
    font-size: 0.9em;
}

.conheca nav a:hover {
    color: #a62103;
}


.product-section {
    padding: 2rem;
    text-align: center;
}


.product-section h2 {
    font-size: 2rem;
    margin-bottom: 1rem;
    color: white;
    text-align: start;
}


.product-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 5rem;
    justify-content: center;
}

.product-card {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    display: flex;
    align-items: center;
    width: 600px; 
    padding: 1rem;
    margin: 1rem;
    
}


.product-card img {
    width: 150px; 
    height: 150px;
    object-fit: cover; 
    border-radius: 10px;
    margin-right: 1rem;
}



.product-info {
    flex: 1;
    text-align: left;
}


.product-info h3 {
    font-size: 1.2rem;
    margin-bottom: 0.5rem;
    color: #333;
    
}


.product-info p {
    font-size: 0.9rem;
    color: #666;
    margin-bottom: 1rem;
    line-height: 1.4;
    
    
}


.price-button-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 0.5rem;
}


.product-info span {
    font-size: 1.1rem;
    font-weight: bold;
    color: #333;
}


.product-info button {
    padding: 0.4rem 1rem;
    background-color: #000;
    color: white;
    border: none;
    border-radius: 20px;
    cursor: pointer;
    font-size: 0.9rem;
}

.product-info button:hover {
    background-color: #333;
}

#cart {
    border: 1px solid #ccc;
    padding: 20px;
    width: 300px;
    margin-top: 20px;
}
.cart-item {
    margin-bottom: 10px;
}
    </style>
</head>
<body>


<div class="conheca">
        <h1>Conheça nossos produtos!</h1>
        <nav>
            <a href="#teste">mais vendidos</a>
            <a href="#entradas">entradas</a>
            <a href="#acompanhamentos">acompanhamentos</a>
            <a href="#bebidas">bebidas</a>
            <a href="montebowl.php">monte seu Bowl</a>
            <a href="#sobremesas">sobremesas</a>
        </nav>
    </div>



    <main>
    <section class="product-section">
        <h2 id="mais vendidos">mais vendidos</h2>
        <div class="product-grid">
            <?php foreach ($mais_vendidos as $produto): ?>
                <div class="product-card">
                    <img src="img/cardapio trabalho final/<?php echo $produto['nome_categoria']; ?>/<?php echo $produto['nome_produto']; ?>.png" alt="<?php $produto['nome_produto']; ?>">
                    <div class="product-info">
                        <h3><?php echo $produto['nome_produto']; ?></h3>
                        <p><?php echo $produto['desc_']; ?></p>
                        <div class="price-button-container">
                            <span>R$ <?php echo number_format($produto['valor_und'], 2, ',', '.'); ?></span>
                            <button onclick="addToCart('<?php echo $produto['nome_produto']; ?>', <?php echo $produto['valor_und']; ?>, 'img/cardapio trabalho final/<?php echo $produto['nome_categoria']; ?>/<?php echo $produto['nome_produto']; ?>.png', <?php echo $produto['id_produto']; ?>)">Adicionar</button>

                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

        <!-- Section "entradas" -->
        <section class="product-section">
        <h2 id="entradas">entradas</h2>
        <div class="product-grid">
            <?php foreach ($entradas as $produto): ?>
                <div class="product-card">
                    <img src="img/cardapio trabalho final/<?php echo $produto['nome_categoria']; ?>/<?php echo $produto['nome_produto']; ?>.png" alt="<?php $produto['nome_produto']; ?>">
                    <div class="product-info">
                        <h3><?php echo $produto['nome_produto']; ?></h3>
                        <p><?php echo $produto['desc_']; ?></p>
                        <div class="price-button-container">
                            <span>R$ <?php echo number_format($produto['valor_und'], 2, ',', '.'); ?></span>
                            <button onclick="addToCart('<?php echo $produto['nome_produto']; ?>', <?php echo $produto['valor_und']; ?>, 'img/cardapio trabalho final/<?php echo $produto['nome_categoria']; ?>/<?php echo $produto['nome_produto']; ?>.png')">Adicionar</button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

        <!-- Section "acompanhamentos" -->
        <section class="product-section">
        <h2 id="acompanhamentos">acompanhamentos</h2>
        <div class="product-grid">
            <?php foreach ($acompanhamentos as $produto): ?>
                <div class="product-card">
                    <img src="img/cardapio trabalho final/<?php echo $produto['nome_categoria']; ?>/<?php echo $produto['nome_produto']; ?>.png" alt="<?php $produto['nome_produto']; ?>">
                    <div class="product-info">
                        <h3><?php echo $produto['nome_produto']; ?></h3>
                        <p><?php echo $produto['desc_']; ?></p>
                        <div class="price-button-container">
                            <span>R$ <?php echo number_format($produto['valor_und'], 2, ',', '.'); ?></span>
                            <button onclick="addToCart('<?php echo $produto['nome_produto']; ?>', <?php echo $produto['valor_und']; ?>, 'img/cardapio trabalho final/<?php echo $produto['nome_categoria']; ?>/<?php echo $produto['nome_produto']; ?>.png')">Adicionar</button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

         <!-- Section "bebidas" -->
         <section class="product-section">
        <h2 id="bebidas">bebidas</h2>
        <div class="product-grid">
            <?php foreach ($bebidas as $produto): ?>
                <div class="product-card">
                    <img src="img/cardapio trabalho final/<?php echo $produto['nome_categoria']; ?>/<?php echo $produto['nome_produto']; ?>.png" alt="<?php $produto['nome_produto']; ?>">
                    <div class="product-info">
                        <h3><?php echo $produto['nome_produto']; ?></h3>
                        <p><?php echo $produto['desc_']; ?></p>
                        <div class="price-button-container">
                            <span>R$ <?php echo number_format($produto['valor_und'], 2, ',', '.'); ?></span>
                            <button onclick="addToCart('<?php echo $produto['nome_produto']; ?>', <?php echo $produto['valor_und']; ?>, 'img/cardapio trabalho final/<?php echo $produto['nome_categoria']; ?>/<?php echo $produto['nome_produto']; ?>.png')">Adicionar</button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>


        <!-- Section "sobremesas" -->
        <section class="product-section">
        <h2 id="sobremesas">sobremesas</h2>
        <div class="product-grid">
            <?php foreach ($sobremesas as $produto): ?>
                <div class="product-card">
                <img src="img/cardapio trabalho final/<?php echo $produto['nome_categoria']; ?>/<?php echo $produto['nome_produto']; ?>.png" alt="<?php echo $produto['nome_produto']; ?>">
                    <div class="product-info">
                        <h3><?php echo $produto['nome_produto']; ?></h3>
                        <p><?php echo $produto['desc_']; ?></p>
                        <div class="price-button-container">
                            <span>R$ <?php echo number_format($produto['valor_und'], 2, ',', '.'); ?></span>
                            <button onclick="addToCart('<?php echo $produto['nome_produto']; ?>', <?php echo $produto['valor_und']; ?>, 'img/cardapio trabalho final/<?php echo $produto['nome_categoria']; ?>/<?php echo $produto['nome_produto']; ?>.png')">Adicionar</button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>



    </main>

<?php 
include_once 'whats.php'; 
?>

<?php
include_once 'footer.php';
?>




































