<?php
include 'db.php';
    $cpf = $_POST['cpf'];

    // Prepare the SQL statement to prevent SQL injection
    $sql = "DELETE FROM usuario WHERE cpf = '$cpf'";
    if ($conn->query($sql) === TRUE) {
        echo "Dados apagados com sucesso!";
            header("Location: pagina 2 IA.html");
    } else {
        echo "Erro ao apagar: " . $conn->error;
    }
    $conn->close(); 
?>