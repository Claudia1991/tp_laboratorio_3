<?php

/**
 * Aplicación No 30 ( AltaProducto BD)
*Archivo: altaProducto.php
*método:POST
*Recibe los datos del producto(código de barra (6 sifras ),nombre ,tipo, stock, precio )por POST
*, carga la fecha de creación y crear un objeto ,se debe utilizar sus métodos para poder
*verificar si es un producto existente,
*si ya existe el producto se le suma el stock , de lo contrario se agrega .
*Retorna un :
*“Ingresado” si es un producto nuevo
*“Actualizado” si ya existía y se actualiza el stock.
*“no se pudo hacer“si no se pudo hacer
*Hacer los métodos necesarios en la clase
 */
require_once './Servicios/ProductoServicePdo.php';
require_once './Modelos/Producto.php';

$codigoBarras = $_POST["codigoBarras"];
$nombre = $_POST["nombre"];
$tipo = $_POST["tipo"];
$stock = $_POST["stock"];
$precio = $_POST["precio"];

if(isset($codigoBarras)&& isset($nombre) && isset($tipo) && isset($stock ) && isset($precio)){
    //Verifico si existe el producto.
    $servicio = new ProductoServicePdo();
    $producto = Producto::CrearProducto(-1,$codigoBarras, $nombre, $tipo, $stock, $precio, date('Y-m-d'),'');
    $productos = $servicio->ObtenerTodos();
    $existeProducto= false;
    foreach ($productos as $value) {
        if($value->codigo_barras == $producto->codigo_barras){
            $existeProducto = true;
            $producto->id = $value->id;
            $producto->fecha_creacion = $value->fecha_creacion;
            $producto->fecha_modificacion = date('Y-m-d');
            break;
        }
    }
    if($existeProducto){
        $servicio->Modificar($producto);
        echo 'Se actualizo el stock';
    }else{
        $idInsertado = $servicio->Insertar($producto);
        echo 'Id insertado' . $idInsertado;
    }
    
}else{
    echo 'Error en los datos ingresados';
}

?>