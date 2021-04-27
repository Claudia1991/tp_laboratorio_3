<?php

require_once 'GeneradorId.php';

class Pizza{
    public int $id;
    public $sabor;
    public int $precio;
    public $tipo;
    public int $cantidad;

    public function __construct($id=0, $sabor='', $precio=0, $tipo='', $cantidad=0){
        $this->id = $id;
        $this->sabor = $sabor;
        $this->precio = $precio;
        $this->tipo = $tipo;
        $this->cantidad = $cantidad;
    }

    public static function CrearPizzaNueva($sabor, $precio, $tipo, $cantidad){
        $pizza = new Pizza();
        $pizza->id = GeneradorId::ObtenerId();
        $pizza->sabor = $sabor;
        $pizza->precio = $precio;
        $pizza->tipo = $tipo;
        $pizza->cantidad = $cantidad;
        return $pizza;
    }


    /**Metodos Json */
    public static function GuardarPizzaJson(Pizza $pizza){
        $nombreArchivo = 'Pizza.json';
        $stringUsuario = json_encode($pizza);
        $archivo = fopen($nombreArchivo, 'a');
        fwrite($archivo,$stringUsuario.PHP_EOL);
        fclose($archivo);
        return true;
    }

    public static function ObtenerPizzasJson(){
        $nombreArchivo = 'Pizza.json';
        $arrayPizzas = array();
        $archivo = fopen($nombreArchivo, 'r');
        while(!feof($archivo)){
            $linea = fgets($archivo);
            $pizzaJson = json_decode($linea, true);
            $pizza = new Pizza($pizzaJson["id"], $pizzaJson["sabor"], $pizzaJson["precio"], $pizzaJson["tipo"], $pizzaJson["cantidad"]);
            array_push($arrayPizzas, $pizza);
        }
        fclose($archivo);
        return $arrayPizzas;
    }

    public static function ExistePizzaSegunSaborTipo($sabor, $tipo){
        $existePizza = false;
        $arrayPizzas = Pizza::ObtenerPizzasJson();
        foreach ($arrayPizzas as $value) {
            if(strcmp($value->sabor, $sabor) == 0 && strcmp($value->tipo, $tipo) == 0){
                $existePizza = true;
                break;
            }
        }
        return $existePizza;

    }

    private static function GuardarPizzasJson($arrayPizzas){
        $nombreArchivo = 'Pizza.json';
        $archivo = fopen($nombreArchivo, 'w');
        foreach ($arrayPizzas as $key => $value) {
            $registroNuevo = json_encode($value);
            fwrite($archivo, $registroNuevo.PHP_EOL);
        }
        $exito = fclose($archivo);
        return $exito;
    }

    public static function ActualizarStockPizza($sabor, $tipo, $cantidad){
        $arrayPizzas = self::ObtenerPizzasJson();
        foreach ($arrayPizzas as $key => $value) {
            if(strcmp($value->sabor, $sabor) == 0 && strcmp($value->tipo, $tipo) == 0){
                $value->cantidad += $cantidad;
                break;
            }
        }
        return self::GuardarPizzasJson($arrayPizzas);
    }

    public static function HayStock($sabor, $tipo, $cantidad){
        $existePizza = self::ExistePizzaSegunSaborTipo($sabor, $tipo);
        $hayStock = false;
        if($existePizza){
            $arrayPizzas = self::ObtenerPizzasJson();
            foreach ($arrayPizzas as $key => $value) {
                if(strcmp($value->sabor, $sabor) == 0 && strcmp($value->tipo, $tipo) == 0){
                    $hayStock = (int)$value->cantidad >= (int)$cantidad;
                    break;
                }
            }
        }
        return $hayStock;
    }
}



?>