
<?php
include_once 'header.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>FAQ e Depoimentos - Bambuí Oriental</title>

    <style>
    /* Estilos Gerais */
    body {
        background-color: black;
        color: white;
        font-family: 'Agrandir';
    }

    h1, .testimonials-section h2 {
        color: white;
        font-family: 'Adumu';
        font-size: 38px;
        font-weight: 300;
        text-align: center;
        letter-spacing: 2px;
        line-height: 1.5;
        margin-bottom: 20px;
    }

    /* Estilos para a seção de FAQ */
    .faq-section {
        width: 100%;
        padding: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    details {
        width: 75%;
        max-width: 700px;
        padding: 30px;
        margin: 10px 0;
        background-color: #1a1a1a;
        border: 1px solid #a62103;
        border-radius: 15px;
        box-shadow: 2px 2px 15px rgba(0, 0, 0, 0.5);
        transition: all 0.3s ease;
        overflow: hidden;
    }

    details summary {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 22px;
        font-weight: 500;
        cursor: pointer;
        color: #fff;
        position: relative;
    }

    details[open] {
        background-color: #f6f7f8;
    }

    details[open] summary {
        color: #a62103;
    }

    details p {
        margin: 15px 0 0;
        color: #666;
        font-weight: 300;
        line-height: 1.6;
    }

    /* Ícones do FAQ */
    .control-icon {
        fill: #a62103;
        transition: 0.3s ease;
        pointer-events: none;
    }

    .control-icon-close {
        display: none;
    }

    details[open] .control-icon-close {
        display: inline;
        transition: 0.3s ease;
    }

    details[open] .control-icon-expand {
        display: none;
    }

     /* Estilo da seção de Informações recomendadas */
     .recommended-info-section {
        text-align: center;
        padding: 40px 10px;
    }

    .recommended-info-section h1 {
        color: white;
        font-family: 'Adumu', sans-serif;
        font-size: 38px;
        font-weight: 300;
        text-align: center;
        letter-spacing: 2px;
        margin-bottom: 40px;
    }

    /* Estilo dos Cards de Informação */
    .info-cards {
        display: flex;
        justify-content: space-between;
        gap: 30px;
        flex-wrap: wrap;
        padding: 0 10px;
    }

    .info-card {
        background-color: #111;
        color: white;
        border-radius: 10px;
        overflow: hidden;
        width: 23%;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        transition: transform 0.3s ease;
        position: relative;
    }

    .info-card:hover {
        transform: scale(1.05);
    }

    .info-img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .info-text {
        padding: 20px;
    }

    .info-text h3 {
        font-size: 18px;
        font-weight: 500;
        margin-bottom: 15px;
    }

    .info-link {
        display: inline-block;
        color: #a62103;
        font-weight: bold;
        font-size: 16px;
        text-transform: uppercase;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .info-link:hover {
        color: white;
    }

    /* Estilos da Seção de Depoimentos */
    .testimonials-section {
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 40px 20px;
        background-color: #111;
    }

    .testimonial-card {
        display: flex;
        align-items: center;
        background-color: white;
        color: black;
        padding: 20px;
        margin: 15px 0;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        transition: transform 0.3s ease;
        max-width: 800px;
        width: 90%;
    }

    .testimonial-card:hover {
        transform: scale(1.02);
    }

    .testimonial-card img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    margin-right: 20px;
    object-fit: cover; /* Garante que a imagem se ajuste ao contêiner sem distorção */
}

    .testimonial-text {
        flex: 1;
    }

    .testimonial-text p {
        margin: 0;
        font-size: 16px;
        line-height: 1.6;
    }

    .stars {
        margin-top: 10px;
        color: #FFD700; /* Cor dourada para as estrelas */
        font-size: 20px;
    }


/* parallax */
.parallax-only {
    height: 500px; 
    background-image: url('img/sobre.png'); 
    background-size: cover; 
    background-position: center; 
    background-attachment: fixed; 
    background-repeat: no-repeat; 
}

/* parallax 2 */
.parallax-only1 {
    height: 500px; 
    background-image: url('img/food.jpg'); 
    background-size: cover; 
    background-position: center; 
    background-attachment: fixed; 
    background-repeat: no-repeat; 
}

    </style>
</head>
<body>

<img src="img/fachada.png" alt="" class="fachada">



<section class="parallax-only"></section>

<!-- Seção FAQ -->
<section class="faq-section">
    <h1>Perguntas Frequentes</h1>

    <details open>
        <summary>
            Quais são os pratos mais populares do restaurante?
            <svg class="control-icon control-icon-expand" width="24" height="24" role="presentation">
                <use xlink:href="#expand-more"/>
            </svg>
            <svg class="control-icon control-icon-close" width="24" height="24" role="presentation">
                <use xlink:href="#close"/>
            </svg>
        </summary>
        <p>Nossos pratos mais populares incluem sushi, sashimi, ramen e tempurá. Estes pratos são muito apreciados pelos nossos clientes devido ao sabor autêntico e ingredientes frescos.</p>
    </details>

    <details>
        <summary>
            Vocês oferecem opções vegetarianas ou veganas?
            <svg class="control-icon control-icon-expand" width="24" height="24" role="presentation">
                <use xlink:href="#expand-more"/>
            </svg>
            <svg class="control-icon control-icon-close" width="24" height="24" role="presentation">
                <use xlink:href="#close"/>
            </svg>
        </summary>
        <p>Sim! Temos várias opções vegetarianas e veganas, como sushi de vegetais, tofu grelhado e ramen vegetariano.</p>
    </details>

    <details>
        <summary>
            O restaurante trabalha com pedidos para viagem ou entrega?
            <svg class="control-icon control-icon-expand" width="24" height="24" role="presentation">
                <use xlink:href="#expand-more"/>
            </svg>
            <svg class="control-icon control-icon-close" width="24" height="24" role="presentation">
                <use xlink:href="#close"/>
            </svg>
        </summary>
        <p>Sim, oferecemos tanto pedidos para viagem quanto entrega para sua comodidade.</p>
    </details>

    <details>
        <summary>
            Vocês têm promoções ou descontos especiais?
            <svg class="control-icon control-icon-expand" width="24" height="24" role="presentation">
                <use xlink:href="#expand-more"/>
            </svg>
            <svg class="control-icon control-icon-close" width="24" height="24" role="presentation">
                <use xlink:href="#close"/>
            </svg>
        </summary>
        <p>Sim, oferecemos promoções em dias específicos da semana e combos com desconto. Fique atento ao nosso site e redes sociais para mais detalhes.</p>
    </details>

    <details>
        <summary>
            Como é feita a preparação dos pratos?
            <svg class="control-icon control-icon-expand" width="24" height="24" role="presentation">
                <use xlink:href="#expand-more"/>
            </svg>
            <svg class="control-icon control-icon-close" width="24" height="24" role="presentation">
                <use xlink:href="#close"/>
            </svg>
        </summary>
        <p>Todos os pratos são preparados com ingredientes frescos e autênticos, seguindo técnicas tradicionais da culinária oriental. Valorizamos a qualidade e o sabor em cada prato.</p>
    </details>
</section>



<!-- blog -->
<section class="recommended-info-section">
    <h1>Informações recomendadas por nós</h1>
    <div class="info-cards">
        <div class="info-card">
            <img src="img/img-blog1.jpg" alt="Sushi" class="info-img">
            <div class="info-text">
                <h3>Culinária Japonesa para Iniciantes: um guia prático e delicioso</h3>
                <a href="https://ohtasushi.com.br/2023/04/18/culinaria-japonesa-para-iniciantes-um-guia-pratico-e-delicioso/" class="info-link">LEIA MAIS</a>
            </div>
        </div>
        <div class="info-card">
            <img src="img/img-blog2.jpg" alt="Ramen" class="info-img">
            <div class="info-text">
                <h3>Jeito Certo de Como Usar Hashi: Tutorial Prático</h3>
                <a href="https://ohtasushi.com.br/2022/10/25/como-usar-hashi-tutorial/#:~:text=Dicas%20para%20o%20uso,contamina%C3%A7%C3%A3o%20por%20germes%20e%20bact%C3%A9rias." class="info-link">LEIA MAIS</a>
            </div>
        </div>
        <div class="info-card">
            <img src="img/img-blog3.jpg" alt="Sashimi" class="info-img">
            <div class="info-text">
                <h3>Quais são os benefícios do peixe cru?</h3>
                <a href="https://ohtasushi.com.br/2022/07/29/quais-sao-os-beneficios-do-peixe-cru/" class="info-link">LEIA MAIS</a>
            </div>
        </div>
        <div class="info-card">
            <img src="img/img-blog4.png" alt="Missoshiru" class="info-img">
            <div class="info-text">
                <h3>Conheça o Missoshiru: A Sopa Japonesa que tem um Sabor e Equilíbrio</h3>
                <a href="https://ohtasushi.com.br/2021/11/11/conheca-o-missoshiro-a-sopa-japonesa-que-une-sabor-equilibrio-fisico-e-espiritual/#:~:text=O%20missoshiro%20%C3%A9%20considerado%20um,sem%20abrir%20m%C3%A3o%20do%20sabor." class="info-link">LEIA MAIS</a>
            </div>
        </div>
    </div>
</section>

<section class="parallax-only1"></section>

<!-- Seção de Depoimentos -->
<section class="testimonials-section">
    <h2>Confira a opinião de nossos clientes</h2>

    <div class="testimonial-card">
        <img src="img/depoimentos (1).jpeg" alt="Foto de um cliente satisfeito">
        <div class="testimonial-text">
            <p>""Simplesmente maravilhoso! Os sabores são autênticos, e a apresentação dos pratos é impecável. Ambiente acolhedor e atendimento impecável, perfeito para quem ama comida oriental de qualidade! Cada visita é uma experiência incrível!""</p>
            <div class="stars">★★★★★</div>
        </div>
    </div>

    <div class="testimonial-card">
        <img src="img/depoimentos (2).jpeg" alt="Foto de outro cliente satisfeito">
        <div class="testimonial-text">
            <p>""O site do restaurante é super prático e fácil de navegar! As fotos dos pratos são lindas, e ficou fácil decidir o que pedir. Adorei o sistema de montagem do meu próprio prato. Super recomendado!""</p>
            <div class="stars">★★★★★</div>
        </div>
    </div>
</section>

</body>
</html>

<?php
include("whats.php");
?>

<?php
include_once 'footer.php';
?>

