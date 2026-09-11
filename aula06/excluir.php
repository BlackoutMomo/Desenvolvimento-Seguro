<?php
include 'db.php';

$id = $_GET['id'];

$sql = "DELETE FROM produtos WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    header("Location:loja.php");
} else {
    echo "Erro ao excluir: " . $conn->error;
}
?>