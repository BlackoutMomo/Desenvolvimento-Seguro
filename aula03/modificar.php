<?php
include 'db.php';
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $senha = $_POST['senha'];
    $cpf = $_POST['cpf'];
    $endereco = $_POST['endereco'];

    // Prepare the SQL statement to prevent SQL injection
    $sql = "UPDATE usuario SET nome='$nome', email='$email', telefone='$telefone', senha='$senha', endereco='$endereco' WHERE cpf='$cpf'";
    if ($conn->query($sql) === TRUE) {
        echo "Dados modificados com sucesso!";
            header("Location: pagina 2 IA.html");
    } else {
        echo "Erro ao modificar dados: " . $conn->error;
    }
    $conn->close();
?>