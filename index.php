<?php 
include_once 'header.php'; 
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css"> 
    <title>Bambuí Oriental</title>

    <style>

/*video*/

.inicial {
    width: 100%;
    height: 100vh;
    overflow: hidden;
}

.inicial video {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/*cards*/

.card {
    display: grid;
    justify-content: center; 
    align-items: center; 
    width: 300px;
    height: 400px;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2); 
    transition: transform 0.3s, box-shadow 0.3s;
    margin: 10px; 
    position: relative;
    background-color: transparent; /* Remove qualquer fundo branco */
    border: none;
}

.card:hover {
    transform: translateY(-5px);
   
}

.card img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s; 
}

.card:hover img {
    transform: scale(1.05); 
    object-fit: cover;
}

.cartao{
    display: flex;
    align-items: center; 
    justify-content: center;
    gap:3%;
}

.text-inicio{
    font-family: 'Adumu';
    display:flex;
    align-itens: center;
    justify-content: center;
    color: white;
    margin-top: 30px;
}


/*carrossel*/
.carousel-item img {
    margin-top: 10%;
    margin-left:15%;
    display: flex;
    align-items: center; 
    justify-content: center;
        width: 70%;
        height: auto;

        }
     


        .imagens-index {
    display: flex;
    justify-content: space-between; 
    align-items: center; /* Alinha as imagens verticalmente ao centro */
    margin-top: 20px; /* Espaço entre os cards e as imagens */
}

.imagem-index {
    width: 80px; 
    height: auto; 
}

.imagem-index.lado {
    margin-left: 10px;
    margin-top:40px
    z-index:-1000;
}

.imagem-index.cima {
    margin: 0 10px; /* Espaçamento lateral da imagem do meio */
    align-self: flex-start; /* Faz a imagem do meio ficar no topo */
}

    </style>
</head>
<body>
    
<div class="inicial">
       <video src="img/video bambui banner.mp4" autoplay loop muted></video>  
    </div>

    <div class="text-inicio">
        <h1>Conheça nosso cardápio</h1>
    </div>

  

    <div class="cartao">

    <div class="card" onclick="location.href='cardapio.php';">
    <img src="img/Group 20.png" alt="Mais Vendidos">
</div>
<div class="card" onclick="location.href='cardapio.php#acompanhamentos';">
    <img src="img/Group 19.png" alt="Acompanhamentos">
</div>
<div class="card" onclick="location.href='cardapio.php#entradas';">
    <img src="img/Group 18.png" alt="Entradas">
</div>
<div class="card" onclick="location.href='cardapio.php#bebidas';">
    <img src="img/Group 17.png" alt="Bebidas">
</div>
<div class="card" onclick="location.href='cardapio.php#sobremesas';">
    <img src="img/cardapio trabalho final/sobremesas/Group 21.png" alt="sobremesas">
</div>

    </div>

    <div id="meuCarrossel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="img/banner- início.png" alt="banner Imagem 1">
        </div>
        <div class="carousel-item">
            <img src="img/banner (1).png" alt="banner Imagem 2">
        </div>
        <div class="carousel-item">
            <img src="img/banner (2).png" alt="banner Imagem 3">
        </div>
        <div class="carousel-item">
            <img src="img/banner (3).png" alt="banner Imagem 4">
        </div>
        <div class="carousel-item">
            <img src="img/banner (4).png" alt="banner Imagem 2">
        </div>
    </div>
    <a class="carousel-control-prev" href="#meuCarrossel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Anterior</span>
    </a>
    <a class="carousel-control-next" href="#meuCarrossel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Próximo</span>
    </a>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<?php 
include_once 'whats.php'; 
?>

<?php include_once 'footer.php'; ?>