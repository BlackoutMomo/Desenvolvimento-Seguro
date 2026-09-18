<?php
include 'db.php';

$usuario = $_POST['usuarioNovo'];
$senha = $_POST['senhaNovo'];
$sql = "INSERT INTO usuario (usuario, senha) VALUES ('$usuario', '$senha')";

if ($conn->query($sql) === TRUE) {
    echo "Cadastro realizado com sucesso!";
    echo "<script>location.href = 'loja.php';</script>"; // Redireciona para a página de cadastro após o sucesso
} else {
    echo "Erro ao cadastrar: " . $conn->error;
}

$conn->close();
?>