<?php

require_once 'PizzaCarga.php';
require_once 'PizzaConsultar.php';
require_once 'AltaVenta.php';

/**pt.) index.php:Recibe todas las peticiones que realiza el postman, y administra a que archivo se debe incluir. */
/**Alumna: Claudia Jara Legajo 110050 
 * Parte 02 
*/

//Verifico si trae algo por get
$sabor = $_GET["sabor"];
$precio = $_GET["precio"];
$tipo = $_GET["tipo"];
$cantidad = $_GET["cantidad"];

if (isset($sabor) && isset($precio) && isset($tipo) && isset($cantidad) ) {
    echo PizzaCarga::CargarPizza($sabor, $precio, $tipo, $cantidad);
}else{
    $mailUsuario = $_POST["mailUsuario"];
    $saborPost = $_POST["sabor"];
    $tipoPost = $_POST["tipo"];
    $cantidad = $_POST["cantidad"];
    $nombreActualArchivo = $_FILES["foto"]["name"];
    if(isset($mailUsuario) && isset($saborPost) && isset($tipoPost) && isset($cantidad)){
        $tipoArchivo = pathinfo($nombreActualArchivo, PATHINFO_EXTENSION);
        $destino = "ImagenesDeLaVenta/" . $tipoPost . $saborPost . $mailUsuario. '.' . $tipoArchivo;
        if (!file_exists($destino)) {
            move_uploaded_file($_FILES["foto"]["tmp_name"], $destino);
        }
        echo AltaVenta::VenderPizza($mailUsuario, $saborPost, $tipoPost, $cantidad, $destino);
    }else if (isset($saborPost) && isset($tipoPost)){
        echo PizzaConsultar::ConsultarPizza($saborPost,$tipoPost);
        
    }
}

//Verifico si trae algo por post




?>