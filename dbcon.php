<?php

$host = "localhost";
$usuario = "root";
$password = "";
$bd = "ecommerce";

$con = mysqli_connect($host, $usuario, $password, $bd);

if (!$con) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>