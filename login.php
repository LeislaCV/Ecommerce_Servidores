<?php
// ==========================================
// 1. LIMPIEZA DE SESIÓN (Para evitar que se quede "pegado")
// ==========================================
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Borramos cualquier variable de sesión anterior
$_SESSION = array();

// Destruimos la cookie de sesión
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
session_destroy();

// Iniciamos una sesión nueva y limpia para las alertas
session_start();

// ==========================================
// 2. MOSTRAR ALERTA DE ERROR SI VIENE DE validad.php
// ==========================================
if (isset($_SESSION['alert'])) {
    $alert = $_SESSION['alert'];
    $title = isset($alert['title']) ? json_encode($alert['title']) : '"Error"';
    $message = isset($alert['message']) ? json_encode($alert['message']) : '""';
    $icon = isset($alert['icon']) ? json_encode($alert['icon']) : '"error"';
    
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: $title,
                text: $message,
                icon: $icon,
                confirmButtonText: 'Entendido'
            });
        });
    </script>";
    
    // Borramos la alerta para que no se muestre de nuevo si recargan la página
    unset($_SESSION['alert']);
}
?>
<link rel="stylesheet" href="css/login.css">
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Ecommerce 🌸</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&display=swap" rel="stylesheet">
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>

    <div class="login-card">
        <h2>¡Hola de nuevo! 🌸</h2>
        <p class="subtitle">Inicia sesión para continuar</p>

        <form action="validar.php" method="POST">
            <div class="input-group">
                <label for="username">Usuario</label>
                <input type="text" id="username" name="username" placeholder="Tu usuario o correo" required autocomplete="username">
            </div>

            <div class="input-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" placeholder="••••••••" required autocomplete="current-password">
            </div>

            <button type="submit" class="btn-login">Ingresar ✨</button>
        </form>

        <p class="footer-note">Sistema de Gestión Ecommerce 💖</p>
    </div>

</body>
</html>