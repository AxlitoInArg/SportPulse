<?php
session_start();

function obtenerUltimoSegmentoDeRuta($url)
{
    $urlObjeto = parse_url($url);
    $ruta = $urlObjeto['path'];
    $segmentos = explode('/', trim($ruta, '/'));
    return end($segmentos);
}

$urlEjemplo = $_SERVER['REQUEST_URI'];
$ultimoSegmento = obtenerUltimoSegmentoDeRuta($urlEjemplo);

if ($ultimoSegmento == "index.php" || $ultimoSegmento == "") {
    $ultimoSegmento = "";
}

switch ($ultimoSegmento) {
    case '':
        if (!isset($_SESSION['logged_in'])) {
            header("Location: index.php");
            exit(); // Detener el script después de la redirección
        } else {
            // Redireccionar según el rol del usuario
            switch ($_SESSION["rol"]) {
                case "vendedor":
                    header("Location: vendedor/vista_vendedor.php");
                    exit(); // Detener el script después de la redirección
                case "comprador":
                    header("Location:prueba_ecomerce/index.php");
                    exit(); // Detener el script después de la redirección
                default:
                    echo "Rol no válido";
                    exit(); // Detener el script después del mensaje de error
            }
        }
        break; // Cerrar el case '' dentro del switch
    default:
        echo "URL no válida";
        exit(); // Detener el script si no se encuentra una URL válida
}
?>
