<?php

class Producto{
    public $id;
    public $codigo_barras;
    public $nombre;
    public $tipo;
    public $stock;
    public $precio;
    public $fecha_creacion;
    public $fecha_modificacion;

    public function __construct()
    {
        
    }

    public static function CrearProducto($id=0, $codigoBarras=0, $nombre='', $tipo='', $stock=0, $precio=0, $fecha_creacion='', $fecha_modificacion=''){
        $producto = new Producto();
        $producto->id = $id;
        $producto->codigo_barras = $codigoBarras;
        $producto->nombre = $nombre;
        $producto->tipo = $tipo;
        $producto->stock = $stock;
        $producto->precio = $precio;
        $producto->fecha_creacion = $fecha_creacion;
        $producto->fecha_modificacion = $fecha_modificacion;
        return $producto;
    }

    /**Propiedades */
    public function setStock($value)
    {
        $this->stock = $value;
    }

    public function getStock()
    {
        return $this->stock;
    }

    public function getCodigoBarras()
    {
        return $this->codigoBarras;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getTipo(){
        return $this->tipo;
    }

    public function getPrecio(){
        return $this->precio;
    }

    /**Metodos */
    public function equals(Producto $producto){
        return $this->codigoBarras == $producto->getCodigoBarras();
    }

    public function toString(){
        return $this->id . ',' . $this->codigoBarras . ',' . $this->nombre . ',' . $this->tipo . ',' . $this->stock . ',' . $this->precio;
    }
}

?>