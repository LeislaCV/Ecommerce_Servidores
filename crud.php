  <?php
require_once("dbcon.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD USUARIOS</title>
</head>
<body>

<h2>CRUD USUARIOS</h2>

<hr>

<h3>Agregar Usuario</h3>

<form method="POST">

Nombre:<br>
<input type="text" name="nombre" required><br><br>

Apellido Paterno:<br>
<input type="text" name="apellidopaterno" required><br><br>

Apellido Materno:<br>
<input type="text" name="apellidomaterno" required><br><br>

Username:<br>
<input type="text" name="username" required><br><br>

Password:<br>
<input type="text" name="password" required><br><br>

Rol:<br>
<input type="text" name="rol" required><br><br>

Estatus:<br>
<input type="text" name="estatus" required><br><br>

Medio:<br>
<input type="text" name="medio" required><br><br>

<button type="submit" name="guardar">Guardar</button>

</form>

<?php

if (isset($_POST['guardar'])) {

    $sql = "INSERT INTO usuarios
    (nombre, apellidopaterno, apellidomaterno, username, password, rol, estatus, medio)
    VALUES (
        '{$_POST['nombre']}',
        '{$_POST['apellidopaterno']}',
        '{$_POST['apellidomaterno']}',
        '{$_POST['username']}',
        '{$_POST['password']}',
        '{$_POST['rol']}',
        '{$_POST['estatus']}',
        '{$_POST['medio']}'
    )";

    $conn->query($sql);

    echo "Usuario agregado";
}
?>

<hr>

<h3>Lista de Usuarios</h3>

<table border="1">

<tr>
    <th>ID</th>
    <th>Nombre</th>
    <th>Apellido Paterno</th>
    <th>Apellido Materno</th>
    <th>Username</th>
    <th>Password</th>
    <th>Rol</th>
    <th>Estatus</th>
    <th>Medio</th>
    <th>Acciones</th>
</tr>

<?php

$sql = "SELECT * FROM usuarios";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {

?>

<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['nombre']; ?></td>
    <td><?php echo $row['apellidopaterno']; ?></td>
    <td><?php echo $row['apellidomaterno']; ?></td>
    <td><?php echo $row['username']; ?></td>
    <td><?php echo $row['password']; ?></td>
    <td><?php echo $row['rol']; ?></td>
    <td><?php echo $row['estatus']; ?></td>
    <td><?php echo $row['medio']; ?></td>

    <td>
        <a href="crud.php?editar=<?php echo $row['id']; ?>">Editar</a>
        <a href="crud.php?eliminar=<?php echo $row['id']; ?>">Eliminar</a>
    </td>
</tr>

<?php } ?>

</table>

<?php

if (isset($_GET['eliminar'])) {

    $id = $_GET['eliminar'];

    $conn->query("DELETE FROM usuarios WHERE id=$id");

    header("Location: crud.php");
}

if (isset($_GET['editar'])) {

    $id = $_GET['editar'];

    $sql = "SELECT * FROM usuarios WHERE id=$id";
    $result = $conn->query($sql);
    $u = $result->fetch_assoc();
}

if (isset($_POST['actualizar'])) {

    $id = $_POST['id'];

    $sql = "UPDATE usuarios SET
    nombre='{$_POST['nombre']}',
    apellidopaterno='{$_POST['apellidopaterno']}',
    apellidomaterno='{$_POST['apellidomaterno']}',
    username='{$_POST['username']}',
    password='{$_POST['password']}',
    rol='{$_POST['rol']}',
    estatus='{$_POST['estatus']}',
    medio='{$_POST['medio']}'
    WHERE id=$id";

    $conn->query($sql);

    header("Location: crud.php");
}
?>

<?php if (isset($_GET['editar'])) { ?>

<hr>

<h3>Editar Usuario</h3>

<form method="POST">

<input type="hidden" name="id" value="<?php echo $u['id']; ?>">

Nombre:<br>
<input type="text" name="nombre" value="<?php echo $u['nombre']; ?>"><br><br>

Apellido Paterno:<br>
<input type="text" name="apellidopaterno" value="<?php echo $u['apellidopaterno']; ?>"><br><br>

Apellido Materno:<br>
<input type="text" name="apellidomaterno" value="<?php echo $u['apellidomaterno']; ?>"><br><br>

Username:<br>
<input type="text" name="username" value="<?php echo $u['username']; ?>"><br><br>

Password:<br>
<input type="text" name="password" value="<?php echo $u['password']; ?>"><br><br>

Rol:<br>
<input type="text" name="rol" value="<?php echo $u['rol']; ?>"><br><br>

Estatus:<br>
<input type="text" name="estatus" value="<?php echo $u['estatus']; ?>"><br><br>

Medio:<br>
<input type="text" name="medio" value="<?php echo $u['medio']; ?>"><br><br>

<button type="submit" name="actualizar">Actualizar</button>

</form>

<?php } ?>
<a href="logout.php">Cerrar sesión</a>
</body>
</html>