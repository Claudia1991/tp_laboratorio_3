<?php

abstract class ResultadoVenta{
    const OK = 'Se realizo la venta del producto.';
    const ERROR = 'No se pudo realizar la operación.';
    const ERROR_SIN_STOCK = 'No hay stock.';
    const ERROR_IDUSUARIO_CODIGOBARRAS = 'No existe el codigo de barras o el usuario.';
}

?>