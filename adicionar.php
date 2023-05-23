<?php
// Conexão com o banco de dados (substitua as credenciais pelos seus próprios dados)
$conexao = mysqli_connect('localhost', 'root', '', 'veiculos');

// Verifica se a conexão foi estabelecida corretamente
if (!$conexao) {
    die("Erro ao conectar ao banco de dados: " . mysqli_connect_error());
}

// Recebe os dados do formulário
$patio = $_POST['patio'];
$modelo = $_POST['modelo'];
$ano = $_POST['ano'];
$preco = $_POST['preco'];

// Insere os dados na tabela de veículos
$consulta = "INSERT INTO veiculos (patio, modelo, ano, preco) VALUES ('$patio', '$modelo', '$ano', '$preco')";
if (mysqli_query($conexao, $consulta)) {
    echo "Veículo cadastrado com sucesso!";
} else {
    echo "Erro ao cadastrar o veículo: " . mysqli_error($conexao);
}

// Fecha a conexão com o banco de dados
mysqli_close($conexao);
?>
