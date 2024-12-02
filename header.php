<?php
// Verifica se a sessão já foi iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once("conexao.php");

// Verifique se o usuário está logado e pegue o nome
$nomeUsuario = isset($_SESSION['nome']) ? $_SESSION['nome'] : null;
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Cabeçalho</title>

    <style>
        /* Navbar */
        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            font-family: 'Agrandir'
        }

        .logo img {
            height: 80px;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .nav-links li {
            list-style: none;
        }

        .nav-links a {
            text-decoration: none;
            color: #000000;
            font-size: 1em;
        }






        .icons {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .cart-icon img {
            width: 24px;
            height: 24px;
            cursor: pointer;
        }

        .hamburger {
            display: none;
            flex-direction: column;
            cursor: pointer;
            gap: 4px;
        }

        .hamburger span {
            display: block;
            width: 25px;
            height: 3px;
            background-color: black;
        }

        /* Responsividade */
        @media (max-width: 768px) {
            .nav-links {
                position: fixed;
                top: 0;
                right: 0;
                height: 100%;
                width: 250px;
                background-color: #fff;
                flex-direction: column;
                gap: 20px;
                justify-content: center;
                align-items: center;
                transform: translateX(100%);
                transition: transform 0.3s ease;
                box-shadow: -2px 0 5px rgba(0, 0, 0, 0.2);
                padding-top: 20px;
                text-decoration: none;
            }

            .nav-links.active {
                transform: translateX(0);
                text-decoration: none;
            }

            .hamburger {
                display: flex;
            }

            .logo img {
                height: 60px;
            }
        }

        .nav-links li button img {
            width: 24px;
            height: 24px;
            text-decoration: none;
            border: 0
        }

        
}


.nav-links li button {
    background: none; 
    border: none; 
    padding: 0; 
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
   
}

.nav-links a:hover {
    color: #a62103; 
    font-weight: bold;
    text-decoration: none; 
}

/* Aba lateral */
.sidebar {
    position: fixed;
    top: 0;
    right: -250px; /
    width: 250px;
    height: 100%;
    background-color: #f4f4f4;
    transition: right 0.3s ease-in-out;
    padding: 20px;
}

.sidebar.open {
    right: 0; /* Vai para a posição original quando a classe 'open' for adicionada */
}

/* Botão para fechar a aba lateral */
.close-btn {
    background: none;
    border: none;
    font-size: 30px;
    cursor: pointer;
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
#login{
    text-decoration: none;
    color: white;   
}


.toggle-btn{
    background-color: white;
    border:none;

}

.nav-links a.active {
    color: #a62103; /* Cor destacada */
    font-weight: bold; 
    text-decoration: none; /* Remove o sublinhado */
}


.badge {
    position: absolute;
    top: 8px; /* Ajuste conforme necessário */
    right: 8px; /* Ajuste conforme necessário */
    background-color: #ff0000;
    color: #ffffff;
    font-size: 0.8em;
    font-weight: bold;
    border-radius: 50%;
    padding: 5px 10px;
    display: flex;
    align-items: center;
    justify-content: center;
}

    </style>
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="logo">
                <a href="index.php"><img src="img/logo bambuí- fundo removido.png" alt="Logo BAMBUÍ"></a>
            </div>
            <ul class="nav-links">
                <li><a href="index.php">início</a></li>
                <li><a href="cardapio.php">cardápio</a></li>
                <li><a href="montebowl.php">monte seu bowl</a></li>
                <li><a href="sobre.php">sobre nós</a></li>
                <li><a href="reservar.php">reservar</a></li>
                <li><a href="contato.php">contato</a></li>
                <li>
    <button class="toggle-btn" onclick="toggleSidebar()">
        <img src="img/carrinho.jpeg" alt="Carrinho">
        <span class="badge" id="cart-count"><?= $quantidadeItens ?></span>
    </button>
</li>
                <li id="login-or-name">
                    <?php if ($nomeUsuario): ?>
                        <span id="user-name"><?php echo htmlspecialchars($nomeUsuario); ?></span>
                        <button class="logout-button" onclick="logout()">sair</button>
                    <?php else: ?>
                        <button class="login-button"><a href="login.php" id="login">entrar</a></button>
                    <?php endif; ?>
                </li>
            </ul>
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </nav>
    </header>


    <!-- Aba lateral -->
    <div id="sidebar" class="sidebar">
        <button class="close-btn" onclick="toggleSidebar()">×</button>
        <div id="cart">
    <h2>Carrinho</h2>
    <div id="cart-items"></div>
    <p id="cart-total">Total: R$ 0.00</p>
    <button id="finalizar-compra" onclick="finalizarCompra()">Finalizar Compra</button>
</div>

    </div>

    <script>
        const hamburger = document.querySelector(".hamburger");
        const navLinks = document.querySelector(".nav-links");

        hamburger.addEventListener("click", () => {
            navLinks.classList.toggle("active");
        });

        // Função para abrir ou fechar a aba lateral com o mesmo botão
    function toggleSidebar() {
    const sidebar = document.getElementById("sidebar");
    sidebar.classList.toggle("open"); // Alterna a classe 'open' para abrir ou fechar a aba
}

        // Lógica de logout
        function logout() {
            // Redireciona o usuário para o script de logout
            window.location.href = 'logout.php';
        }

        document.addEventListener("DOMContentLoaded", function() {
            const nomeUsuario = "<?php echo $nomeUsuario; ?>";
            const loginButton = document.querySelector('.login-button');
            const logoutButton = document.querySelector('.logout-button');
            const userNameSpan = document.getElementById('user-name');
            const loginOrNameElement = document.getElementById('login-or-name');

            if (nomeUsuario) {
                // Se o usuário estiver logado, mostra o nome e o botão de logout
                loginButton.style.display = 'none';
                logoutButton.style.display = 'inline-block';
                userNameSpan.textContent = nomeUsuario;
            } else {
                // Se não estiver logado, exibe o botão de login
                userNameSpan.textContent = '';
                loginButton.style.display = 'inline-block';
                logoutButton.style.display = 'none';
            }
        });

let cart = []; // Armazena os itens do carrinho


function addToCart(productName, price, imageSrc, productId) {
    let existingProduct = cart.find(item => item.name === productName);

    if (existingProduct) {
        existingProduct.quantity += 1;
    } else {
        cart.push({
            id: productId, // ID do produto para ser usado ao finalizar o pedido
            name: productName,
            price: price,
            quantity: 1,
            image: imageSrc
        });
    }

    displayCart();
}


// Função para exibir os itens no carrinho
function displayCart() {
    let cartContainer = document.getElementById('cart-items');
    cartContainer.innerHTML = ''; // Limpa o conteúdo anterior

    if (cart.length === 0) {
        cartContainer.innerHTML = '<p>Seu carrinho está vazio.</p>';
    }

    cart.forEach(item => {
        let cartItem = document.createElement('div');
        cartItem.classList.add('cart-item');

        // Cria o elemento da imagem do produto
        let productImage = document.createElement('img');
        productImage.src = item.image;
        productImage.alt = item.name;
        productImage.style.width = '50px';
        productImage.style.height = '50px';
        productImage.style.marginRight = '10px';

        // Cria o texto do item do carrinho
        let productDetails = document.createElement('div');
        productDetails.innerHTML = `${item.name} - ${item.quantity} x R$ ${item.price.toFixed(2)}`;

        // Adiciona a imagem e os detalhes ao item
        cartItem.appendChild(productImage);
        cartItem.appendChild(productDetails);

        // Adiciona o item ao carrinho
        cartContainer.appendChild(cartItem);
    });

    // Exibe o total do carrinho
    let total = cart.reduce((acc, item) => acc + item.price * item.quantity, 0);
    document.getElementById('cart-total').innerText = `Total: R$ ${total.toFixed(2)}`;
}

function finalizarCompra() {
    const cartItems = cart; // Assumindo que o carrinho está armazenado na variável 'cart'
    
    if (cartItems.length === 0) {
        alert('Seu carrinho está vazio!');
        return;
    }

    // Envia os itens do carrinho ao backend (via fetch)
    fetch('finalizar_compra.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            items: cartItems
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Compra finalizada com sucesso!');
            
            // Limpar o carrinho
            cart = []; // Limpa os itens do carrinho
            
            // Atualiza a exibição do carrinho
            displayCart();
            
            // Você pode redirecionar para uma página de confirmação ou algo do tipo:
            // window.location.href = "pagina_confirmacao.php";
        } else {
            alert('Houve um erro ao finalizar a compra.');
        }
    })
    .catch(error => {
        console.error('Erro:', error);
        alert('Ocorreu um erro. Tente novamente mais tarde.');
    });
}

// Marca o link do navbar de acordo com a página atual
document.addEventListener("DOMContentLoaded", function () {
    // Obtém a URL da página atual
    const currentUrl = window.location.pathname;
    
    // Seleciona todos os links do navbar
    const navLinks = document.querySelectorAll(".nav-links a");

    navLinks.forEach(link => {
        // Verifica se o link corresponde à página atual
        if (link.getAttribute("href") === currentUrl) {
            link.classList.add("active"); // Adiciona a classe 'active'
        }
    });
});
document.addEventListener("DOMContentLoaded", function () {
    // Obtém o nome do arquivo atual da URL (exemplo: "reservar.php")
    const currentPage = window.location.pathname.split("/").pop();

    // Seleciona todos os links do navbar
    const navLinks = document.querySelectorAll(".nav-links a");

    navLinks.forEach(link => {
        // Verifica se o href do link corresponde à página atual
        if (link.getAttribute("href") === currentPage) {
            link.classList.add("active"); // Adiciona a classe 'active'
        }
    });
});
    </script>



