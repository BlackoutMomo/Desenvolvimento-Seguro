<?php
include 'db.php';

// Pegando os dados do formulário de login
$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

// Busca no banco um registro que tenha EXATAMENTE esse usuário e essa senha
$sql = "SELECT * FROM usuario WHERE usuario = '$usuario' AND senha = '$senha'";
$resultado = $conn->query($sql);

// Se retornar pelo menos 1 linha, significa que achou no banco
if ($resultado->num_rows > 0) {
    header("Location: home.html"); // Redireciona para a página do painel
    // Aqui você pode redirecionar para a página principal usando:
    // header("Location: painel.php");
} else {
    echo "Erro: Usuário ou senha incorretos!";
}

$conn->close();
?>