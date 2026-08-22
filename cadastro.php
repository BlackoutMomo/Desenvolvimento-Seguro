<?php
include 'db.php';
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $senha = $_POST['senha'];
    $cpf = $_POST['cpf'];
    $endereco = $_POST['endereco'];

    // Prepare the SQL statement to prevent SQL injection
    $sql = "INSERT INTO usuario (nome, email, telefone, senha, cpf, endereco) VALUES ('$nome', '$email', '$telefone', '$senha', '$cpf', '$endereco')";
    if ($conn->query($sql) === TRUE) {
        echo "Cadastro realizado com sucesso!";
            header("Location: pagina 2 IA.html");
    } else {
        echo "Erro ao cadastrar: " . $conn->error;
    }
    $conn->close();
?>