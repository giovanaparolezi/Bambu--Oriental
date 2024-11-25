<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página com Footer</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="fonts/Agrandir-Narrow.otf" rel="stylesheet">
    <style>
        
        body, html {
            font-family: 'Agrandir';
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background-color: black;
        }

       
        .spacer {
            height: 20vh; 
        }

        .footer {
            background-color: white; 
            color: black;
            padding: 20px 0;
            font-size: 0.9em;
            border-top: 1px solid #444;
            text-align: center;
            width: 100%;
        }

        .footer p {
            margin: 5px 0;
            color: #333;
        }

        .footer .social-icons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 10px;
        }

        .footer .social-icons a img {
            width: 30px;
            height: 30px;
            transition: transform 0.3s ease, opacity 0.3s ease;
        }

        .footer .social-icons a img:hover {
            transform: scale(1.2);
            opacity: 0.8;
        }

        .footer .coded-logo img {
            width: 120px;
            margin-top: 15px;
            transition: opacity 0.3s ease;
        }

        .footer .coded-logo img:hover {
            opacity: 0.8;
        }

        /* Responsividade para o footer */
        @media (max-width: 768px) {
            .footer {
                font-size: 0.8em;
                padding: 15px;
            }
        }
    </style>
</head>
<body>
   
    <div class="spacer"></div>

  
    <div class="footer">
        <p>Bambuí Oriental</p>
        <p>Rua Nhonhô Livramento, 1220 - Centro</p>
        <p>3242-2116 | (12) 3456-7890</p>
        
        <p>Nos siga nas Redes Sociais</p>
        <div class="social-icons">
            <a href="https://wa.me/1234567890" target="_blank" rel="noopener noreferrer" class="mx-2">
                <img src="https://cdn-icons-png.flaticon.com/512/1384/1384023.png" alt="WhatsApp" class="img-fluid">
            </a>
            <a href="https://www.facebook.com/sua_pagina" target="_blank" rel="noopener noreferrer" class="mx-2">
                <img src="https://img.icons8.com/ios11/512/facebook-new.png" alt="Facebook" class="img-fluid">
            </a>
            <a href="https://www.instagram.com/bambui_oriental/" target="_blank" rel="noopener noreferrer" class="mx-2">
                <img src="https://cdn-icons-png.flaticon.com/512/717/717392.png" alt="Instagram" class="img-fluid">
            </a>
        </div>
        
        <div class="coded-logo">
            <img src="img/logo coded.png" alt="Coded Creations">
        </div>
    </div>
</body>
</html>
