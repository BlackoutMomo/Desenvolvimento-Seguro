<?php
include 'db.php';

// Pegando os dados com os mesmos "names" que estão no formulário HTML
$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

// Inserindo direto no banco, sem criptografia (Apenas para teste)
$sql = "INSERT INTO usuario (usuario, senha) VALUES ('$usuario', '$senha')";

if ($conn->query($sql) === TRUE) {
    echo "Cadastro realizado com sucesso!";
} else {
    echo "Erro ao cadastrar: " . $conn->error;
}

$conn->close();
?>