<?php
include '../sportpulse/servicios/_conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nompro = $_POST['nompro'];
    $despro = $_POST['despro'];
    $prepro = $_POST['prepro'];
    $estado = 1; // Producto activo

    // Insertar producto en la base de datos
    $sql = "INSERT INTO PRODUCTO (nompro, despro, prepro, estado) VALUES ('$nompro', '$despro', '$prepro', $estado)";
    $con->query($sql);

    // header("Location: vendedor.php");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../sportpulse/css/index.css">
    <title>Agregar Producto</title>
</head>
<body>
    <?php include("../sportpulse/layouts/_main-header.php");?>
    <h1>Agregar Producto</h1>
    <form action="agregar_producto.php" method="POST" enctype="multipart/form-data">
        <label>Nombre del Producto:</label>
        <input type="text" name="nompro" required id="hola"><br>
        <label>Descripción:</label>
        <textarea name="despro" required id="hola"></textarea><br>
        <label>Precio:</label>
        <input type="text" name="prepro" required id="hola"><br>
        <button type="submit">Agregar Producto</button>
    </form>
</body>
</html>
