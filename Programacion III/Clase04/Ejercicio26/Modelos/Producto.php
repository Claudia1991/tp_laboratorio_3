<?php

class Producto{
    public $id;
    public int $codigoBarras;
    public $nombre;
    public $tipo;
    public $stock;
    public $precio;

    public function __construct($id = 0, $codigoBarras = 0, $nombre = '', $tipo = '', $stock = 0, $precio = 0)
    {
        $this->id = $id;
        $this->codigoBarras = $codigoBarras;
        $this->nombre = $nombre;
        $this->tipo = $tipo;
        $this->stock = $stock;
        $this->precio = $precio;
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
    public function equals(Producto $producto) : bool{
        $existe = $this->codigoBarras == $producto->getCodigoBarras();
        return $existe;
    }

    public function toString(){
        return $this->id . ',' . $this->codigoBarras . ',' . $this->nombre . ',' . $this->tipo . ',' . $this->stock . ',' . $this->precio;
    }
}

?>