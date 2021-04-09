<?php

require_once './Interfaces/IVentaService.php';
require_once './Servicios/ProductoService.php';
require_once './Servicios/Usuario.php';
require_once './Modelos/ResultadoVenta.php';
require_once './Servicios/GeneradorIdVenta.php';
require_once './Modelos/Venta.php';

class VentaService implements IVentaService{
    private ProductoService $productoService;

    public function __construct()
    {
        $this->productoService = new ProductoService();
    }


    public function RealizarVenta($codigoBarras, $idUsuario, $cantidadItems): Response
    {
        $response = new Response();
        try {
            if($codigoBarras !== null && $idUsuario !== null && $cantidadItems !== null){
                //Verifico que exista el producto y idUsuario y stock
                $existeUsuario = Usuario::ExisteUsuarioPorId($idUsuario);
                $existeProducto = $this->productoService->VerificarProductoExistente(new Producto(0,$codigoBarras,'','',0,0));
                if($existeUsuario && $existeProducto){
                    //Verifico el stock
                    $producto = $this->productoService->ObtenerProducto($codigoBarras);
                    $hayStock = $cantidadItems <= $producto->getStock();
                    if($hayStock){
                        $precioTotal = $cantidadItems * $producto->getPrecio();
                        $idVenta = GeneradorId::ObtenerId();
                        $venta = new Venta($idVenta,$idUsuario, $codigoBarras, $cantidadItems, $precioTotal);
                        $this->GuardarVenta($venta);
                        $this->productoService->ActualizarStockProducto($codigoBarras, $cantidadItems * -1);
                        $response->success = true;
                        $response->data = ResultadoVenta::OK;
                    }else{
                        $response->success = false;
                        $response->data = ResultadoVenta::ERROR_SIN_STOCK;
                    }
                }else{
                    $response->success = false;
                    $response->data = ResultadoVenta::ERROR_IDUSUARIO_CODIGOBARRAS;
                }
            }else{
                $response->success = false;
                $response->data = ResultadoVenta::ERROR;
            }
        } catch (\Throwable $th) {
            echo $th;
            $response->success = false;
            $response->data = ResultadoVenta::ERROR;
        }

        return $response;
        
    }

    private function GuardarVenta(Venta $venta){
        $nombreArchivo = './Archivos/Ventas.json';
        $archivo = fopen($nombreArchivo, 'a');
        fwrite($archivo, json_encode($venta).PHP_EOL);
        $exito = fclose($archivo);
        return $exito;
    }
}


?>