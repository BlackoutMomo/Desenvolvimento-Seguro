<?php
include 'db.php';

$id = $_POST['id'];
$nome = $_POST['usuario'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];

$sql = "UPDATE usuario SET usuario='$nome', email='$email', telefone='$telefone' WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    header("Location: aula04_09.php");
} else {
    echo "Erro: " . $conn->error;
}
?>