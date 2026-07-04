<?php

$host = "localhost";
$usuario = "root";
$password = "";
$bd = "ecommerce";

$conn = new mysqli($host, $usuario, $password, $bd);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

echo "Conexión exitosa";
?>