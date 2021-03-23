<?php
/*
    Profesor Villegas
    Alumna Claudia Jara

    Enunciado:
    Aplicación No 12 (Invertir palabra)
    Realizar el desarrollo de una función que reciba un Array de caracteres y que invierta el orden
    de las letras del Array.
    Ejemplo: Se recibe la palabra “HOLA” y luego queda “ALOH”.
    */

    $arrayPalabra = array('H','O','L','A');
    echo 'Palabra: ';
    print_r($arrayPalabra);
    echo '<hr>';
    echo 'Palabra invertida: ';
    invertirPalabra($arrayPalabra);
    function invertirPalabra($arrayCaracteres){
        $length = count($arrayCaracteres) -1;
        for ($i=$length; $i > -1; $i--) { 
           echo $arrayCaracteres[$i];
        }
    }

?>