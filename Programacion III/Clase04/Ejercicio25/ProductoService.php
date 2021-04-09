<?php
require_once 'iProductoService.php';
require_once 'Response.php';
require_once 'ResultadoInsercionProducto.php';
require_once 'GeneradorId.php';

class ProductoService implements iProductoService{


    public function ObtenerProductos($tipoArchivo){
        $productosArray = array();
        switch ($tipoArchivo) {
            case 'csv':
                $nombreArchivo = 'Productos.csv';
                $archivo = fopen($nombreArchivo, 'a+');
                while (!feof($archivo)) {
                    $linea = fgetcsv($archivo,1000 ,',','"','\n');
                    $producto = new Producto($linea[0], $linea[1], $linea[2], $linea[3],$linea[4],$linea[5]);
                    array_push($productosArray,$producto);
                }
                fclose($archivo);
                break;
            
            case 'json':
                $nombreArchivo = 'Productos.json';
                $archivo = fopen($nombreArchivo, 'a+');
                while(!feof($archivo)){
                    $linea = fgets($archivo);
                    if($linea !== false){
                        $productoJson = json_decode($linea, true);
                        $producto = new Producto($productoJson["id"],$productoJson["codigoBarras"], $productoJson["nombre"], $productoJson["tipo"], $productoJson["stock"], $productoJson["precio"]);
                        array_push($productosArray, $producto);
                    }
                }
                fclose($archivo);
                break;
        }
        return $productosArray;
    }

    public function GuardarProducto(Producto $producto){
        $response = new Response();
        //Primero verifico si existe el producto
       try {
           if($producto->getCodigoBarras() !== null && $producto->getNombre() !== null && $producto->getPrecio() !== null && $producto->getTipo() !== null && $producto->getStock() !== null){
            $existeProducto = $this->VerificarProductoExistente($producto);
           if($existeProducto){
               //si existe, actualizo el stock
               $this->ActualizarStockProducto($producto->getCodigoBarras(), $producto->getStock());;
              $response->data = ResultadoInsercionProducto::ACTUALIZADO;
              $response->success = true;
           }else{
               //si no existe, agrego al archivo

               $producto->setId(GeneradorId::ObtenerId());
               $this->GuardarProductoJson($producto);;
              $response->data = ResultadoInsercionProducto::INGRESADO;
              $response->success = true;
           }
            
           }else{
            $response->success = false;
            $response->data = ResultadoInsercionProducto::ERROR;
               
           }
       } catch (\Throwable $th) {
           $response->success = false;
           $response->data = ResultadoInsercionProducto::ERROR;
       }
        //devuelvo el resultado de la operacion
        return $response;
    }

    public function VerificarProductoExistente(Producto $producto){
        $existe = false;
        $arrayProductos = $this->ObtenerProductos('json');
        if(count($arrayProductos) > 0){
            foreach ($arrayProductos as $key => $value) {
                if($value->equals($producto)){
                    $existe = true;
                    break;
                }
            }
        }
        return $existe; 
    }

    public function ActualizarStockProducto($codigoBarras, $stock){
        //Obtener la lista de productos, obtener el producto, actualizar el producto, guardar todo
        $arrayProductos = $this->ObtenerProductos('json');
        foreach ($arrayProductos as $key => $value) {
            if($value->getCodigoBarras() == $codigoBarras){
                $value->setStock($value->getStock() + $stock);
                break;
            }
        }
        return $this->GuardarProductosJson($arrayProductos);
    }

    private function GuardarProductoCsv(Producto $producto){
        $nombreArchivo = 'Productos.csv';
        $archivo = fopen($nombreArchivo, 'a+');
        $registroNuevo = $producto->toString() . '\n';
        $exito = fwrite($archivo, $registroNuevo);
        fclose($archivo);
        return $exito;
    }

    private function GuardarProductoJson(Producto $producto){
        $nombreArchivo = 'Productos.json';
        $stringProducto = json_encode($producto);
        $archivo = fopen($nombreArchivo, 'a');
        $exito = fwrite($archivo, $stringProducto.PHP_EOL);
        fclose($archivo);
        return $exito;
    }

    private function GuardarProductosCsv($arrayProductos){
        $nombreArchivo = 'Productos.csv';
        $archivo = fopen($nombreArchivo, 'w');
        foreach ($arrayProductos as $key => $value) {
            $registroNuevo = $value->toString() . '\n';
            fwrite($archivo, $registroNuevo);
        }
        $exito = fclose($archivo);
        return $exito;
    }

    private function GuardarProductosJson($arrayProductos){
        $nombreArchivo = 'Productos.json';
        $archivo = fopen($nombreArchivo, 'w');
        foreach ($arrayProductos as $key => $value) {
            $registroNuevo = json_encode($value);
            fwrite($archivo, $registroNuevo.PHP_EOL);
        }
        $exito = fclose($archivo);
        return $exito;
    }
}
