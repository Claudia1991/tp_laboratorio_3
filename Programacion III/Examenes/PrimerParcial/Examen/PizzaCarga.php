<?php
require_once 'Pizza.php';

/**PizzaCarga.php: (por GET)se ingresa Sabor, precio, Tipo (“molde” o “piedra”), cantidad( de unidades). Se
guardan los datos en en el archivo de texto Pizza.json, tomando un id autoincremental como
identificador(emulado) .Sí el sabor y tipo ya existen , se actualiza el precio y se suma al stock existente. */

class PizzaCarga{
    public static function CargarPizza($sabor, $precio, $tipo, $cantidad){
        //Verifico si existe la pizza
        $existePizza = Pizza::ExistePizzaSegunSaborTipo($sabor, $tipo);
        if($existePizza){
            //actualizo el stock
            Pizza::ActualizarStockPizza($sabor, $tipo, $cantidad);
            return 'Se actualizo el stock';
        }else{
            //Agrego una nueva pizza
            $pizza = Pizza::CrearPizzaNueva($sabor, $precio, $tipo, $cantidad);
            Pizza::GuardarPizzaJson($pizza);
            return 'Se agrego la nueva pizza';
        }

        return 'Ocurrio un errortz';
    }
}

?>