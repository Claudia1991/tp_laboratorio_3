<?php
/**Funciones de filtrado: se deben realizar la funciones que reciban datos por parámetros y puedan ejecutar la consulta para responder a los siguientes requerimientos

A. Obtener los detalles completos de todos los usuarios y poder ordenarlos
alfabéticamente de forma ascendente o descendente.

B. Obtener los detalles completos de todos los productos y poder ordenarlos
alfabéticamente de forma ascendente y descendente.

C. Obtener todas las compras filtradas entre dos cantidades.

D. Obtener la cantidad total de todos los productos vendidos entre dos fechas.

E. Mostrar los primeros “N” números de productos que se han enviado.

F. Mostrar los nombres del usuario y los nombres de los productos de cada venta.

G. Indicar el monto (cantidad * precio) por cada una de las ventas.

H. Obtener la cantidad total de un producto (ejemplo:1003) vendido por un usuario
(ejemplo: 104).

I. Obtener todos los números de los productos vendidos por algún usuario filtrado por
localidad (ejemplo: ‘Avellaneda’).

J. Obtener los datos completos de los usuarios filtrando por letras en su nombre o
apellido.

K. Mostrar las ventas entre dos fechas del año. */


require_once './Servicios/Reportes.php';

$tipoReporte = $_GET["tipoReporte"];

if (isset($tipoReporte)) {
    switch ($tipoReporte) {
        case 'A':
            $ordenUsuarios = $_GET["ordenUsuarios"];
            if(isset($ordenUsuarios)){
                echo json_encode(Reportes::ObtenerUsuariosOrdenados($ordenUsuarios));
            }else{
                echo 'Error en los parametros ingresados.';
            }
            break;
        case 'B':
            $ordenProductos = $_GET["ordenProductos"];
            if(isset($ordenProductos)){
                echo json_encode(Reportes::ObtenerProductosOrdenados($ordenProductos));
            }else{
                echo 'Error en los parametros ingresados.';
            }
            break;
        case 'C':
            $cantidadMinima = $_GET["cantidadMinima"];
            $cantidadMaxima = $_GET["cantidadMaxima"];
            if(isset($cantidadMinima) && isset($cantidadMaxima)){
                echo json_encode(Reportes::ObtenerVentasEntreCantidades($cantidadMinima, $cantidadMaxima));
            }else{
                echo 'Error en los parametros ingresados.';
            }
            break;
        case 'D':
            $fechaMinima = $_GET["fechaMinima"];
            $fechaMaxima = $_GET["fechaMaxima"];
            if(isset($fechaMinima) && isset($fechaMaxima)){
                echo json_encode(Reportes::ObtenerVentasEntreFechas($fechaMinima, $fechaMaxima));
            }else{
                echo 'Error en los parametros ingresados.';
            }
            break;
        case 'E':
            $cantidadProductos = $_GET["cantidadProductos"];
            if(isset($cantidadProductos)){
                echo json_encode(Reportes::ObtenerProductosVendidos($cantidadProductos));
            }else{
                echo 'Error en los parametros ingresados.';
            }
            break;
        case 'F':
            echo json_encode(Reportes::ObtenerUsuarioProductoPorVenta());
            break;
        case 'G':
            echo json_encode(Reportes::ObtenerMontoTotalPorVenta());
            break;
        case 'H':
            $idUsuario = $_GET["idUsuario"];
            $idProducto = $_GET["idProducto"];
            if(isset($idUsuario) && isset($idProducto)){
                echo json_encode(Reportes::ObtenerCantidadTotalVendidaPorUsuario($idUsuario, $idProducto));
            }else{
                echo 'Error en los parametros ingresados.';
            }
            break;
        case 'I':
            $localidad = $_GET["localidad"];
            if(isset($localidad)){
                echo json_encode(Reportes::ObtenerProductosVendidosPorLocalidad($localidad));
            }else{
                echo 'Error en los parametros ingresados.';
            }
            break;
        case 'J':
            $nombre = $_GET["nombre"];
            $apellido = $_GET["apellido"];
            if(isset($nombre) && isset($apellido)){
                echo json_encode(Reportes::ObtenerUsuariosSegunNombreApellido($nombre, $apellido));
            }else{
                echo 'Error en los parametros ingresados.';
            }
            break;
        case 'K':
            $fechaInicial = $_GET["fechaInicial"];
            $fechaFinal= $_GET["fechaFinal"];
            if(isset($fechaInicial) && isset($fechaFinal)){
                echo json_encode(Reportes::ObtenerVentasEntreFechas($fechaInicial, $fechaFinal));
            }else{
                echo 'Error en los parametros ingresados.';
            }
            break;

        default:
            echo 'Error tipo de reporte deseado.';
            break;
    }
} else {
    echo 'Error en los datos ingresados.';
}

?>