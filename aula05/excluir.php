<?php
include 'db.php';

$id = $_GET['id'];

$sql = "DELETE FROM usuario WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    header("Location: aula04_09.php");
} else {
    echo "Erro ao excluir: " . $conn->error;
}
?>