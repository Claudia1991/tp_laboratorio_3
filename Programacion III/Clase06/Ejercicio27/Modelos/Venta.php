<?php

class Venta{
    public $id;
    public $id_usuario;
    public $id_producto;
    public $cantidad;
    public $fecha_venta;

    public function __construct(){

    }

    public static function CrearVenta($id, $id_usuario, $id_producto, $cantidad, $fecha_venta)
    {
        $venta = new Venta();
        $venta->id = $id;
        $venta->id_usuario = $id_usuario;
        $venta->id_producto = $id_producto;
        $venta->cantidad = $cantidad;
        $venta->fecha_venta = $fecha_venta;
        return $venta;
    }

}

?>