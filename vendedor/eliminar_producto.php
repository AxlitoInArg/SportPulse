<?php
include ('../sportpulse/servicios/_conexion.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM PRODUCTO WHERE codpro = $id";
    $conexion->query($sql);
}

//header("Location: vendedor.php");
?>
