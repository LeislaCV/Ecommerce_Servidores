<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require 'dbcon.php'; // Tu archivo de conexión

// Recibimos el identificador por GET (ej: orden.php?id=MIEMPRESA-0000001-ABC)
$identificador = isset($_GET['id']) ? trim($_GET['id']) : '';

if (empty($identificador)) {
    header("Location: index.php");
    exit();
}

// Consultar los detalles del pedido en tu tabla real 'pedidos'
$stmt = $con->prepare("SELECT * FROM pedidos WHERE identificador = ? LIMIT 1");
$stmt->bind_param("s", $identificador);
$stmt->execute();
$resultado = $stmt->get_result();
$orden = $resultado->fetch_assoc();
$stmt->close();

if (!$orden) {
    die("Pedido no encontrado.");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalles de la Compra</title>
    <link rel="stylesheet" href="css/orden.css">
</head>
<body>
    <div class="container">
        <h1>¡Gracias por tu compra!</h1>
        <p>Estado del pago: <strong><?php echo htmlspecialchars($orden['status_pago']); ?></strong></p>
        
        <div class="details-box">
            <h3>Resumen del Pedido #<?php echo htmlspecialchars($orden['identificador']); ?></h3>
            <p><strong>Fecha:</strong> <?php echo htmlspecialchars($orden['fecha'] ?? 'Reciente'); ?></p>
            <p><strong>Total Pagado:</strong> $<?php echo number_format($orden['total'], 2); ?> MXN</p>
            
            <h4>Datos de Envío / Cliente</h4>
            <p><strong>Nombre:</strong> <?php echo htmlspecialchars($orden['nombre'] . ' ' . $orden['apellidop'] . ' ' . $orden['apellidom']); ?></p>
            <p><strong>Correo:</strong> <?php echo htmlspecialchars($orden['email']); ?></p>
            <p><strong>Teléfono:</strong> <?php echo htmlspecialchars($orden['telefono']); ?></p>

            <?php if (!empty($orden['pdf_url'])): ?>
                <p><a href="<?php echo htmlspecialchars($orden['pdf_url']); ?>" target="_blank" class="btn-pdf">Descargar ficha de pago SPEI</a></p>
            <?php endif; ?>
        </div>

        <a href="tienda-en-linea.php" class="btn">Volver a la tienda</a>
    </div>
</body>
</html>