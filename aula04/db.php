<?php
$server = "localhost:3306";
$username = "root";
$password = "root";
$dbname = "login_db";

$conn = new mysqli($server, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

?>