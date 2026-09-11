<?php
include 'db.php';

$id = $_POST['id'];
$produto = $_POST['produto'];
$preco = $_POST['preco'];
$descricao = $_POST['descricao'];

$sql = "UPDATE produto SET nome='$produto', preco='$preco', descricao='$descricao' WHERE id=$id";
if ($conn->query($sql) === TRUE) {
    header("Location: loja.php");
} else {
    echo "Erro: " . $conn->error;
}
?>