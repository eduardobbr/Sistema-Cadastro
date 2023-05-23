<?php
// Conexão com o banco de dados (substitua as credenciais pelos seus próprios dados)
$conexao = mysqli_connect('localhost', 'root', '', 'veiculos');

// Verifica se a conexão foi estabelecida corretamente
if (!$conexao) {
    die("Erro ao conectar ao banco de dados: " . mysqli_connect_error());
}

// Verifica se o ID do veículo foi fornecido via GET
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Atualiza o veículo como vendido no banco de dados
    $consulta = "UPDATE veiculos SET vendido = 1 WHERE id = $id";
    if (mysqli_query($conexao, $consulta)) {
        echo "Veículo vendido com sucesso!";
    } else {
        echo "Erro ao vender o veículo: " . mysqli_error($conexao);
    }
}

// Fecha a conexão com o banco de dados
mysqli_close($conexao);
?>
