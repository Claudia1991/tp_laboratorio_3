<?php
require_once './Modelos/Venta.php';


interface IVentaServicePdo{
    public function ObtenerTodos();
    public function ObtenerPorId($id);
    public function Insertar(Venta $venta);
    public function Eliminar($id);
    public function Modificar(Venta $venta);
}



?>