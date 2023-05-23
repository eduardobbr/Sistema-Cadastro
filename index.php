<!DOCTYPE html>
<html>
<head>
    <title>Cadastro e Venda de Veículos</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            background-color: pink
        }

        .card {
            width: 300px;
            background-color: #f5f5f5;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
        }

        .card h2 {
            margin-top: 0;
        }

        .card p {
            margin: 0;
        }

        .card a {
            display: inline-block;
            padding: 5px 10px;
            background-color: #337ab7;
            color: #fff;
            text-decoration: none;
            border-radius: 3px;
        }

        .form-container {
            width: 300px;
            background-color: #f5f5f5;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
        }

        .form-container label {
            display: block;
            margin-bottom: 5px;
        }

        .form-container input[type="text"] {
            width: 95%;
            padding: 5px;
            margin-bottom: 10px;
        }

        .form-container input[type="submit"] {
            background-color: #337ab7;
            color: #fff;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
        }
    </style>
    <script>
        // Remove a mensagem de sucesso ou venda após 3 segundos
        setTimeout(function() {
            var successMessage = document.getElementById('success-message');
            if (successMessage) {
                successMessage.style.display = 'none';
            }
        }, 3000);
    </script>
</head>
<body>
    <h1>Cadastro de Veículos</h1>
    <div class="form-container">
        <form action="" method="POST">
            <label>Pátio:</label>
            <input type="text" name="patio" required><br>
            
            <label>Modelo:</label>
            <input type="text" name="modelo" required><br>
            
            <label>Ano:</label>
            <input type="text" name="ano" required><br>
            
            <label>Preço:</label>
            <input type="text" name="preco" required><br>
            
            <input type="submit" name="cadastrar" value="Cadastrar">
        </form>
    </div>
    
    <h1>Veículos à Venda</h1>
    <?php
    // Conexão com o banco de dados (substitua as credenciais pelos seus próprios dados)
    $conexao = mysqli_connect('localhost', 'root', '', 'veiculos');
    
    // Verifica se a conexão foi estabelecida corretamente
    if (!$conexao) {
        die("Erro ao conectar ao banco de dados: " . mysqli_connect_error());
    }
    
    // Verifica se o formulário de cadastro foi submetido
    if (isset($_POST['cadastrar'])) {
        $patio = $_POST['patio'];
        $modelo = $_POST['modelo'];
        $ano = $_POST['ano'];
        $preco = $_POST['preco'];
        
        // Insere o veículo no banco de dados
        $consultaCadastro = "INSERT INTO veiculos (patio, modelo, ano, preco, vendido) VALUES ('$patio', '$modelo', '$ano', '$preco', 0)";
        if (mysqli_query($conexao, $consultaCadastro)) {
            echo "<p id='success-message'>Veículo cadastrado com sucesso!</p>";
        } else {
            echo "<p>Erro ao cadastrar o veículo: " . mysqli_error($conexao) . "</p>";
        }
    }
    
    // Verifica se o ID do veículo vendido foi fornecido via GET
    if (isset($_GET['vendido'])) {
        $idVendido = $_GET['vendido'];
        
        // Atualiza o status do veículo para vendido no banco de dados
        $consultaVenda = "UPDATE veiculos SET vendido = 1 WHERE id = $idVendido";
        if (mysqli_query($conexao, $consultaVenda)) {
            echo "<p id='success-message'>Veículo vendido com sucesso!</p>";
        } else {
            echo "<p>Erro ao vender o veículo: " . mysqli_error($conexao) . "</p>";
        }
    }
    
    // Consulta para buscar os veículos cadastrados e não vendidos
    $consulta = "SELECT * FROM veiculos WHERE vendido = 0";
    $result = mysqli_query($conexao, $consulta);
    
    // Exibe os veículos como cards
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='card'>";
        echo "<h2>{$row['modelo']}</h2>";
        echo "<p>Pátio: {$row['patio']}</p>";
        echo "<p>Ano: {$row['ano']}</p>";
        echo "<p>Preço: {$row['preco']}</p>";
        echo "<a href='?vendido={$row['id']}'>Vender</a>";
        echo "</div>";
    }
    
    // Fecha a conexão com o banco de dados
    mysqli_close($conexao);
    ?>
</body>
</html>
