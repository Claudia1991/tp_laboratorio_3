<?php
/*
    Profesor Villegas
    Alumna Claudia Jara

    Enunciado:
    Aplicación No 11 (Potencias de números)
    Mostrar por pantalla las primeras 4 potencias de los números del uno 1 al 4 (hacer una función
    que las calcule invocando la función pow).
    */

    for ($i=1; $i < 5; $i++) { 
        for ($j=1; $j < 5; $j++) { 
            printf("Numero: %d - Potencia: %d - Resultado: %d <br>", $i, $j, obtenerPotencia($i, $j));
        }
        echo '<hr>';
    }


    function obtenerPotencia($numero, $potencia){
        return pow($numero, $potencia);
    }

?>