<?php

class Venta{
    public $id;
    public $idUsuario;
    public $codigoBarras;
    public $cantidadItems;
    public $precioTotal;

    public function __construct($id, $idUsuario, $codigoBarras, $cantidadItems, $precioTotal)
    {
        $this->id = $id;
        $this->idUsuario = $idUsuario;
        $this->codigoBarras = $codigoBarras;
        $this->cantidadItems = $cantidadItems;
        $this->precioTotal = $precioTotal;
    }

}

?>