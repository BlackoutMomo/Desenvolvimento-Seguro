<?php
include 'db.php';

$nome = $_POST['Nome'];
$ISBN = $_POST['ISBN'];
$Categoria = $_POST['Categoria'];
$valor = $_POST['Valor'];
$quantidade = $_POST['Quantidade'];
$Genero = $_POST['Genero'];
$Editora = $_POST['Editora'];
$Escritores = $_POST['Escritores'];
$Resumo = $_POST['Resumo'];
$id = $_POST['id']; 
$sql = "UPDATE livros SET Nome='$nome', ISBN='$ISBN', Categoria='$Categoria', Valor='$valor', Quantidade='$quantidade', Genero='$Genero', Editora='$Editora', Escritores='$Escritores', Resumo='$Resumo' WHERE id=$id"; 
if ($conn->query($sql) === TRUE) {
    header("Location: loja.php");
} else {
    echo "Erro: " . $conn->error;
}
?>