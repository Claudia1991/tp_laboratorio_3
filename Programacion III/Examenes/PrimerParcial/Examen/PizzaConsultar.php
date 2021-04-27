<?php

require_once 'Pizza.php';

/**PizzaConsultar.php: (por POST)Se ingresa Sabor,Tipo, si coincide con algún registro del archivo Pizza.json,
retornar “Si Hay”. De lo contrario informar si no existe el tipo o el sabor. */

class PizzaConsultar{
    public static function ConsultarPizza($sabor, $tipo){
        if(strcmp("molde", $tipo) == 0 || strcmp("piedra", $tipo) == 0){
            $existePizza = Pizza::ExistePizzaSegunSaborTipo($sabor, $tipo);
            if($existePizza){
                return 'Si existe la pizza';
            }else{
                return 'No existe el sabor.';
            }
        }else{
            return 'No existe el tipo.';
        }
    }
}

?>