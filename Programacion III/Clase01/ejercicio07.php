<?php
/*
    Profesor Villegas
    Alumna Claudia Jara

    Enunciado:
    Aplicación No 7 (Mostrar impares)
    Generar una aplicación que permita cargar los primeros 10 números impares en un Array.
    Luego imprimir (utilizando la estructura for) cada uno en una línea distinta (recordar que el
    salto de línea en HTML es la etiqueta <br/>). Repetir la impresión de los números utilizando
    las estructuras while y foreach.
    */

    $array = array(0,0,0,0,0,0,0,0,0,0);
    $contador = 0;
    $numeroImpar = 1;

    for ($i=0; $i < 10; $i++) { 
        if($i == 0){
            $array[$i]=$numeroImpar;
        }else{
            $numeroImpar +=2;
            $array[$i]=$numeroImpar;
        }
    }

    echo '<hr><br>';
    echo 'Foreach';
    foreach ($array as $key => $value) {
        echo 'Key: ', $key;
        echo 'Value: ', $value;
        echo '<br><hr>';
    }

    echo '<hr><br>';
    echo 'While';
    while ($contador < 10) {
        echo 'Numero: ',$array[$contador];
        echo '<br><hr>';
        $contador +=1;
    }

?>