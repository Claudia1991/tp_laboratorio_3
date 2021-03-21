<?php
/*
    Profesor Villegas
    Alumna Claudia Jara

    Enunciado:
    Aplicación No 9 (Arrays asociativos)
    Realizar las líneas de código necesarias para generar un Array asociativo $lapicera, que
    contenga como elementos: ‘color’, ‘marca’, ‘trazo’ y ‘precio’. Crear, cargar y mostrar tres
    lapiceras.
    */
    $cartuchera = array();
    $lapiceraUno = array('color' => '','marca' => '', 'trazo' => '', 'precio' => '');
    $lapiceraDos = array('color' => '','marca' => '', 'trazo' => '', 'precio' => '');
    $lapiceraTres = array('color' => '','marca' => '', 'trazo' => '', 'precio' => '');

    $cartuchera['lapiceraUno']= crearLapicera('Uno', 'UNO',1, 'UNO');
    $cartuchera['lapiceraDos']=crearLapicera('DOS', 'DOS',2, 'DOS');
    $cartuchera['lapiceraTres']= crearLapicera('TRES', 'TRES',3, 'TRES');

    foreach ($cartuchera as $key => $value) {
        foreach ($value as $k => $v) {
            echo 'Key: ', $v;
            echo '&nbsp;';
            echo 'Value: ', $v;
        }
        echo '<br><hr>';
    }

    function crearLapicera($color, $marca, $precio, $trazo){
        $lapicera = array('color' => $color,'marca' => $marca, 'trazo' => $trazo, 'precio' => $precio);
        return $lapicera;
    }

?>