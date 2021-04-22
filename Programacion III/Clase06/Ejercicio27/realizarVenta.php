<?php

/**Aplicación No 31 (RealizarVenta BD )
Archivo: RealizarVenta.php
método:POST
Recibe los datos del producto(código de barra), del usuario (el id )y la cantidad de ítems ,por
POST .
Verificar que el usuario y el producto exista y tenga stock.
Retorna un :
“venta realizada”Se hizo una venta
“no se pudo hacer“si no se pudo hacer
Hacer los métodos necesarios en las clases */

require_once './Servicios/VentaServicePdo.php';
require_once './Servicios/ProductoServicePdo.php';
require_once './Servicios/UsuarioServicePdo.php';
require_once './Modelos/Venta.php';


$codigoBarras = $_POST["codigoBarras"];
$idUsuario = $_POST["idUsuario"];
$cantidad = $_POST["cantidad"];

if(isset($codigoBarras) && isset($idUsuario) && isset($cantidad)){
    //Verifico usuario
    $servicioUsuario = new UsuarioServicePdo();
    $usuario = $servicioUsuario->ObtenerPorId($idUsuario);
    if(isset($usuario) && count($usuario) > 0){
        //Verifico producto
        $servicioProducto = new ProductoServicePdo();
        $productos = $servicioProducto->ObtenerPorCodigoBarras($codigoBarras);
        if(isset($productos) && count($productos)>0){
            //Verifico stock
            if($productos[0]->stock >= $cantidad){
                //Actualizo el stock
                $productos[0]->stock += -$cantidad;
                $productos[0]->fecha_modificacion = date('Y-m-d');
                $servicioProducto->Modificar($productos[0]); 
                //Realizo la venta
                $venta = Venta::CrearVenta(-1,$idUsuario, $productos[0]->id, $cantidad, date('Y-m-d'));
                $servicioVenta = new VentaServicePdo();
                $resultadoVenta = $servicioVenta->Insertar($venta);
                echo 'Venta realizada: ' . $resultadoVenta;
            }else{
                echo 'No hay stock suficiente.';
            }
        }else{
            echo 'No existe el producto.';
        }
    }else{
        echo 'No existe el usuario.';
    }
}else{
    echo 'Error en los datos ingresados.';
}



?>