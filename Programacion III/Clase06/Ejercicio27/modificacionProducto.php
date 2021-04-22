<?php

/**Aplicación No 33 ( ModificacionProducto BD)
Archivo: modificacionproducto.php
método:POST
Recibe los datos del producto(código de barra (6 sifras ),nombre ,tipo, stock, precio )por POST
,
crear un objeto y utilizar sus métodos para poder verificar si es un producto existente,
si ya existe el producto el stock se sobrescribe y se cambian todos los datos excepto:
el código de barras .
Retorna un :
“Actualizado” si ya existía y se actualiza
“no se pudo hacer“si no se pudo hacer
Hacer los métodos necesarios en la clase */

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
    $productos = $servicio->ObtenerPorCodigoBarras($codigoBarras);
    if(isset($productos) && count($productos) > 0){
        $productoModificaco = Producto::CrearProducto($productos[0]->id,$codigoBarras, $nombre, $tipo, $stock, $precio,$productos[0]->fecha_creacion, date('Y-m-d'));
        $servicio->ModificarPorCodigoBarras($productoModificaco);
        echo 'Se actualizo el producto';
    }else{
        echo 'No se puedo realizar la modificacion.';
    }
    
}else{
    echo 'Error en los datos ingresados';
}

?>