<?php
/*
    Profesor Villegas
    Alumna Claudia Jara

    Enunciado:
    Aplicación No 8 (Carga aleatoria)
    Imprima los valores del vector asociativo siguiente usando la estructura de control foreach:
    $v[1]=90; $v[30]=7; $v['e']=99; $v['hola']= 'mundo';
    */

    $array = array(1 => 90,30 => 7, 'e' => 99, 'hola' => 'mundo');

    echo 'Foreach';
    echo '<hr><br>';
    foreach ($array as $key => $value) {
        echo 'Key: ', $key;
        echo ' &nbsp;';
        echo 'Value: ', $value;
        echo '<br><hr>';
    }

?>