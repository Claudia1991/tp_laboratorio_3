<?php
/*
    Profesor Villegas
    Alumna Claudia Jara

    Enunciado:
    Aplicación No 13 (Invertir palabra)
    Crear una función que reciba como parámetro un string ($palabra) y un entero ($max). La
    función validará que la cantidad de caracteres que tiene $palabra no supere a $max y además
    deberá determinar si ese valor se encuentra dentro del siguiente listado de palabras válidas:
    “Recuperatorio”, “Parcial” y “Programacion”. Los valores de retorno serán:
    1 si la palabra pertenece a algún elemento del listado.
    0 en caso contrario.
    */
    require 'Ejercicio13_01.php';

    verificarPalabras('PruebaMala', 10);
    echo '<hr>';
    verificarPalabras('Recuperatorio', 50);

?>