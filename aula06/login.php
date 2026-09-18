<?php
include 'db.php';

$usuario = $_POST['usuario_login'];
$senha = $_POST['senha_login'];

// DICA DE SEGURANÇA: Considere usar Prepared Statements no futuro para evitar SQL Injection
$sql = "SELECT * FROM usuario WHERE usuario = '$usuario' AND senha = '$senha'";
$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {
    header("Location: loja.php");
    exit();
} else {
    // Redireciona de volta para o formulário informando o erro
    header("Location: index.html?erro=1");
    exit();
}

$conn->close();
?>