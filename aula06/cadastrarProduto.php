<?php
include 'db.php';

// Pegando os dados com os mesmos "names" que estão no formulário HTML
$produto = $_POST['produto'];
$descricao = $_POST['descricao'];
$preco = $_POST['preco'];
// Inserindo direto no banco, sem criptografia (Apenas para teste)
$sql = "INSERT INTO produtos (produto, descricao, preco) VALUES ('$produto', '$descricao', '$preco')";

if ($conn->query($sql) === TRUE) {
    echo "Cadastro realizado com sucesso!";
    header("Location: loja.php"); // Redireciona para a página de cadastro após o sucesso
    exit();
} else {
    echo "Erro ao cadastrar: " . $conn->error;
}

$conn->close();
?>