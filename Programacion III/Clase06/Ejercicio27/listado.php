<?php

/**
 * Profesor Selente Villegas
 * Alumna Claudia Jara
 * 
 *Aplicación No 28 ( Listado BD)
 *Archivo: listado.php
 *método:GET
 *Recibe qué listado va a retornar(ej:usuarios,productos,vehículos,...etc),por ahora solo tenemos
 *usuarios).
 *En el caso de usuarios carga los datos del archivo usuarios.json.
 *se deben cargar los datos en un array de usuarios.
 *Retorna los datos que contiene ese array en una lista
 *<ul>
 *<li>apellido, nombre,foto</li>
 *<li>apellido, nombre,foto</li>
 *</ul>
 *Hacer los métodos necesarios en la clase usuario
 */

require_once './Servicios/UsuarioServicePdo.php';
require_once './Servicios/ProductoServicePdo.php';
require_once './Servicios/VentaServicePdo.php';


$listado = $_GET["listado"];

if (isset($listado)) {
    echo 'Buscando Listado...<br>';
    switch ($listado) {
        case 'usuarios':
            $servicio = new UsuarioServicePdo();
            echo json_encode($servicio->ObtenerTodos());
            break;
        case 'productos':
            $servicio = new ProductoServicePdo();
            echo json_encode($servicio->ObtenerTodos());
            break;
        case 'ventas':
            $servicio = new VentaServicePdo();
            echo json_encode($servicio->ObtenerTodos());
            break;

        default:
            echo 'No existe el listado buscado.';
            break;
    }
} else {
    echo 'Error en los datos ingresados. No se puede mostrar el listado.';
}

?>