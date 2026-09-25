<?php
include 'db.php';

// Pegando os dados com os mesmos "names" que estão no formulário HTML
$nome = $_POST['Nome'];
$ISBN = $_POST['ISBN'];
$Categoria = $_POST['Categoria'];
$valor = $_POST['Valor'];
$quantidade = $_POST['Quantidade'];
$Genero = $_POST['Genero'];
$Editora = $_POST['Editora'];
$Escritores = $_POST['Escritores'];
$Resumo = $_POST['Resumo'];
// Inserindo direto no banco, sem criptografia (Apenas para teste)
$sql = "INSERT INTO livros (nome, isbn, categoria, valor, quantidade, genero, editora, escritores, resumo) VALUES ('$nome', '$ISBN', '$Categoria', '$valor', '$quantidade', '$Genero', '$Editora', '$Escritores', '$Resumo')";
if ($conn->query($sql) === TRUE) {
    echo "Cadastro realizado com sucesso!";
    header("Location: loja.php"); // Redireciona para a página de cadastro após o sucesso
    exit();
} else {
    echo "Erro ao cadastrar: " . $conn->error;
}

$conn->close();
?>