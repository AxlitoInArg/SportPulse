<?php
session_start();
include '../sportpulse/servicios/_conexion.php'; // Incluir la conexión a la base de datos

// Consulta para obtener todos los productos
$sql = "SELECT * FROM PRODUCTO";
$resultado = $con->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administración de Productos</title>
    <link rel="stylesheet" href="../sportpulse/css/index.css">
</head>
<body>
    <h1>Administración de Productos</h1>
    <a href="agregar_producto.php">Agregar Nuevo Producto</a>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Imagen</th>
            <th>Acciones</th>
        </tr>
        <?php while($producto = $resultado->fetch_assoc()): ?>
            <tr>
                <td><?php echo $producto['nompro']; ?></td>
                <td><?php echo $producto['despro']; ?></td>
                <td><?php echo $producto['prepro']; ?></td>
                <td><img src="imagenes/<?php echo $producto['rutimapro']; ?>" alt="<?php echo $producto['nompro']; ?>" width="50"></td>
                <td>
                    <a href="editar_producto.php?id=<?php echo $producto['codpro']; ?>">Editar</a>
                    <a href="eliminar_producto.php?id=<?php echo $producto['codpro']; ?>">Eliminar</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
