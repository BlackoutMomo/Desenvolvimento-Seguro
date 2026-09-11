<?php
include 'db.php';

// Pegando os dados do formulário de login
$usuario = $_POST['usuario_login'];
$senha = $_POST['senha_login'];

// Busca no banco um registro que tenha EXATAMENTE esse usuário e essa senha
$sql = "SELECT * FROM usuario WHERE usuario = '$usuario' AND senha = '$senha'";
$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {
    header("Location: loja.php"); // Redireciona para a página da loja

} else {
    echo "Erro: Usuário ou senha incorretos!";
}

$conn->close();
?>