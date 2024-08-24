<?php
include ('../sportpulse/servicios/_conexion.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM PRODUCTO WHERE codpro = $id";
    $resultado = $conexion->query($sql);
    $producto = $resultado->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nompro = $_POST['nompro'];
    $despro = $_POST['despro'];
    $prepro = $_POST['prepro'];
    
    // Verifica si se subió una nueva imagen
    if ($_FILES['imagen']['name']) {
        $imagen = $_FILES['imagen']['name'];
        move_uploaded_file($_FILES['imagen']['tmp_name'], "imagenes/".$imagen);
        $sql = "UPDATE PRODUCTO SET nompro='$nompro', despro='$despro', prepro='$prepro', rutimapro='$imagen' WHERE codpro = $id";
    } else {
        $sql = "UPDATE PRODUCTO SET nompro='$nompro', despro='$despro', prepro='$prepro' WHERE codpro = $id";
    }
    
    $conexion->query($sql);
    header("Location: vendedor.php");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../sportpulse/css/index.css">
    <title>Editar Producto</title>
</head>
<body>
<?php include("../sportpulse/layouts/_main-header.php");?>
    <h1>Editar Producto</h1>
    <form action="editar_producto.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" id="hola" value="<?php echo $producto['codpro']; ?>">
        <label>Nombre del Producto:</label>
        <input type="text" name="nompro" id="hola" value="<?php echo $producto['nompro']; ?>" required><br>
        <label>Descripción:</label>
        <textarea name="despro" required><?php echo $producto['despro']; ?></textarea><br>
        <label>Precio:</label>
        <input type="text" name="prepro"  id="hola" value="<?php echo $producto['prepro']; ?>" required><br>

        <button type="submit">Guardar Cambios</button>
    </form>
</body>
</html>