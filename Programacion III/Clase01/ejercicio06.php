<?php
/*
    Profesor Villegas
    Alumna Claudia Jara

    Enunciado:
    Aplicación No 6 (Carga aleatoria)
    Definir un Array de 5 elementos enteros y asignar a cada uno de ellos un número (utilizar la
    función rand). Mediante una estructura condicional, determinar si el promedio de los números
    son mayores, menores o iguales que 6. Mostrar un mensaje por pantalla informando el
    resultado.
    */

    $array = array(0,0,0,0,0);
    $acumulador = 0;
    $promedio = 0;

    foreach ($array as $key => $value) {
        $numeroAleatorio = rand(0,1000);
        $array[$key] = $numeroAleatorio;
        $acumulador += $numeroAleatorio;
        printf("Numero aleatorio: %d", $numeroAleatorio);
        echo '<br/>';
        printf("Acumulador: %d", $acumulador);
        echo '<br/>';
        echo '<hr>';
    }

    $promedio = $acumulador / 5;

    if($promedio == 6){
        printf("El promedio de los numeros del array es 6.");
    }else{
        if($promedio > 6){
            printf("El promedio de los numeros del array es mayor a 6.");
        }else{
            printf("El promedio de los numeros del array es menor a 6.");
        }
    }


?>