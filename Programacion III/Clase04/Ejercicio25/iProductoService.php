<?php
require_once 'Producto.php';

interface iProductoService{
    public function ObtenerProductos($tipoArchivo);
    public function GuardarProducto(Producto $producto);
    public function VerificarProductoExistente(Producto $producto);
    public function ActualizarStockProducto($codigoBarras, $stock);
}

?>