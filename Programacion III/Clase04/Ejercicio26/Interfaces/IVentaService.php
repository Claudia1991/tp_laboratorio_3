<?php

require_once './Modelos/Response.php';

interface IVentaService{
    public function RealizarVenta($codigoBarras, $idUsuario, $cantidadItems) : Response;
}


?>