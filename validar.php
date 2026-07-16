<?php
session_start();
require 'dbcon.php';

$username = mysqli_real_escape_string($con, $_POST['username']);
$password = $_POST['password'];

$query = "SELECT * FROM usuarios WHERE username='$username' LIMIT 1";
$query_run = mysqli_query($con, $query);

if (mysqli_num_rows($query_run) > 0) {

    $usuario = mysqli_fetch_assoc($query_run);

    if (password_verify($password, $usuario['password'])) {

        $_SESSION['username'] = $usuario['username'];
        $_SESSION['rol'] = $usuario['rol'];

        header("Location: usuarios.php");
        exit();

    } else {

        $_SESSION['alert'] = [
            'title' => 'ERROR',
            'message' => 'Contraseña incorrecta',
            'icon' => 'error'
        ];

        header("Location: login.php");
        exit();
    }

} else {

    $_SESSION['alert'] = [
        'title' => 'ERROR',
        'message' => 'Usuario no encontrado',
        'icon' => 'error'
    ];

    header("Location: login.php");
    exit();
}