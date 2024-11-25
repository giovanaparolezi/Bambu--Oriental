<?php
  include_once("header.php");
  
  include_once("conexao.php");

 
  $erro_mensagem = '';

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_tamanho = $_POST['id_tamanho'];
    $ingredientes = $_POST['ingredientes']; 
    $valor_total = 0;

    $limite_sql = "SELECT limt_ing FROM tamanho WHERE id_tamanho = ?";
    $stmt = $conn->prepare($limite_sql);
    $stmt->bind_param("i", $id_tamanho);
    $stmt->execute();
    $stmt->bind_result($limite_ing);
    $stmt->fetch();
    $stmt->close();

    if (count($ingredientes) > $limite_ing) {
        $erro_mensagem = "O número de ingredientes selecionados não pode ultrapassar o limite de $limite_ing ingredientes para o tamanho selecionado.";
    } else {
        // Cálculo do valor total
        foreach ($ingredientes as $id_ingrediente) {
            $ingrediente_sql = "SELECT valor_ing FROM bowl_ing WHERE id_ing_bowl = ?";
            $stmt = $conn->prepare($ingrediente_sql);
            $stmt->bind_param("i", $id_ingrediente);
            $stmt->execute();
            $stmt->bind_result($valor_ing);
            $stmt->fetch();
            $valor_total += $valor_ing;
            $stmt->close();
        }

        // Inserir pedido na tabela de pedidos
        $data_pedido = date("Y-m-d H:i:s");
        $sql_pedido = "INSERT INTO pedido (data_pedido) VALUES (?)";
        $stmt = $conn->prepare($sql_pedido);
        $stmt->bind_param("s", $data_pedido);
        $stmt->execute();
        $id_pedido = $stmt->insert_id; // Pega o ID do pedido recém-inserido
        $stmt->close();

        // Nome do bowl
        $nome_bowl = "Bowl Personalizado";
        
        // Inserir bowl no banco
        $sql_bowl = "INSERT INTO bowl (nome_bowl, valor_bowl, id_tamanho) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql_bowl);
        $stmt->bind_param("sdi", $nome_bowl, $valor_total, $id_tamanho);
        $stmt->execute();
        $id_bowl = $stmt->insert_id; // Pega o ID do bowl recém-inserido
        $stmt->close();

        // Relacionar bowl com pedido
        $sql_itens_pedido = "INSERT INTO itens_pedido (id_pedido, id_bowl, quantidade, preco_und) VALUES (?, ?, 1, ?)";
        $stmt = $conn->prepare($sql_itens_pedido);
        $stmt->bind_param("iid", $id_pedido, $id_bowl, $valor_total);
        $stmt->execute();
        $stmt->close();

        // Inserir ingredientes no bowl
        foreach ($ingredientes as $id_ingrediente) {
            $sql_bowl_ingrediente = "INSERT INTO bowl_ingredientes (id_bowl, id_ing_bowl, valor_bowl_ing) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql_bowl_ingrediente);
            $stmt->bind_param("iii", $id_bowl, $id_ingrediente, $valor_total);
            $stmt->execute();
            $stmt->close();
        }

        // Adicionar ao carrinho e mostrar mensagem de sucesso
        echo "<script>
            addToCart('Bowl Personalizado', " . $valor_total . ", 'img/bowl.jfif', " . $id_bowl . ");
            alert('Bowl criado e adicionado ao carrinho com sucesso!');
        </script>";
    }
}


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Montar Bowl</title>
    <style>
       
        body {
            font-family: 'Agrandir';
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            background-image: url('img/monte-bowl.jpeg');
            background-size: cover;
            background-position: center;
            height: 100vh;
        }
.container h1{
    font-family: 'Adumu';
}

        
        .container {
            max-width: 800px;
            margin-top:50px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

      
        .erro-mensagem {
            color: red;
            font-weight: bold;
            margin-bottom: 15px;
            text-align: center;
        }

   
        form {
    display: flex;
    flex-direction: column;
    align-items: flex-start; /* Alinhar itens à esquerda */
}

   
        label {
            font-size: 16px;
            margin-bottom: 8px;
            color: #333;
        }

       
        select, input[type="checkbox"] {
            margin-bottom: 15px;
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 100%;
        }

        
        input[type="checkbox"] {
            width: auto;
            margin-right: 8px;
        }

        .ingrediente-label {
            font-size: 14px;
            color: #555;
        }

     
    

    
    .montar {
    border: none; 
    padding: 8px 12px; 
    font-size: 14px; 
    background-color: #ff0000; 
    color: white;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    outline: none; 
    margin-left: 0; 
    display: inline-block; 
}

.montar:hover {
    background-color: #cc0000; 
}

.montar:focus {
    outline: none; 
}
      

.form-group {
    display: flex;
    flex-wrap: wrap; 
    gap: 10px; 
}

.ingrediente-label {
    flex: 0 0 48%; 
    font-size: 14px;
    color: #555;
    margin-bottom: 8px;
}




input[type="checkbox"] {
    margin-right: 8px; 
}

        /* Responsividade */
        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }

            h1 {
                font-size: 20px;
            }

            label, input, select {
                font-size: 14px;
            }

            .montar {
                font-size: 14px;
                padding: 10px 18px;
                outline: none; 
                }

            
        }
    </style>
</head>
<body>

<?php  include_once("header.php"); ?>

    <div class="container">
        <h1>Monte seu Bowl</h1>

       
        <?php if (!empty($erro_mensagem)): ?>
            <div class="erro-mensagem"><?php echo $erro_mensagem; ?></div>
        <?php endif; ?>

        <!-- Formulário para montar o bowl -->
        <form method="POST" action="">
            <div class="form-group">
                <label for="id_tamanho">Escolha o tamanho:</label>
                <select name="id_tamanho" id="id_tamanho">
                    <?php
                    
                    $tamanhos_sql = "SELECT id_tamanho, tamanho FROM tamanho"; 
                    $tamanhos_result = $conn->query($tamanhos_sql);
                    
                    while ($row = $tamanhos_result->fetch_assoc()):
                    ?>
                        <option value="<?php echo $row['id_tamanho']; ?>"><?php echo $row['tamanho']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="ingredientes">Escolha os ingredientes:</label><br>
                <?php
               
                $ingredientes_sql = "SELECT id_ing_bowl, ingrediente, valor_ing FROM bowl_ing";
                $ingredientes_result = $conn->query($ingredientes_sql);

                while ($row = $ingredientes_result->fetch_assoc()):
                ?>
                    <label class="ingrediente-label">
                        <input type="checkbox" name="ingredientes[]" value="<?php echo $row['id_ing_bowl']; ?>">
                        <?php echo $row['ingrediente']; ?> - R$<?php echo $row['valor_ing']; ?>
                    </label><br>
                <?php endwhile; ?>
            </div>

            
            <button type="submit" class="montar">Montar Bowl</button>

          

        </form>
    </div>

</body>
</html>


<?php
  include_once("footer.php");
?>
