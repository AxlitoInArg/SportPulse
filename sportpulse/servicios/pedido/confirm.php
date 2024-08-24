<?php
session_start();
if (!isset($_SESSION['codusu'])) {
    echo json_encode(['state' => false, 'detail' => 'Usuario no autenticado']);
    exit;
}

include('../conexion.php');  // Asegúrate de incluir la conexión a la base de datos

$dirusu = $_POST['dirusu'];
$telusu = $_POST['telusu'];
$tipopago = $_POST['tipopago'];
$idUsuario = $_SESSION['codusu'];  // Obtén el ID del usuario desde la sesión
$montoTotal = 0;  // Aquí puedes calcular el monto total si es necesario

// Calcula el monto total
$consulta_pedidos = "SELECT SUM(precio) as total FROM carrito WHERE id_usuario = ?";
$stmt_pedidos = $conexion->prepare($consulta_pedidos);
$stmt_pedidos->bind_param("i", $idUsuario);
$stmt_pedidos->execute();
$resultado_pedidos = $stmt_pedidos->get_result();
if ($fila = $resultado_pedidos->fetch_assoc()) {
    $montoTotal = $fila['total'];
}

// Aquí no puedes usar clases de JavaScript en PHP, así que elimina esa parte de código JavaScript
// En vez de eso, realiza el procesamiento del pago aquí si es necesario

// Inserta el Recibo
$consulta_recibo = "INSERT INTO Recibo (Fecha, Monto, Detalle, ID_MetodoPago, ID_Usuario) VALUES (NOW(), ?, ?, ?, ?)";
$stmt_recibo = $conexion->prepare($consulta_recibo);

$detalle = "Compra realizada en el sitio web";  // Detalle de la compra, puede personalizarse
$idMetodoPago = 1; // Ejemplo: asignar un valor al ID del método de pago
$stmt_recibo->bind_param("dsii", $montoTotal, $detalle, $idMetodoPago, $idUsuario);

if ($stmt_recibo->execute()) {
    echo json_encode(['state' => true, 'detail' => 'Compra procesada con éxito']);
} else {
    echo json_encode(['state' => false, 'detail' => 'Error al procesar la compra']);
}

$stmt_recibo->close();
$stmt_pedidos->close();
$conexion->close();
?>
