<?php
require_once './Modelos/Producto.php';


interface IProductoServicePdo{
    public function ObtenerTodos();
    public function ObtenerPorId($id);
    public function Insertar(Producto $producto);
    public function Eliminar($id);
    public function Modificar(Producto $producto);
}



?>